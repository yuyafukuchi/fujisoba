<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * SalesTransactions Controller
 *
 * @property \App\Model\Table\SalesTransactionsTable $SalesTransactions
 *
 * @method \App\Model\Entity\SalesTransaction[] paginate($object = null, array $settings = [])
 */
class SalesTransactionsController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => '/../Users',
                'action' => 'login',
            ],
            'authError' => 'このページを見るためにはログインが必要です',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'name','password' => 'password']    // ログインID対象をemailカラムへ
                ]
            ]
        ]);
        $this->Auth->sessionKey = 'Auth.Users';
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Stores', 'Menus']
        ];
        $salesTransactions = $this->paginate($this->SalesTransactions);

        $this->set(compact('salesTransactions'));
        $this->set('_serialize', ['salesTransactions']);
    }

    /**
     * View method
     *
     * @param string|null $id Sales Transaction id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {



        // // debug($this->request->data());
        // $this->paginate = [
        //     'contain' => ['Stores', 'Accounts']
        // ];
        // if(isset($_GET['store'])){
        //     $storeId = intval($_GET['store']);
        // } else {
        //     $storeId = 0;
        // }
        // if($storeId === 0) {
        //     return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        // }
        // if ($this->request->is('post')) {
        //     $data = $this->request->data()['transaction_month'];
        //     $date = strtotime($data['year'].'-'.$data['month']);
        // } else {
        //     $date = strtotime(date('Y-m',time()));
        // }
        // $cashAccountTrans =$this->CashAccountTrans->find()->where(['store_id' => $storeId, 'transaction_date >=' => date('Y-m-d',$date), 'transaction_date <' => date('Y-m-d',strtotime('+1 month', $date))])
        //                             ->order(['transaction_date' => 'ASC']);
        // $this->Session = $this->request->session();
        // $this->Session->write('CashAccountTrans.newTrans', array());
        // $this->Session->write('CashAccountTrans.date',null);
        // $date = explode('-',date('Y-m',$date));
        // $accounts = $this->CashAccountTrans->Accounts->find('list', ['limit' => 200]);
        // $this->set(compact('cashAccountTrans', 'date', 'accounts'));
        // $this->set('_serialize', ['cashAccountTrans']);


        $this->Session = $this->request->session();
        $salesTransactions = $this->SalesTransactions->find();
        $date = null;
        // debug($date);die;

        if(isset($_GET['store'])){ //値があるかどうかを確認
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }

        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '設定') {
                if(strtotime($data['date']['year'].'-'.$data['date']['month'])){
                    $date = strtotime($data['date']['year'].'-'.$data['date']['month']);  //date取得
                    $this->Session->write('SalesTransactions.date', $date);

                }
            }
        }

        if($date == null){
            if($this->Session->read('SalesTransactions.date') == null){
                $date = time();
                $this->Session->write('SalesTransactions.date', $date);
            } else {
                $date = $this->Session->read('SalesTransactions.date');
            }
        }
        $this->Stores = TableRegistry::get('stores');
        $this->SalesDailySummaries=TableRegistry::get('sales_daily_summaries');
        $this->CashAccountTrans = TableRegistry::get('cash_account_trans');
        $this->StoreInventoryItemHistories = TableRegistry::get('store_inventory_item_histories');
        $this->InventoryPurchaseTransactions= TableRegistry::get('inventory_purchase_transactions');
        $salesDailySummary = $this->SalesDailySummaries->find()
                            ->where(['store_id'=>$storeId])
                            ->where(['transaction_date >=' => date('Y-m-d',$date), 'transaction_date <' => date('Y-m-d',strtotime('+1 month', $date))])
                            ->order(['transaction_date' => 'ASC'])
                            ->toArray();

        $cashAccountTrans =$this->CashAccountTrans->find()
                            ->where(['store_id' => $storeId, 'transaction_date >=' => date('Y-m-d',$date), 'transaction_date <' => date('Y-m-d',strtotime('+1 month', $date))])
                            ->order(['transaction_date' => 'ASC'])
                            ->toArray();
        $inventoryPurchaseTransactions = $this->InventoryPurchaseTransactions->find()
                            ->where(['transaction_date >=' => date('Y-m-d',$date), 'transaction_date <' => date('Y-m-d',strtotime('+1 month', $date))])
                            ->where(['store_id' => $storeId])
                            ->toArray();
//inventry_purchase_transactionからinventory_item_idとloss_qtyを抽出

        // $idArray=array();
        // for($i = 0 ; $i < count($inventoryPurchaseTransactions) ; $i ++){
        //     array_push($idArray,$inventoryPurchaseTransactions[$i]['inventory_item_id']);
        // }
        // $lossArray=array();
        // for($i = 0 ; $i < count($inventoryPurchaseTransactions) ; $i ++){
        //     array_push($lossArray,$inventoryPurchaseTransactions[$i]['loss_qty']);
        // }
        // for($i = 0 ; $i < count($inventoryPurchaseTransactions) ; $i ++){

        //     $inventoryPurchaseTransactionsArray=array($idArray[$i]=>$lossarray[$i]);
        // }
        // debug($inventoryPurchaseTransactionsArray);

//ロス数の配列を作る

        $lastDay = date('d', strtotime('last day of this month', $date));

        for($i = 1 ; $i <= $lastDay ; $i ++){
        $date2=strtotime(date('Y',$date).'-'.date('m',$date).'-'.date($i));

        $inventoryPurchaseTransactions = $this->InventoryPurchaseTransactions->find()
                            ->where(['transaction_date ' => date('Y-m-d',$date2)])
                            ->where(['store_id' => $storeId])
                            ->toArray();
        for($j = 0 ; $j < count($inventoryPurchaseTransactions) ; $j ++){
        $inventoryPurchaseTransactionsArray[$i][$j]=array($inventoryPurchaseTransactions[$j]['inventory_item_id']=>$inventoryPurchaseTransactions[$j]['loss_qty']);

        }
        }

//価格(ロス)の配列を作る
        for($i = 1 ; $i <= $lastDay ; $i ++){
        $date2=strtotime(date('Y',$date).'-'.date('m',$date).'-'.date($i));
        $storeInventoryItemHistories = $this->StoreInventoryItemHistories->find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date2), 'OR' => [['end >' => date('Y-m-d H:i:s', $date2)],['end is' => null]]])
            ->where(['store_id' => $storeId])
            ->where(['deleted' => '0'])
            ->toArray();
        for($j = 0 ; $j < count($storeInventoryItemHistories) ; $j ++){
        $storeInventoryItemHistoryArray[$i][$j]=array($storeInventoryItemHistories[$j]['inventory_item_id']=>$storeInventoryItemHistories[$j]['loss_price']);

        }
        }




        if(count($this->Stores->find()->where(['id' => $storeId])->toArray()) === 1){
            $storeName = $this->Stores->get($storeId)->name;
        } else {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }

        $this->set(compact('salesTransactions','storeName','date','salesDailySummary','inventoryPurchaseTransactions','cashAccountTrans','idArray','storeInventoryItemHistories','lossArray','storeInventoryItemHistoryArray','inventoryPurchaseTransactionsArray'));
        $this->set('_serialize', ['salesTransactions','storeName','date','salesDailySummary','inventoryPurchaseTransactions','cashAccountTrans','idArray','storeInventoryItemHistories','lossArray','storeInventoryItemHistoryArray','inventoryPurchaseTransactionsArray']);

    }


    public function add()
    {
        $salesTransaction = $this->SalesTransactions->newEntity();
        if ($this->request->is('post')) {
            $salesTransaction = $this->SalesTransactions->patchEntity($salesTransaction, $this->request->getData());
            if ($this->SalesTransactions->save($salesTransaction)) {
                $this->Flash->success(__('The sales transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales transaction could not be saved. Please, try again.'));
        }
        $stores = $this->SalesTransactions->Stores->find('list', ['limit' => 200]);
        $menus = $this->SalesTransactions->Menus->find('list', ['limit' => 200]);
        $this->set(compact('salesTransaction', 'stores', 'menus'));
        $this->set('_serialize', ['salesTransaction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesTransaction = $this->SalesTransactions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesTransaction = $this->SalesTransactions->patchEntity($salesTransaction, $this->request->getData());
            if ($this->SalesTransactions->save($salesTransaction)) {
                $this->Flash->success(__('The sales transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales transaction could not be saved. Please, try again.'));
        }
        $stores = $this->SalesTransactions->Stores->find('list', ['limit' => 200]);
        $menus = $this->SalesTransactions->Menus->find('list', ['limit' => 200]);
        $this->set(compact('salesTransaction', 'stores', 'menus'));
        $this->set('_serialize', ['salesTransaction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesTransaction = $this->SalesTransactions->get($id);
        if ($this->SalesTransactions->delete($salesTransaction)) {
            $this->Flash->success(__('The sales transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The sales transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function detail() {
        $this->Session = $this->request->session();
        $salesTransactions = $this->SalesTransactions->find();
        $date = null;
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '設定') {
                if(strtotime($data['date']['year'].'-'.$data['date']['month'])){
                    $date = strtotime($data['date']['year'].'-'.$data['date']['month']);
                    $this->Session->write('SalesTransactions.date', $date);
                }
            }
        }
        if($date == null){
            if($this->Session->read('SalesTransactions.date') == null){
                $date = time();
                $this->Session->write('SalesTransactions.date', $date);
            } else {
                $date = $this->Session->read('SalesTransactions.date');
            }
        }
        $this->Stores = TableRegistry::get('stores');
        if(count($this->Stores->find()->where(['id' => $storeId])->toArray()) === 1){
            $storeName = $this->Stores->get($storeId)->name;
        } else {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        $this->set(compact('salesTransactions','storeName','date'));
    }

    public function all() {
        if($this->Auth->user('type') == 'H'){
            $this->Stores = TableRegistry::get('stores');
            $stores = $this->Stores->find()->select(['id','name'])->where(['company_id' => $this->Auth->user('company_id')]);
       } else {
           return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
       }
        $this->Session = $this->request->session();
        $salesTransactions = $this->SalesTransactions->find();
        $date = null;
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '設定') {
                if(strtotime($data['date']['year'].'-'.$data['date']['month'])){
                    $date = strtotime($data['date']['year'].'-'.$data['date']['month']);
                    $this->Session->write('SalesTransactions.date', $date);
                }
            }
        }
        if($date == null){
            if($this->Session->read('SalesTransactions.date') == null){
                $date = time();
                $this->Session->write('SalesTransactions.date', $date);
            } else {
                $date = $this->Session->read('SalesTransactions.date');
            }
        }
        $this->set(compact('salesTransactions','date','stores'));
    }
}
