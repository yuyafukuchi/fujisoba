<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * SalesItemAssignHistories Controller
 *
 * @property \App\Model\Table\SalesItemAssignHistoriesTable $SalesItemAssignHistories
 *
 * @method \App\Model\Entity\SalesItemAssignHistory[] paginate($object = null, array $settings = [])
 */
class SalesItemAssignHistoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $storeId = 1;
        $this->Session = $this->request->session();
        $this->paginate = [
            'contain' => ['SalesItems']
        ];
        $date = null;
        if ($this->request->is('post')) {
            $data = $this->request->data();
            debug($data);
            if($data['button'] === '設定') {
                if(strtotime($data['date'])){
                    $date = strtotime($data['date']);
                    $this->Session->write('SalesItemAssignHistories.date', $date);
                }
            }
        }
        if($date == null){
            if($this->Session->read('SalesItemAssignHistories.date') == null){
                $date = time();
            } else {
                $date = $this->Session->read('SalesItemAssignHistories.date');
                $this->Session->write('SalesItemAssignHistories.date', $date);
            }
        }
        $salesItemAssignHistories = $this->SalesItemAssignHistories->find();
        $this->StoreMenuHistories = TableRegistry::get('store_menu_histories');
        $storeMenuHistories = $this->StoreMenuHistories->find()->contain(['MenuHistories']);
        $this->SalesItemHistories = TableRegistry::get('sales_item_histories');
        $salesItemHistories = $this->SalesItemHistories->find()->contain(['SalesItems']);
        $assignArray = array();
        foreach($salesItemAssignHistories as $salesItemAssignHistory) {
            if(!array_key_exists($salesItemAssignHistory->menu_item_id, $assignArray)){
                $assignArray += [$salesItemAssignHistory->menu_item_id => array()];
            }
            array_push($assignArray[$salesItemAssignHistory->menu_item_id], $salesItemAssignHistory->sales_item_id);
        }
        debug($assignArray);
        $this->set(compact('salesItemAssignHistories', 'storeMenuHistories','salesItemHistories', 'assignArray', 'date'));
        $this->set('_serialize', ['salesItemAssignHistories']);
    }

    /**
     * View method
     *
     * @param string|null $id Sales Item Assign History id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesItemAssignHistory = $this->SalesItemAssignHistories->get($id, [
            'contain' => ['Menus', 'SalesItems']
        ]);

        $this->set('salesItemAssignHistory', $salesItemAssignHistory);
        $this->set('_serialize', ['salesItemAssignHistory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesItemAssignHistory = $this->SalesItemAssignHistories->newEntity();
        if ($this->request->is('post')) {
            $salesItemAssignHistory = $this->SalesItemAssignHistories->patchEntity($salesItemAssignHistory, $this->request->getData());
            if ($this->SalesItemAssignHistories->save($salesItemAssignHistory)) {
                $this->Flash->success(__('The sales item assign history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales item assign history could not be saved. Please, try again.'));
        }
        $menus = $this->SalesItemAssignHistories->Menus->find('list', ['limit' => 200]);
        $salesItems = $this->SalesItemAssignHistories->SalesItems->find('list', ['limit' => 200]);
        $this->set(compact('salesItemAssignHistory', 'menus', 'salesItems'));
        $this->set('_serialize', ['salesItemAssignHistory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Item Assign History id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        $this->Session = $this->request->session();
        $this->request->allowMethod(['post']);
        if($this->Session->read('SalesItemAssignHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('SalesItemAssignHistories.date');
            $this->Session->write('SalesItemAssignHistories.date', $date);
        }
        if(isset($_GET['menu_item_id'])){
            $menuItemId = intval($_GET['menu_item_id']);
        } else {
            $menuItemId = 0;
        }
        if($menuItemId === 0) {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        $data = $this->request->data;
        $salesItemAssignHistories = $this->SalesItemAssignHistories->find()->where(['menu_item_id' => $menuItemId]);
        foreach($salesItemAssignHistories as $salesItemAssignHistory){
            $this->SalesItemAssignHistories->delete($salesItemAssignHistory);
        }
        unset($data['button']);
        foreach($data as $salesItemId){
            $salesItemAssignHistory = $this->SalesItemAssignHistories->newEntity();
            $salesItemAssignHistory = $this->SalesItemAssignHistories->patchEntity($salesItemAssignHistory, [
                'sales_item_id' => $salesItemId, 
                'menu_item_id' => $menuItemId,
                'start' => date('Y-m-d 00:00:00', $date)]);
            $this->SalesItemAssignHistories->save($salesItemAssignHistory);
            debug($salesItemAssignHistory->errors());
        }
        return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);

    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Item Assign History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
        $this->request->allowMethod(['post', 'delete']);
        $salesItemAssignHistory = $this->SalesItemAssignHistories->get($id);
        if ($this->SalesItemAssignHistories->delete($salesItemAssignHistory)) {
            $this->Flash->success(__('The sales item assign history has been deleted.'));
        } else {
            $this->Flash->error(__('The sales item assign history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
