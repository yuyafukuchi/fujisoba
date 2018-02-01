<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

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
     //元々のやつ
     /*
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

        $this->paginate = [
            //'contain' => ['Menus', 'Stores'],
            'matching' => ['SalesItemAssignHistories']
        ];

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
                    $this->Session->write('StoreMenuHistories.date', $date);
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
        //表示するマスタメニューを会社ごとに変える
        $companyID = $this->Session->read('Auth.Users.company_id');
        if($companyID == 3){
            $companyNumber = 6000;
        } else {
            $companyNumber = 2000;
        }
        //
        $this->MenuHistories = TableRegistry::get('menu_histories');
        $menuHistories = $this->MenuHistories -> find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
            ->contain(['Menus'])
            ->where([['menu_number >=' => $companyNumber+1],['menu_number <=' => $companyNumber+999]])
            ->orwhere(['menu_number <=' => 1000])
            ->order(['menu_number' => 'ASC']);
        $idArray = array();
        foreach ($storeMenuHistories as $storeMenuHistory){
            array_push($idArray, $storeMenuHistory->menu_item_id);
        }

        $this->set(compact('storeMenuHistories', 'menuHistories','date', 'idArray', 'storeId','storeName','companyID'));
        $this->set('_serialize', ['storeMenuHistories','salesItemAssignHistories']);
    }
    */

    //新しやつ
    public function index()
    {
        $date = null;
        $this->Session = $this->request->session();
        $companyID = $this->Session->read('Auth.Users.company_id');
         if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '設定') {
                if(strtotime($data['date'])){
                    $date = strtotime($data['date']);
                    $this->Session->write('StoreMenuHistories.date', $date);
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
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            debug($storeId);die;
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        $this->Stores = TableRegistry::get('stores');
        $storeName = $this->Stores->get($storeId)->name;

        $storeMenuHistories = $this->StoreMenuHistories->find()
            ->where(['StoreMenuHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['StoreMenuHistories.end >' => date('Y-m-d H:i:s', $date)],['StoreMenuHistories.end is' => null]]])
            ->contain(['Stores', 'Menus','MenuHistories','MenuHistories.SalesItemAssignHistories','MenuHistories.SalesItemAssignHistories.SalesItems','MenuHistories.SalesItemAssignHistories.SalesItems.SalesItemHistories'])
            ->where(['MenuHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['MenuHistories.end >' => date('Y-m-d H:i:s', $date)],['MenuHistories.end is' => null]]])
            ->where(['store_id' => $storeId])
            ->where(['StoreMenuHistories.deleted' => '0'])
            ->where(['SalesItemAssignHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['SalesItemAssignHistories.end >' => date('Y-m-d H:i:s', $date)],['SalesItemAssignHistories.end is' => null]]]);

        $this->MenuHistories = TableRegistry::get('menu_histories');



        $menuHistories = $this->MenuHistories -> find()
//             ->join([
// 				'table' => 'menus',
// 				'alias' => 'Menus',
// 				'type' => 'INNER',
// 				'conditions' => 'menu_item_id = Menus.id',
// 			])
// 			->join([
// 				'table' => 'sales_item_assign_histories',
// 				'alias' => 'SalesItemAssignHistories',
// 				'type' => 'LEFT',
// 				'conditions' => ['AND' => ['MenuHistories.menu_item_id = SalesItemAssignHistories.menu_item_id',['SalesItemAssignHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['SalesItemAssignHistories.end >' => date('Y-m-d H:i:s', $date)],['SalesItemAssignHistories.end is' => null]]]]]
// 			])
            // ->where(['MenusHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
            ->contain(['Menus','SalesItemAssignHistories','SalesItemAssignHistories.SalesItems.SalesItemHistories'])
            ->where(['OR' => ['Menus.company_id' => $companyID], ['Menus.company_id' => 0]])
            ->where(['SalesItemAssignHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['SalesItemAssignHistories.end >' => date('Y-m-d H:i:s', $date)],['SalesItemAssignHistories.end is' => null]]])
            ->where(['deleted' => '0']);







/*
        $menuHistories = $this->MenuHistories -> find()
            ->where(['MenuHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['MenuHistories.end >' => date('Y-m-d H:i:s', $date)],['MenuHistories.end is' => null]]])
            ->where(['OR' => [['Menus.company_id' => '0'], ['Menus.company_id' => $companyID]]])
            ->where(['MenuHistories.deleted' => '0'])
            ->join([
				'table' => 'menus',
				'alias' => 'Menus',
				'type' => 'INNER',
				'conditions' => 'MenuHistories.menu_item_id = Menus.id',
			])
			->join([
				'table' => 'sales_item_assign_histories',
				'alias' => 'SalesItemAssignHistories',
				'type' => 'LEFT',
				'conditions' => ['AND' => ['MenuHistories.menu_item_id = SalesItemAssignHistories.menu_item_id',['SalesItemAssignHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['SalesItemAssignHistories.end >' => date('Y-m-d H:i:s', $date)],['SalesItemAssignHistories.end is' => null]]]]]
			])
			->join([
				'table' => 'sales_items',
				'alias' => 'SalesItems',
				'type' => 'LEFT',
				'conditions' => 'SalesItems.id = SalesItemAssignHistories.sales_item_id',
			])
			->join([
				'table' => 'sales_item_histories',
				'alias' => 'SalesItemHistories',
				'type' => 'LEFT',
				// 'conditions' => 'SalesItems.id = SalesItemHistories.sales_item_id',
				'conditions' => ['AND' => ['SalesItems.id = SalesItemHistories.sales_item_id',['SalesItemHistories.start <=' => date('Y-m-d H:i:s', $date),'SalesItemHistories.deleted = 0', 'OR' => [['SalesItemHistories.end >' => date('Y-m-d H:i:s', $date)],['SalesItemHistories.end is' => null]]]]]
			])
			->select([
			    'id',
			    'menu_item_id',
			    'name',
			    'start',
			    'end',
			    'deleted',
			    'Menus.id',
			    'Menus.menu_number',
			    'Menus.company_id',
			    'SalesItemAssignHistories.id',
				"SalesItemAssignHistories.menu_item_id",
				'SalesItemAssignHistories.sales_item_id',
				'SalesItemAssignHistories.start',
				'SalesItems.id',
				'SalesItems.company_id',
				'SalesItems.sales_item_number',
				'SalesItemHistories.sales_item_name',
				'SalesItemHistories.start',
				'SalesItemHistories.end',
				'SalesItemHistories.deleted'
			]);

*/


        $idArray = array();
        foreach ($storeMenuHistories as $storeMenuHistory){
            array_push($idArray, $storeMenuHistory->menu_item_id);
        }
        $this->set(compact('storeMenuHistories', 'menuHistories', 'idArray', 'date', 'storeId','storeName'));
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
    {
        $this->Session = $this->request->session();
        if($this->Session->read('StoreMenuHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('StoreMenuHistories.date');
            $this->Session->write('StoreMenuHistories.date', $date);
        }
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            debug($storeId);die;
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        $this->request->allowMethod(['post']);
        if(isset($_GET['item']) && isset($_GET['store'])){
            $storeMenuHistory = $this->StoreMenuHistories->newEntity();
            $storeMenuHistory = $this->StoreMenuHistories->patchEntity($storeMenuHistory,
                [   'menu_item_id' => intval($_GET['item']),
                    'store_id' => intval($_GET['store']),
                    'store_menu_number' => 0,
                    'price' => 0,
                    'vending_mashine1' => true,
                    'vending_mashine2' => true,
                    'sales_item_price' => 0,
                    'sales_item_cost' => 0,
                    'start' => date('Y-m-d'.' 00:00:00',$date),
                    'deleted' => false]);
            if(!$this->StoreMenuHistories->save($storeMenuHistory)){
                debug($storeMenuHistory->errors());die;
            }


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
     //元々のやつ
     /*
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
                        'store_menu_number' => $data['store_menu_number'],
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
    */

    //新しいやつ
    public function edit($id = null)
    {
        $this->Session = $this->request->session();
        $this->request->allowMethod(['post']);

        if($this->Session->read('StoreMenuHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('StoreMenuHistories.date');
            $this->Session->write('StoreMenuHistories.date', $date);
        }

        if(isset($_GET['menu_item_id'])){
            $menuItemId = intval($_GET['menu_item_id']);
        } else {
            $menuItemId = 0;
        }
        if($menuItemId === 0) {
            debug($menuItemId);die;
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }

        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            debug($storeId);die;
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }

        $data = $this->request->data;
        // debug($data);

        //設定日で有効な履歴
        $storeMenuHistory = $this->StoreMenuHistories->find()
            ->where(['StoreMenuHistories.id' => $id])
            ->contain(['Menus'])
            ->where(['deleted' => '0'])
            ->toArray()[0];

        //設定日からみた最古の未来データのstart
        $future_start = $this->StoreMenuHistories->find()
            ->where(['StoreMenuHistories.menu_item_id' => $storeMenuHistory['menu_item_id']])
            ->contain(['Menus'])
            ->where(['start >' => date('Y-m-d H:i:s', $date)])
            ->where(['deleted' => '0'])
            ->min('start');

        //flag
        $flag_future = 0;
        if(!$future_start == null){
            $flag_future = 1;
        }

        //新しい挿入データ
        $new_storeMenuHistory = $this->StoreMenuHistories->newEntity();
        $new_storeMenuHistory = $this->StoreMenuHistories->patchEntity($new_storeMenuHistory,[
            'menu_item_id' => $storeMenuHistory['menu_item_id'],
            'store_id' => $storeId,
            'store_menu_number' => $data['store_menu_number'],
            'price' => $data['price'],
            'vending_mashine1' => $data['vm1'],
            'vending_mashine2' => $data['vm2'],
            'sales_item_price' => $data['sales_item_price'],
            'sales_item_cost' => $data['sales_item_cost'],
            'start' => date('Y-m-d'.' 00:00:00',$date),
            'deleted' => false]);
        //過去データのendを変更
        $storeMenuHistory = $this->StoreMenuHistories->patchEntity($storeMenuHistory,[
            'id' => $storeMenuHistory->id,
            'end' => date('Y-m-d'.' 00:00:00',$date)]);
        //未来データがあるとき
        if($flag_future){
            //挿入データのendを設定
            $new_storeMenuHistory = $this->StoreMenuHistories->patchEntity($new_storeMenuHistory,[
                'end' => $future_start['start'],
                'deleted' => false]);
        }

        if($this->StoreMenuHistories->save($new_storeMenuHistory)){
            if($flag_future){
                if($this->StoreMenuHistories->save($storeMenuHistory)){
                    $this->Flash->success('データの変更に成功しました(new-past-future');
                    // debug($storeId);die;
                    return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
                } else {
                    $this->Flash->error('データの変更に失敗しました(past-future');
                }
            } else {
                if($this->StoreMenuHistories->save($storeMenuHistory)){
                    $this->Flash->success('データの変更に成功しました(new-past');
                    // debug($storeId);die;
                    return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
                } else {
                    $this->Flash->error('データの変更に失敗しました(past)');
                }
            }

            $this->Flash->success('データの変更に成功しました');
            // debug($storeId);die;
            return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
        } else {
            $this->Flash->error('データの変更に失敗しました(new)');
        }

        $this->set(compact('storeInventoryItemHistories', 'inventoryItemHistories', 'idArray', 'date', 'storeId','data'));
        return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
        // return $this->redirect(['action' => 'index']);

    }

    /**
     * Delete method
     *
     * @param string|null $id Store Menu History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     //もともとのやつ
     /*
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
    */

    //新しいやつ
    public function delete($id = null)
    {
        $this->Session = $this->request->session();
        $this->request->allowMethod(['post']);

        if($this->Session->read('StoreMenuHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('StoreMenuHistories.date');
            $this->Session->write('StoreMenuHistories.date', $date);
        }

        if(isset($_GET['menu_item_id'])){
            $menuItemId = intval($_GET['menu_item_id']);
        } else {
            $menuItemId = 0;
        }
        if($menuItemId === 0) {
            debug($menuItemId);die;
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }

        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            debug($storeId);die;
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }

        //設定日で有効な履歴
        $storeMenuHistory = $this->StoreMenuHistories->find()
            ->where(['StoreMenuHistories.id' => $id])
            ->contain(['Menus'])
            ->where(['deleted' => '0'])
            ->toArray()[0];

        //設定日からみた未来データ
        $future_storeMenuHistories = $this->StoreMenuHistories->find()
            ->where(['StoreMenuHistories.menu_item_id' => $storeMenuHistory['menu_item_id']])
            ->contain(['Menus'])
            ->where(['start >' => date('Y-m-d H:i:s', $date)]);

        //削除した日を保存する新しいデータを登録する
        $deleted_storeMenuHistory = $this->StoreMenuHistories->newEntity();
        $deleted_storeMenuHistory = $this->StoreMenuHistories->patchEntity($deleted_storeMenuHistory, [
            'menu_item_id' => $storeMenuHistory['menu_item_id'],
            'store_id' => $storeId,
            'store_menu_number' => $storeMenuHistory['store_menu_number'],
            'price' => $storeMenuHistory['price'],
            'vending_mashine1' => $storeMenuHistory['vending_mashine1'],
            'vending_mashine2' => $storeMenuHistory['vending_mashine2'],
            'sales_item_price' => $storeMenuHistory['sales_item_price'],
            'sales_item_cost' => $storeMenuHistory['sales_item_cost'],
            'start' => date('Y-m-d'.' 00:00:00',$date),
            'end' => date('Y-m-d'.' 00:00:00',$date),
            'deleted' => true]);
        // debug($deleted_storeMenuHistory);die;

        if($this->StoreMenuHistories->save($deleted_storeMenuHistory)){
            //有効なデータのendを設定日にする
            $storeMenuHistory = $this->StoreMenuHistories->patchEntity($storeMenuHistory,[
                'id' => $storeMenuHistory->id,
                'end' => date('Y-m-d',$date).' 00:00:00']);
            if($this->StoreMenuHistories->save($storeMenuHistory)){
                //未来データもdeleted = trueにする
                foreach ($future_storeMenuHistories as $future_storeMenuHistory) {
                    $future_storeMenuHistory = $this->StoreMenuHistories->patchEntity($future_storeMenuHistory,[
                        'id' => $future_storeMenuHistory->id,
                        'deleted' => true]);
                        if($this->StoreMenuHistories->save($future_storeMenuHistory)){
                        } else {
                            $this->Flash->error('未来データの更新(deleted=true)に失敗しました');
                            return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
                        }
                }
                $this->Flash->success('データの削除設定に成功しました');
                // debug($storeId);die;
                return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
            } else {
                $this->Flash->error('データの変更に失敗しました(有効なやつ)');
                return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
            }
        } else {
            $this->Flash->error('データの更新に失敗しました(deleted)');
            return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
        }

        // $this->set(compact('storeMenuHistories', 'menuHistories', 'idArray', 'date', 'storeId','storeName'));
    }
}
