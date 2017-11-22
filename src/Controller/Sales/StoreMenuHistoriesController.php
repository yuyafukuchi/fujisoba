<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * StoreMenuHistories Controller
 *
 * @property \App\Model\Table\StoreMenuHistoriesTable $StoreMenuHistories
 *
 * @method \App\Model\Entity\StoreMenuHistory[] paginate($object = null, array $settings = [])
 */
class StoreMenuHistoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->Session = $this->request->session();
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        /*
        $this->paginate = [
            //'contain' => ['Menus', 'Stores'],
            'matching' => ['SalesItemAssignHistories']
        ];
        */
        $storeMenuHistories = $this->StoreMenuHistories->find()
        ->where(['store_id' => $storeId])
        ->contain(['Menus','MenuHistories','MenuHistories.SalesItemAssignHistories.SalesItems.SalesItemHistories']);
        $date = null;
        if ($this->request->is('post')) {
            $data = $this->request->data();
            debug($data);
            if($data['button'] === '設定') {
                if(strtotime($data['date'])){
                    $date = strtotime($data['date']);
                    $this->Session->write('InventoryItemHistories.date', $date);
                }
            }
        }
        if($date == null){
            if($this->Session->read('StoreMenuHistories.date') == null){
                $date = time();
            } else {
                $date = $this->Session->read('StoreMenuHistories.date');
                $this->Session->write('StoreMenuHistories.date', $date);
            }
        }
        $this->Stores = TableRegistry::get('stores');
        $storeName = $this->Stores->get($storeId)->name;
        $this->MenuHistories = TableRegistry::get('menu_histories');
        $menuHistories = $this->MenuHistories -> find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
            ->contain(['Menus']);
        $idArray = array();
        foreach ($storeMenuHistories as $storeMenuHistory){
            array_push($idArray, $storeMenuHistory->menu_item_id);
        }

        $this->set(compact('storeMenuHistories', 'menuHistories','date', 'idArray', 'storeId','storeName'));
        $this->set('_serialize', ['storeMenuHistories','salesItemAssignHistories']);
    }

    /**
     * View method
     *
     * @param string|null $id Store Menu History id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $storeMenuHistory = $this->StoreMenuHistories->get($id, [
            'contain' => ['Menus', 'Stores']
        ]);

        $this->set('storeMenuHistory', $storeMenuHistory);
        $this->set('_serialize', ['storeMenuHistory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            return;// $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        $this->request->allowMethod(['post']);
        if(isset($_GET['item']) && isset($_GET['store'])){
            $storeMenuHistory = $this->StoreMenuHistories->newEntity();
            $storeMenuHistory = $this->StoreMenuHistories->patchEntity($storeMenuHistory, 
                [   'menu_item_id' => intval($_GET['item']),
                    'store_id' => intval($_GET['store']),
                    'deleted' => false,
                    'store_menu_number' => 1,
                    'price' => 0,
                    'vending_mashine1' => true,
                    'vending_mashine2' => true]);
            $this->StoreMenuHistories->save($storeMenuHistory);
            debug($storeMenuHistory->errors());
            return $this->redirect(['action' => 'index', '?' => ['store' => $storeId]]);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Store Menu History id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        $storeMenuHistory = $this->StoreMenuHistories->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data();
            if($data['button'] === '登録') {
                $storeMenuHistory = $this->StoreMenuHistories->patchEntity($storeMenuHistory,[
                        'id' => $storeMenuHistory->id,
                        'price' => $data['price'],
                        'store_menu_number' => $data['store_menu_num'],
                        'vending_mashine1' => $data['vm1'],
                        'vending_mashine2' => $data['vm2'],
                        'sales_item_price' => $data['sales_item_price'],
                        'sales_item_cost' => $data['sales_item_cost']
                        ]);
                if ($this->StoreMenuHistories->save($storeMenuHistory)) {
                    $this->Flash->success('データの保存に成功しました');
                } else {
                    $this->Flash->error('データの保存に失敗しました');
                }
            }
            return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Store Menu History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $storeMenuHistory = $this->StoreMenuHistories->get($id);
        if ($this->StoreMenuHistories->delete($storeMenuHistory)) {
            $this->Flash->success(__('The store menu history has been deleted.'));
        } else {
            $this->Flash->error(__('The store menu history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
