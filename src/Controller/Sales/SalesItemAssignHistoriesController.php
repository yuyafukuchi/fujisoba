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
        // $storeId = 1;
        $this->Session = $this->request->session();
        $companyID = $this->Session->read('Auth.Users.company_id');
        $this->paginate = [
            'contain' => ['SalesItems']
        ];
        $date = null;
        if ($this->request->is('post')) {
            $data = $this->request->data();
            debug($data);die;
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
        //設定日で有効なデータを取得

        $salesItemAssignHistories = $this->SalesItemAssignHistories->find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]]);

        $this->SalesItemHistories = TableRegistry::get('sales_item_histories');
        $salesItemHistories = $this->SalesItemHistories->find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
            ->contain(['SalesItems'])
            ->where(['company_id' => $companyID])
            ->where(['deleted' => '0']);

        $this->MenuHistories = TableRegistry::get('menu_histories');
        $menuHistories = $this->MenuHistories->find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
            ->contain(['menus'])
            ->where(['company_id' => $companyID])
            ->orwhere(['company_id' => 0])
            ->where(['deleted' => '0']);

        $assignArray = array();
        foreach($salesItemAssignHistories as $salesItemAssignHistory) {
            if(!array_key_exists($salesItemAssignHistory->menu_item_id, $assignArray)){
                $assignArray += [$salesItemAssignHistory->menu_item_id => array()];
            }
            array_push($assignArray[$salesItemAssignHistory->menu_item_id], $salesItemAssignHistory->sales_item_id);
        }
        // debug($assignArray);
        $this->set(compact('salesItemAssignHistories', 'menuHistories','salesItemHistories', 'assignArray', 'date'));
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
        // debug($data);die;
        $salesItemAssignHistories = $this->SalesItemAssignHistories->find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
            ->where(['menu_item_id' => $menuItemId]);

        // debug($salesItemAssignHistories->menu_item_id);die;
        $int = 0;
        foreach($salesItemAssignHistories as $salesItemAssignHistory){
            //新しいやつ
            $salesItemAssignHistory = $this->SalesItemAssignHistories->patchEntity($salesItemAssignHistory,
                [   'id' => $salesItemAssignHistory -> id ,
                    'end' => date('Y-m-d'.' 00:00:00',$date)]);
            if(!$this->SalesItemAssignHistories->save($salesItemAssignHistory)){
                $this->Flash->error('データの変更に失敗しました');
            }
            // debug($salesItemAssignHistory);die;
            // $int = $int + 1;
        }
        // debug($int);die;
        // debug($data['button']);die;
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
        // return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
        return $this->redirect(['action' => 'index']);

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
