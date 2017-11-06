<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * StoreInventoryItemHistories Controller
 *
 * @property \App\Model\Table\StoreInventoryItemHistoriesTable $StoreInventoryItemHistories
 *
 * @method \App\Model\Entity\StoreInventoryItemHistory[] paginate($object = null, array $settings = [])
 */
class StoreInventoryItemHistoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function index()
    {
        $date = null;
        $this->Session = $this->request->session();
         if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '設定') {
                if(strtotime($data['date'])){
                    $date = strtotime($data['date']);
                    $this->Session->write('InventoryItemHistories.date', $date);
                }
            }
        }
        if($date == null){
            if($this->Session->read('InventoryItemHistories.date') == null){
                $date = time();
            } else {
                $date = $this->Session->read('InventoryItemHistories.date');
                $this->Session->write('InventoryItemHistories.date', $date);
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
        $storeInventoryItemHistories = $this->StoreInventoryItemHistories->find()
            ->where(['store_id' => $storeId])->contain(['Stores', 'InventoryItems','InventoryItems.InventoryItemHistories']);
        $this->InventoryItemHistories = TableRegistry::get('inventory_item_histories');
         $inventoryItemHistories = $this->InventoryItemHistories -> find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]]);
        $idArray = array();
        foreach ($storeInventoryItemHistories as $storeInventoryItemHistory){
            array_push($idArray, $storeInventoryItemHistory->inventory_item_id);
        }
        $this->set(compact('storeInventoryItemHistories', 'inventoryItemHistories', 'idArray', 'date', 'storeId'));
        $this->set('_serialize', ['storeInventoryItemHistories']);
    }

    /**
     * View method
     *
     * @param string|null $id Store Inventory Item History id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $storeInventoryItemHistory = $this->StoreInventoryItemHistories->get($id, [
            'contain' => ['InventoryItems', 'Stores']
        ]);

        $this->set('storeInventoryItemHistory', $storeInventoryItemHistory);
        $this->set('_serialize', ['storeInventoryItemHistory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        $this->request->allowMethod(['post']);
        if(isset($_GET['item']) && isset($_GET['store'])){
            $storeInventoryItemHistory = $this->StoreInventoryItemHistories->newEntity();
            $storeInventoryItemHistory = $this->StoreInventoryItemHistories->patchEntity($storeInventoryItemHistory, 
                [   'inventory_item_id' => intval($_GET['item']),
                    'store_id' => intval($_GET['store']),
                    'deleted' => false]);
            $this->StoreInventoryItemHistories->save($storeInventoryItemHistory);
            return $this->redirect(['action' => 'index', '?' => ['store' => $storeId]]);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Store Inventory Item History id.
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
        $storeInventoryItemHistory = $this->StoreInventoryItemHistories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            debug($this->request->data());
            $data = $this->request->data();
            $storeInventoryItemHistory = $this->StoreInventoryItemHistories->patchEntity($storeInventoryItemHistory, 
                [   'id' => $id,
                    'price' => $data['price'.$id],
                    'cost' => $data['cost'.$id]]);
            if ($this->StoreInventoryItemHistories->save($storeInventoryItemHistory)) {
                $this->Flash->success(__('The store inventory item history has been saved.'));

                return $this->redirect(['action' => 'index','?'=>['store' => $storeId]]);
            }
            $this->Flash->error(__('The store inventory item history could not be saved. Please, try again.'));
        }
        $inventoryItems = $this->StoreInventoryItemHistories->InventoryItems->find('list', ['limit' => 200]);
        $stores = $this->StoreInventoryItemHistories->Stores->find('list', ['limit' => 200]);
        $this->set(compact('storeInventoryItemHistory', 'inventoryItems', 'stores'));
        $this->set('_serialize', ['storeInventoryItemHistory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Store Inventory Item History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $storeInventoryItemHistory = $this->StoreInventoryItemHistories->get($id);
        if ($this->StoreInventoryItemHistories->delete($storeInventoryItemHistory)) {
            $this->Flash->success(__('The store inventory item history has been deleted.'));
        } else {
            $this->Flash->error(__('The store inventory item history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', '?' => ['store' => $storeId ]]);
    }
}
