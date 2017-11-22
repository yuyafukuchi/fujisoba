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

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
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
