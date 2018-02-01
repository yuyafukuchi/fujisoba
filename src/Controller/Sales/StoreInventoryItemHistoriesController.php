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
        $companyID = $this->Session->read('Auth.Users.company_id');
         if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '設定') {
                if(strtotime($data['date'])){
                    $date = strtotime($data['date']);
                    $this->Session->write('StoreInventoryItemHistories.date', $date);
                }
            }
        }
        if($date == null){
            if($this->Session->read('StoreInventoryItemHistories.date') == null){
                $date = time();
            } else {
                $date = $this->Session->read('StoreInventoryItemHistories.date');
                $this->Session->write('StoreInventoryItemHistories.date', $date);
            }
        }
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            // debug($storeId);die;
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }

        $storeInventoryItemHistories = $this->StoreInventoryItemHistories->find()
            ->where(['StoreInventoryItemHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['StoreInventoryItemHistories.end >' => date('Y-m-d H:i:s', $date)],['StoreInventoryItemHistories.end is' => null]]])
            // ->contain(['Stores', 'InventoryItems','InventoryItems.InventoryItemHistories'])
            ->contain(['Stores', 'InventoryItems','InventoryItemHistories'])
            ->where(['InventoryItemHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['InventoryItemHistories.end >' => date('Y-m-d H:i:s', $date)],['InventoryItemHistories.end is' => null]]])
            ->where(['store_id' => $storeId])
            ->where(['StoreInventoryItemHistories.deleted' => '0']);


        $this->InventoryItemHistories = TableRegistry::get('inventory_item_histories');
        $inventoryItemHistories = $this->InventoryItemHistories -> find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
            ->contain(['InventoryItems'])
            ->where(['company_id' => $companyID])
            ->where(['deleted' => '0']);



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
        $this->Session = $this->request->session();
        if($this->Session->read('StoreInventoryItemHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('StoreInventoryItemHistories.date');
            $this->Session->write('StoreInventoryItemHistories.date', $date);
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
            $storeInventoryItemHistory = $this->StoreInventoryItemHistories->newEntity();
            $storeInventoryItemHistory = $this->StoreInventoryItemHistories->patchEntity($storeInventoryItemHistory,
                [   'inventory_item_id' => intval($_GET['item']),
                    'store_id' => intval($_GET['store']),
                    'start' => date('Y-m-d'.' 00:00:00',$date),
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
    //もともとやつ
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
    */

    //新しいやつ
    public function edit($id = null)
    {
        $this->Session = $this->request->session();
        $this->request->allowMethod(['post']);

        if($this->Session->read('StoreInventoryItemHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('StoreInventoryItemHistories.date');
            $this->Session->write('StoreInventoryItemHistories.date', $date);
        }

        if(isset($_GET['inventory_item_id'])){
            $inventoryItemId = intval($_GET['inventory_item_id']);
        } else {
            $inventoryItemId = 0;
        }
        if($inventoryItemId === 0) {

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
        debug($data);

        // $storeInventoryItemHistory = $this->StoreInventoryItemHistories->find()
        //     ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
        //     ->where(['inventory_item_id' => $inventoryItemId]);

        //設定日で有効な履歴
        $storeInventoryItemHistory = $this->StoreInventoryItemHistories->find()
            ->where(['StoreInventoryItemHistories.id' => $id])
            ->contain(['InventoryItems'])
            ->where(['deleted' => '0'])
            ->toArray()[0];

        // debug($storeInventoryItemHistory);die;

        //設定日からみた最古の未来データのstart
        $future_start = $this->StoreInventoryItemHistories->find()
            ->where(['StoreInventoryItemHistories.inventory_item_id' => $storeInventoryItemHistory['inventory_item_id']])
            ->contain(['InventoryItems'])
            ->where(['start >' => date('Y-m-d H:i:s', $date)])
            ->where(['deleted' => '0'])
            ->min('start');

    // debug($storeInventoryItemHistory);
    // debug($future_start);die;

        //flag
        $flag_future = 0;
        if(!$future_start == null){
            $flag_future = 1;
        }

        //新しい挿入データ
        $new_storeInventoryItemHistory = $this->StoreInventoryItemHistories->newEntity();
        $new_storeInventoryItemHistory = $this->StoreInventoryItemHistories->patchEntity($new_storeInventoryItemHistory,[
            'inventory_item_id' => $storeInventoryItemHistory['inventory_item_id'],
            'store_id' => $storeId,
            'loss_price' => $data['loss_price'],
            'price' => $data['price'],
            'cost' => $data['cost'],
            'start' => date('Y-m-d'.' 00:00:00',$date),
            'deleted' => false]);
        //過去データのendを変更
        $storeInventoryItemHistory = $this->StoreInventoryItemHistories->patchEntity($storeInventoryItemHistory,[
            'id' => $storeInventoryItemHistory->id,
            'end' => date('Y-m-d'.' 00:00:00',$date)]);
        //未来データがあるとき
        if($flag_future){
            //挿入データのendを設定
            $new_storeInventoryItemHistory = $this->StoreInventoryItemHistories->patchEntity($new_storeInventoryItemHistory,[
                'end' => $future_start['start'],
                'deleted' => false]);
        }

        if($this->StoreInventoryItemHistories->save($new_storeInventoryItemHistory)){
            if($flag_future){
                if($this->StoreInventoryItemHistories->save($storeInventoryItemHistory)){
                    $this->Flash->success('データの変更に成功しました(new-past-future');
                    return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
                } else {
                    $this->Flash->error('データの変更に失敗しました(past-future');
                }
            } else {
                if($this->StoreInventoryItemHistories->save($storeInventoryItemHistory)){
                    $this->Flash->success('データの変更に成功しました(new-past');
                    return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
                } else {
                    $this->Flash->error('データの変更に失敗しました(past)');
                }
            }

            $this->Flash->success('データの変更に成功しました');
            return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
        } else {
            $this->Flash->error('データの変更に失敗しました(new)');
        }


        // foreach($storeInventoryItemHistories as $storeInventoryItemHistory){
        //     //新しいやつ
        //     $storeInventoryItemHistory = $this->StoreInventoryItemHistories->patchEntity($storeInventoryItemHistory,
        //         [   'id' => $storeInventoryItemHistory -> id ,
        //             'price' => $data['price'],
        //             'loss_price' => $data['loss_price'],
        //             'cost' => $data['cost'],
        //             'end' => date('Y-m-d'.' 00:00:00',$date)]);
        //     if(!$this->StoreInventoryItemHistories->save($storeInventoryItemHistory)){
        //         $this->Flash->error('データの変更に失敗しました');
        //     }
        // }
        // unset($data['button']);
        // foreach($data as $inventoryItemId){
        //     debug($inventoryItemId);die;
        //     $storeInventoryItemHistory = $this->StoreInventoryItemHistories->newEntity();
        //     $storeInventoryItemHistory = $this->StoreInventoryItemHistories->patchEntity($storeInventoryItemHistory, [
        //         'inventory_item_id' => $inventoryItemId,
        //         'start' => date('Y-m-d 00:00:00', $date)]);
        //     $this->StoreInventoryItemHistories->save($storeInventoryItemHistory);
        //     debug($storeInventoryItemHistory->errors());
        // }
        $this->set(compact('storeInventoryItemHistories', 'inventoryItemHistories', 'idArray', 'date', 'storeId','data'));
        return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
        // return $this->redirect(['action' => 'index']);

    }

    /**
     * Delete method
     *
     * @param string|null $id Store Inventory Item History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     //元々のやつ
     /*
    public function delete($id = null)
    {
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            debug($storeId);die;
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
    */

    //新しいやつ
    public function delete($id = null)
    {
        // $data = $this->request->data;
        // debug($data);die;
        $this->Session = $this->request->session();
        $this->request->allowMethod(['post']);

        if($this->Session->read('StoreInventoryItemHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('StoreInventoryItemHistories.date');
            $this->Session->write('StoreInventoryItemHistories.date', $date);
        }

        if(isset($_GET['inventory_item_id'])){
            $inventoryItemId = intval($_GET['inventory_item_id']);
        } else {
            $inventoryItemId = 0;
        }
        if($inventoryItemId === 0) {
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
        $storeInventoryItemHistory = $this->StoreInventoryItemHistories->find()
            ->where(['StoreInventoryItemHistories.id' => $id])
            ->contain(['InventoryItems'])
            ->where(['deleted' => '0'])
            ->toArray()[0];

        // debug($storeInventoryItemHistory);die;

        //設定日からみた未来データ
        $future_storeInventoryItemHistories = $this->StoreInventoryItemHistories->find()
            ->where(['StoreInventoryItemHistories.inventory_item_id' => $storeInventoryItemHistory['inventory_item_id']])
            ->contain(['InventoryItems'])
            ->where(['start >' => date('Y-m-d H:i:s', $date)]);

        //削除した日を保存する新しいデータを登録する
        $deleted_storeInventoryItemHistory = $this->StoreInventoryItemHistories->newEntity();
        $deleted_storeInventoryItemHistory = $this->StoreInventoryItemHistories->patchEntity($deleted_storeInventoryItemHistory, [
            'inventory_item_id' => $storeInventoryItemHistory['inventory_item_id'],
            'store_id' => $storeId,
            'start' => date('Y-m-d'.' 00:00:00',$date),
            'end' => date('Y-m-d'.' 00:00:00',$date),
            'deleted' => true]);

        if($this->StoreInventoryItemHistories->save($deleted_storeInventoryItemHistory)){
            //有効なデータのendを設定日にする
            $storeInventoryItemHistory = $this->StoreInventoryItemHistories->patchEntity($storeInventoryItemHistory,[
                'id' => $storeInventoryItemHistory->id,
                'end' => date('Y-m-d',$date).' 00:00:00']);
            if($this->StoreInventoryItemHistories->save($storeInventoryItemHistory)){
                //未来データもdeleted = trueにする
                foreach ($future_storeInventoryItemHistories as $future_storeInventoryItemHistory) {
                    $future_storeInventoryItemHistory = $this->StoreInventoryItemHistories->patchEntity($future_storeInventoryItemHistory,[
                        'id' => $future_storeInventoryItemHistory->id,
                        'deleted' => true]);
                        if($this->StoreInventoryItemHistories->save($future_storeInventoryItemHistory)){
                        } else {
                            $this->Flash->error('未来データの更新(deleted=true)に失敗しました');
                            return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
                        }
                }
                $this->Flash->success('データの削除設定に成功しました');
                return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
            } else {
                $this->Flash->error('データの変更に失敗しました(有効なやつ)');
                return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
            }
        } else {
            $this->Flash->error('データの更新に失敗しました(deleted)');
            return $this->redirect(['action' => 'index','?' => ['store' => $storeId]]);
        }
    }
}
