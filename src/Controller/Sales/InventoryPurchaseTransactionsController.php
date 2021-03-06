<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * InventoryPurchaseTransactions Controller
 *
 * @property \App\Model\Table\InventoryPurchaseTransactionsTable $InventoryPurchaseTransactions
 *
 * @method \App\Model\Entity\InventoryPurchaseTransaction[] paginate($object = null, array $settings = [])
 */
class InventoryPurchaseTransactionsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->Session = $this->request->session();
        $storeId = $this->Auth->user('store_id');
        $date = null;
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '設定') {
                if(strtotime($data['date'])){
                    $date = strtotime($data['date']);
                    $this->Session->write('InventoryPurchaseTransactions.date', $date);
                }
            }
        }
        if($date == null){
            if($this->Session->read('InventoryPurchaseTransactions.date') == null){
                $date = time();
                $this->Session->write('InventoryPurchaseTransactions.date', $date);
            }
            else {
                $date = $this->Session->read('InventoryPurchaseTransactions.date');
            }
        }
        $inventoryPurchaseTransactions = $this->InventoryPurchaseTransactions->find()
            ->where([
                'store_id' => $storeId,
                'transaction_date' => date('Y-m-d 00:00:00', $date)
            ]);
        $idArray = array();
        $i = 0;
        foreach($inventoryPurchaseTransactions as $inventoryPurchaseTransaction){
            $idArray += [$inventoryPurchaseTransaction->inventory_item_id => $i];
            $i ++;
        }
        $this->StoreInventoryItemHistories = TableRegistry::get('StoreInventoryItemHistories');
        $storeInventoryItemHistories = $this->StoreInventoryItemHistories->find()
            ->contain(['Stores', 'InventoryItems','InventoryItems.InventoryItemHistories'])
            ->innerJoinWith('InventoryItems.InventoryItemHistories')

            // StoreInventoryItemHistories
            ->where(['StoreInventoryItemHistories.start <=' => $date])
            ->where([
                'OR' => [
                    'StoreInventoryItemHistories.end >=' => $date,
                    'StoreInventoryItemHistories.end IS' => null,
                ]
            ])
            ->where(['StoreInventoryItemHistories.deleted' => 0])
            ->where(['StoreInventoryItemHistories.store_id' => $storeId])

            // InventoryItemHistories
            ->where(['InventoryItemHistories.start <=' => $date])
            ->where([
                'OR' => [
                    'InventoryItemHistories.end >=' => $date,
                    'InventoryItemHistories.end IS' => null,
                ]
            ])
            ->where(['InventoryItemHistories.deleted' => 0]);

        $previousDayCountArray = array();
        foreach($storeInventoryItemHistories as $storeInventoryItemHistory) {
            $inventoryPurchaseTransaction = $this->InventoryPurchaseTransactions->find()
                ->where([
                    'store_id' => $storeId,
                    'inventory_item_id' => $storeInventoryItemHistory->inventory_item_id,
                    'transaction_date <' => date('Y-m-d 00:00:00', $date)
                ])
                ->limit(1)
                ->order(['transaction_date' => 'DESC'])
                ->first();
            if($inventoryPurchaseTransaction != null){
                $previousDayCountArray += [$inventoryPurchaseTransaction['inventory_item_id'] => $inventoryPurchaseTransaction['count_qty']];
            }
        }

        $storeId = $this->Auth->user('store_id');
        $this->set(compact('inventoryPurchaseTransactions', 'storeInventoryItemHistories','date','storeId','idArray', 'previousDayCountArray'));
        $this->set('_serialize', ['inventoryPurchaseTransactions']);
    }

    /**
     * View method
     *
     * @param string|null $id Inventory Purchase Transaction id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inventoryPurchaseTransaction = $this->InventoryPurchaseTransactions->get($id, [
            'contain' => ['InventoryItems', 'Stores']
        ]);

        $this->set('inventoryPurchaseTransaction', $inventoryPurchaseTransaction);
        $this->set('_serialize', ['inventoryPurchaseTransaction']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inventoryPurchaseTransaction = $this->InventoryPurchaseTransactions->newEntity();
        if ($this->request->is('post')) {
            $inventoryPurchaseTransaction = $this->InventoryPurchaseTransactions->patchEntity($inventoryPurchaseTransaction, $this->request->getData());
            if ($this->InventoryPurchaseTransactions->save($inventoryPurchaseTransaction)) {
                $this->Flash->success(__('The inventory purchase transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory purchase transaction could not be saved. Please, try again.'));
        }
        $inventoryItems = $this->InventoryPurchaseTransactions->InventoryItems->find('list', ['limit' => 200]);
        $stores = $this->InventoryPurchaseTransactions->Stores->find('list', ['limit' => 200]);
        $this->set(compact('inventoryPurchaseTransaction', 'inventoryItems', 'stores'));
        $this->set('_serialize', ['inventoryPurchaseTransaction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Inventory Purchase Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inventoryPurchaseTransaction = $this->InventoryPurchaseTransactions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inventoryPurchaseTransaction = $this->InventoryPurchaseTransactions->patchEntity($inventoryPurchaseTransaction, $this->request->getData());
            if ($this->InventoryPurchaseTransactions->save($inventoryPurchaseTransaction)) {
                $this->Flash->success(__('The inventory purchase transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory purchase transaction could not be saved. Please, try again.'));
        }
        $inventoryItems = $this->InventoryPurchaseTransactions->InventoryItems->find('list', ['limit' => 200]);
        $stores = $this->InventoryPurchaseTransactions->Stores->find('list', ['limit' => 200]);
        $this->set(compact('inventoryPurchaseTransaction', 'inventoryItems', 'stores'));
        $this->set('_serialize', ['inventoryPurchaseTransaction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Inventory Purchase Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inventoryPurchaseTransaction = $this->InventoryPurchaseTransactions->get($id);
        if ($this->InventoryPurchaseTransactions->delete($inventoryPurchaseTransaction)) {
            $this->Flash->success(__('The inventory purchase transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The inventory purchase transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function register($id = null)
    {
        $this->request->allowMethod(['post']);
        if(array_key_exists('edit', $this->request->data())){
            $inventoryPurchaseTransactions = $this->InventoryPurchaseTransactions->find()
            ->where(['store_id' => $this->Auth->user('store_id')])->toArray();
            $inventoryPurchaseTransactions = $this->InventoryPurchaseTransactions->patchEntities($inventoryPurchaseTransactions, $this->request->data()['edit']);
            if($this->InventoryPurchaseTransactions->saveMany($inventoryPurchaseTransactions)){
                $this->Flash->success('データが保存されました');
            } else {
                $this->Flash->error('データの保存に失敗しました');
            }
        }
        if(array_key_exists('add', $this->request->data())){
            $inventoryPurchaseTransactions = $this->InventoryPurchaseTransactions->newEntities($this->request->data()['add']);
            if($this->InventoryPurchaseTransactions->saveMany($inventoryPurchaseTransactions)){
                $this->Flash->success('データが保存されました');
            } else {
                $this->Flash->error('データの保存に失敗しました');
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    /* public $paginate = [
        'limit' => 20,
    ]; */

    public function monthly(){
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        // $this->Stores = TableRegistry::get('stores');
        // if(count($this->Stores->find()->where(['id' => $storeId])->toArray()) === 1){
        //     $storeName = $this->Stores->get($storeId)->name;
        // } else {
        //     return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        // }
        // debug($storeName);
        $this->Stores = TableRegistry::get('stores');
        $storeName = $this->Stores->get($storeId)->name;
        $this->Session = $this->request->session();
        $date = null;
        if($date == null){
            if($this->Session->read('InventoryPurchaseTransactions.date') == null){
                $date = time();
                $this->Session->write('InventoryPurchaseTransactions.date', $date);
            } else {
                $date = $this->Session->read('InventoryPurchaseTransactions.date');
            }
        }
        // $storeInventoryItemHistories = null;
        $searchWord = null;//検索ワード
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '設定') {
                if(strtotime($data['date']['year'].'-'.$data['date']['month'])){
                    $date = strtotime($data['date']['year'].'-'.$data['date']['month']);
                    $this->Session->write('InventoryPurchaseTransactions.date', $date);
                }
            } else if($data['button'] === '検索'){
                $searchWord = $data['queryName'];
            }
        }

        $this->StoreInventoryItemHistories = TableRegistry::get('store_inventory_item_histories');
        $storeInventoryItemHistories = $this->StoreInventoryItemHistories->find()
            ->contain(['InventoryItemHistories'])
            ->where(['store_id' => $storeId])
            ->where(['store_inventory_item_histories.start <=' => date('Y-m-d', strtotime('last day of this month', $date))])
            ->where([
                'OR' => [
                    ['store_inventory_item_histories.end >' => date('Y-m-d', strtotime('first day of this month', $date))],
                    ['store_inventory_item_histories.end is' => null]
                ]
            ])
            ->distinct('store_inventory_item_histories.inventory_item_id');
        if (!empty($searchWord)) {
            $storeInventoryItemHistories->where(['InventoryItemHistories.item_name LIKE' => '%'.$searchWord.'%']);
        }
        $storeInventoryItemHistories->all();

        $this->paginate['limit'] = 2;
        $storeInventoryItemHistories = $this->paginate($storeInventoryItemHistories);

        $lastMonthInventoryPurchaseTransactions = array(); //先月以前の最新の残取り数
        $inventoryPurchaseTransactions = array();
        $itemPriceHistories = array();
        foreach($storeInventoryItemHistories as $storeInventoryItemHistory) {
            $array = $this->InventoryPurchaseTransactions->find()
                ->where([   'transaction_date >=' => date('Y-m-d',strtotime('first day of this month',$date)),
                            'transaction_date <' => date('Y-m-d',strtotime('first day of next month', $date)),
                            'inventory_item_id' => $storeInventoryItemHistory->inventory_item_id,
                            'store_id' => $storeId])
                ->order(['transaction_date'])->toArray();
            array_push($inventoryPurchaseTransactions, $array );
            $array = $this->InventoryPurchaseTransactions->find()
                ->where(['transaction_date <' => date('Y-m-d',strtotime('first day of this month', $date))])
                ->where(['inventory_item_id' => $storeInventoryItemHistory->inventory_item_id])
                ->where(['store_id' => $storeId])
                ->order(['transaction_date' => 'desc'])
                ->first();
            array_push($lastMonthInventoryPurchaseTransactions, $array );
            $array = $this->StoreInventoryItemHistories->find()
                ->where(['store_id' => $storeId])
                ->where(['start <=' => date('Y-m-d', strtotime('last day of this month', $date))])
                ->where(['OR' => [['end >=' => date('Y-m-d', strtotime('first day of this month', $date))],['end is' => null]]])
                ->where(['inventory_item_id' => $storeInventoryItemHistory->inventory_item_id])
                ->toArray();
            array_push($itemPriceHistories, $array );
        }
        $this->set(compact('date', 'storeInventoryItemHistories','inventoryPurchaseTransactions', 'storeName', 'lastMonthInventoryPurchaseTransactions', 'itemPriceHistories'));
    }
}
