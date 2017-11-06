<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
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
        $this->paginate = [
            'contain' => ['Menus', 'Stores']
        ];
        $storeMenuHistories = $this->paginate($this->StoreMenuHistories);
        $date = null;
        if($date == null){
            if($this->Session->read('StoreMenuHistories.date') == null){
                $date = time();
            } else {
                $date = $this->Session->read('StoreMenuHistories.date');
                $this->Session->write('StoreMenuHistories.date', $date);
            }
        }
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        $this->MenuHistories = TableRegistry::get('menu_histories');
        $menuHistories = $this->MenuHistories -> find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
            ->contain(['Menus']);
        $idArray = array();
        foreach ($storeMenuHistories as $storeMenuHistory){
            array_push($idArray, $storeMenuHistory->menu_item_id);
        }

        $this->set(compact('storeMenuHistories', 'menuHistories','date', 'idArray', 'storeId'));
        $this->set('_serialize', ['storeMenuHistories']);
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
                    'store_menu_number' => 0,
                    'price' => 0,
                    'vending_mashine1' => false,
                    'vending_mashine2' => false]);
            $this->StoreMenuHistories->save($storeMenuHistory);
            debug($storeMenuHistory->errors());
            //return $this->redirect(['action' => 'index', '?' => ['store' => $storeId]]);
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
        $storeMenuHistory = $this->StoreMenuHistories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $storeMenuHistory = $this->StoreMenuHistories->patchEntity($storeMenuHistory, $this->request->getData());
            if ($this->StoreMenuHistories->save($storeMenuHistory)) {
                $this->Flash->success(__('The store menu history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The store menu history could not be saved. Please, try again.'));
        }
        $menuItems = $this->StoreMenuHistories->MenuItems->find('list', ['limit' => 200]);
        $stores = $this->StoreMenuHistories->Stores->find('list', ['limit' => 200]);
        $this->set(compact('storeMenuHistory', 'menuItems', 'stores'));
        $this->set('_serialize', ['storeMenuHistory']);
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
