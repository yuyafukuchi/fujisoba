<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * SalesItemTransactions Controller
 *
 * @property \App\Model\Table\SalesItemTransactionsTable $SalesItemTransactions
 *
 * @method \App\Model\Entity\SalesItemTransaction[] paginate($object = null, array $settings = [])
 */
class SalesItemTransactionsController extends AppController
{
    public $paginate = [
        'limit' => 4,
    ];
    

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->Session = $this->request->session();
        //$storeId = $this->Auth->user('store_id');
        $date = null;
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '設定') {
                if(strtotime($data['date'])){
                    $date = strtotime($data['date']);
                    $this->Session->write('SalesItemTransactions.date', $date);
                }
            }
        }
        if($date == null){
            if($this->Session->read('SalesItemTransactions.date') == null){
                $date = time();
                $this->Session->write('SalesItemTransactions.date', $date);
            } else {
                $date = $this->Session->read('SalesItemTransactions.date');
            }
        }
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        $salesItemHistories = null;
        if ($this->request->is('post')) {
            $data = $this->request->data();
            debug($data);
            if($data['button'] === '設定') {
                if(strtotime($data['date']['year'].'-'.$data['date']['month'])){
                    $date = strtotime($data['date']['year'].'-'.$data['date']['month']);
                    $this->Session->write('InventoryPurchaseTransactions.date', $date);
                }
            } else if($data['button'] === '検索'){
                $this->SalesItemHistories = TableRegistry::get('sales_item_histories');
                $salesItemHistories = $this->SalesItemHistories->find()
                    ->where(['sales_item_name LIKE' => '%'.$data['queryName'].'%']);
            }
        }
        $this->Stores = TableRegistry::get('stores');
        $storeName = $this->Stores->get($storeId)->name;
        //$salesItemTransactions = $this->SalesItemTransactions->find();
        
        $salesItemTransactions = array();
        if($salesItemHistories == null){
            $this->SalesItemHistories = TableRegistry::get('sales_item_histories');
            $salesItemHistories = $this->SalesItemHistories->find();
        }
        $salesItemHistories = $this->paginate($salesItemHistories);
        foreach ($salesItemHistories as $salesItemHistory) {
            $array = $this->SalesItemTransactions->find()
                ->where(['sales_item_id' => $salesItemHistory->sales_item_id])
                ->contain(['SalesTransactions'])->toArray();
            array_push($salesItemTransactions, $array);
        }
        
        $this->set(compact('salesItemTransactions', 'salesItemHistories','date', 'storeName'));
        $this->set('_serialize', ['salesItemTransactions']);
    }

    /**
     * View method
     *
     * @param string|null $id Sales Item Transaction id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesItemTransaction = $this->SalesItemTransactions->get($id, [
            'contain' => ['SalesTransactions', 'SalesItems']
        ]);

        $this->set('salesItemTransaction', $salesItemTransaction);
        $this->set('_serialize', ['salesItemTransaction']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesItemTransaction = $this->SalesItemTransactions->newEntity();
        if ($this->request->is('post')) {
            $salesItemTransaction = $this->SalesItemTransactions->patchEntity($salesItemTransaction, $this->request->getData());
            if ($this->SalesItemTransactions->save($salesItemTransaction)) {
                $this->Flash->success(__('The sales item transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales item transaction could not be saved. Please, try again.'));
        }
        $salesTransactions = $this->SalesItemTransactions->SalesTransactions->find('list', ['limit' => 200]);
        $salesItems = $this->SalesItemTransactions->SalesItems->find('list', ['limit' => 200]);
        $this->set(compact('salesItemTransaction', 'salesTransactions', 'salesItems'));
        $this->set('_serialize', ['salesItemTransaction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Item Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesItemTransaction = $this->SalesItemTransactions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesItemTransaction = $this->SalesItemTransactions->patchEntity($salesItemTransaction, $this->request->getData());
            if ($this->SalesItemTransactions->save($salesItemTransaction)) {
                $this->Flash->success(__('The sales item transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales item transaction could not be saved. Please, try again.'));
        }
        $salesTransactions = $this->SalesItemTransactions->SalesTransactions->find('list', ['limit' => 200]);
        $salesItems = $this->SalesItemTransactions->SalesItems->find('list', ['limit' => 200]);
        $this->set(compact('salesItemTransaction', 'salesTransactions', 'salesItems'));
        $this->set('_serialize', ['salesItemTransaction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Item Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesItemTransaction = $this->SalesItemTransactions->get($id);
        if ($this->SalesItemTransactions->delete($salesItemTransaction)) {
            $this->Flash->success(__('The sales item transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The sales item transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
