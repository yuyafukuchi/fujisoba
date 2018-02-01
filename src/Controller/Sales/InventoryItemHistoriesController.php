<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * InventoryItemHistories Controller
 *
 * @property \App\Model\Table\InventoryItemHistoriesTable $InventoryItemHistories
 *
 * @method \App\Model\Entity\InventoryItemHistory[] paginate($object = null, array $settings = [])
 */
class InventoryItemHistoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->Session = $this->request->session();
        $companyID = $this->Session->read('Auth.Users.company_id');
        $date = null;
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '新規作成'){
                if($data['name'] === ''){
                    $this->Flash->error('マスタ在庫アイテム名を入力してください。');
                } else {
                    $this->InventoryItems = TableRegistry::get('inventory_items');
                    if($this->Session->read('InventoryItemHistories.date') == null){
                        $date = time();
                    } else {
                        $date = $this->Session->read('InventoryItemHistories.date');
                        $this->Session->write('InventoryItemHistories.date', $date);
                    }
                    $inventoryItem = $this->InventoryItems->newEntity();
                    $inventoryItem = $this->InventoryItems->patchEntity($inventoryItem, [
                        'company_id' => $companyID]);
                    if($this->InventoryItems->save($inventoryItem)){
                        $inventoryItemHistory = $this->InventoryItemHistories->newEntity();
                        $inventoryItemHistory = $this->InventoryItemHistories->patchEntity($inventoryItemHistory, [
                                'inventory_item_id' => $inventoryItem['id'],
                                'item_name' => $data['name'],
                                'start' => date('Y-m-d'.' 00:00:00',$date),
                                'deleted' => false]);
                        if($this->InventoryItemHistories->save($inventoryItemHistory)){
                            $this->Flash->success('データの保存に成功しました');
                        } else {
                            debug($inventoryItem->errors());
                            $this->InventoryItems->delete($inventoryItem);
                            $this->Flash->error('データの保存に失敗しました');
                        }
                    } else {
                        $this->Flash->error('データの保存に失敗しました');
                    }
                }
            } else if($data['button'] === '設定') {
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
        // $this->paginate = [
        //     'contain' => ['InventoryItems']
        // ];
        $inventoryItemHistories = $this->InventoryItemHistories -> find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
            ->contain(['InventoryItems'])
            ->where(['company_id' => $companyID])
            ->where(['deleted' => '0']);

        $this->set(compact('inventoryItemHistories', 'date'));
        $this->set('_serialize', ['inventoryItemHistories']);
    }

    /**
     * View method
     *
     * @param string|null $id Inventory Item History id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inventoryItemHistory = $this->InventoryItemHistories->get($id, [
            'contain' => ['InventoryItems']
        ]);

        $this->set('inventoryItemHistory', $inventoryItemHistory);
        $this->set('_serialize', ['inventoryItemHistory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inventoryItemHistory = $this->InventoryItemHistories->newEntity();
        if ($this->request->is('post')) {
            $inventoryItemHistory = $this->InventoryItemHistories->patchEntity($inventoryItemHistory, $this->request->getData());
            if ($this->InventoryItemHistories->save($inventoryItemHistory)) {
                $this->Flash->success(__('The inventory item history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory item history could not be saved. Please, try again.'));
        }
        $inventoryItems = $this->InventoryItemHistories->InventoryItems->find('list', ['limit' => 200]);
        $this->set(compact('inventoryItemHistory', 'inventoryItems'));
        $this->set('_serialize', ['inventoryItemHistory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Inventory Item History id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    //もともとのやつ
    /*
    public function edit($id = null)
    {
        $inventoryItemHistory = $this->InventoryItemHistories->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(array_key_exists('button', $this->request->data())){
                if($this->request->data()['button'] === 'キャンセル'){
                    return $this->redirect(['action' => 'index']);
                } else if($this->request->data()['button'] === '変更') {
                    $inventoryItemHistory = $this->InventoryItemHistories->patchEntity($inventoryItemHistory,
                        [   'id' => $inventoryItemHistory -> id ,
                            'item_name' => $this->request->data()['item_name']]);
                    if($this->InventoryItemHistories->save($inventoryItemHistory)){
                        $this->Flash->success('データの変更に成功しました');
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('データの変更に失敗しました');
                    }
                }
            }
        }
         $this->set(compact('inventoryItemHistory'));
        //return $this->redirect(['action' => 'index']);
    }
    */

    //新しいやつ
    public function edit($id = null)
    {
        // debug($id);die;
        $this->Session = $this->request->session();
        $date = $this->Session->read('InventoryItemHistories.date');
        if($date == null){
            $date = time();
        }


        //設定日で有効な履歴
        $inventoryItemHistory = $this->InventoryItemHistories -> find()
            ->where(['InventoryItemHistories.id' => $id])
            ->contain(['InventoryItems'])
            ->toArray()[0];

        //設定日から見た最古の未来データ
        $future_InventoryItemHistories = $this->InventoryItemHistories -> find()
            ->where(['InventoryItemHistories.inventory_item_id' => $inventoryItemHistory['inventory_item_id']])
            ->contain(['InventoryItems'])
            ->where(['start >' => date('Y-m-d H:i:s', $date)])
            ->where(['deleted' => '0']);
            // ->toArray()[0];


        //設定日からみた最古の未来データのstart
        $future_start = $this->InventoryItemHistories -> find()
            // ->select(['start'])
            ->where(['InventoryItemHistories.inventory_item_id' => $inventoryItemHistory['inventory_item_id']])
            ->contain(['InventoryItems'])
            ->where(['start >' => date('Y-m-d H:i:s', $date)])
            ->where(['deleted' => '0'])
            ->min('start');

        //flag
        $flag_future = 0;

        // if(!$future_InventoryItemHistories->isEmpty()){
        //     $flag_future = 1;
        // }
        if(!$future_start == null){
            $flag_future = 1;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if(array_key_exists('button', $this->request->data())){
                if($this->request->data()['button'] === 'キャンセル'){
                    return $this->redirect(['action' => 'index']);
                } else if($this->request->data()['button'] === '変更') {

                    $new_inventoryItemHistory = $this->InventoryItemHistories->newEntity();
                    $new_inventoryItemHistory = $this->InventoryItemHistories->patchEntity($new_inventoryItemHistory, [
                                'inventory_item_id' => $inventoryItemHistory['inventory_item_id'],
                                'item_name' => $this->request->data()['item_name'],
                                'start' => date('Y-m-d'.' 00:00:00',$date),
                                'deleted' => false]);
                    //過去データのendを変更
                    $inventoryItemHistory = $this->InventoryItemHistories->patchEntity($inventoryItemHistory,
                    [   'id' => $inventoryItemHistory -> id ,
                        'end' => date('Y-m-d'.' 00:00:00',$date)]);
                    //未来データがある時
                    if($flag_future){
                        //挿入データのendを設定
                        $new_inventoryItemHistory = $this->InventoryItemHistories->patchEntity($new_inventoryItemHistory,
                        [   //'id' => $new_inventoryItemHistory -> id ,
                            'item_name' => $this->request->data()['item_name'],
                            'end' => $future_start['start'],
                            'deleted' => false]);
                    }
                    if($this->InventoryItemHistories->save($new_inventoryItemHistory)){
                        if($flag_future){
                            if($this->InventoryItemHistories->save($inventoryItemHistory)){
                                $this->Flash->success('データの変更に成功しました(new-past-future)');
                                return $this->redirect(['action' => 'index']);
                            } else {
                                $this->Flash->error('データの変更に失敗しました(past-future)');
                            }
                        } else {
                            if($this->InventoryItemHistories->save($inventoryItemHistory)){
                                $this->Flash->success('データの変更に成功しました(new-past)');
                                return $this->redirect(['action' => 'index']);
                            } else {
                                $this->Flash->error('データの変更に失敗しました(past)');
                            }
                        }

                        $this->Flash->success('データの変更に成功しました');
                        return $this->redirect(['action' => 'index']);

                    } else {
                        $this->Flash->error('データの変更に失敗しました(new)');
                    }
                }
            }
        }
         $this->set(compact('inventoryItemHistory','date','past_inventoryItemHistory','future_InventoryItemHistories','future_inventoryItemHistory','new_inventoryItemHistory','future_start'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inventory Item History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    //もともとのやつ
    /*
    public function delete($id = null)
    {
        $inventoryItemHistory = $this->InventoryItemHistories->get($id);
        $this->request->allowMethod(['post', 'delete']);
        $this->Session = $this->request->session();
        if($this->Session->read('InventoryItemHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('InventoryItemHistories.date');
            $this->Session->write('InventoryItemHistories.date', $date);
        }
        if(array_key_exists('button', $this->request->data())){
            if($this->request->data()['button'] === 'キャンセル'){
                return $this->redirect(['action' => 'index']);
            } else if($this->request->data()['button'] === '削除') {
                $inventoryItemHistory = $this->InventoryItemHistories->patchEntity($inventoryItemHistory,
                    [   'id' => $inventoryItemHistory -> id ,
                        'end' => date('Y-m-d',$date).' 00:00:00']);
                if($this->InventoryItemHistories->save($inventoryItemHistory)){
                    $this->Flash->success('データの削除設定に成功しました');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('データの削除設定に失敗しました');
                }
            }
        }
         $this->set(compact('inventoryItemHistory', 'date'));
        //return $this->redirect(['action' => 'index']);
    }
    */

    //新しいやつ
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->Session = $this->request->session();
        if($this->Session->read('InventoryItemHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('InventoryItemHistories.date');
            $this->Session->write('InventoryItemHistories.date', $date);
        }

        //設定日で有効な履歴
        $inventoryItemHistory = $this->InventoryItemHistories -> find()->where(['InventoryItemHistories.id' => $id])->contain(['InventoryItems'])->toArray()[0];
        //設定日から見た未来データ
        $future_inventoryItemHistories = $this->InventoryItemHistories -> find()
        ->where(['InventoryItemHistories.inventory_item_id' => $inventoryItemHistory['inventory_item_id']])
        ->contain(['InventoryItems'])
        ->where(['start >' => date('Y-m-d H:i:s', $date)]);


        if(array_key_exists('button', $this->request->data())){
            if($this->request->data()['button'] === 'キャンセル'){
                return $this->redirect(['action' => 'index']);
            } else if($this->request->data()['button'] === '削除') {

                //削除した日を保存する新しいデータを登録する
                $deleted_inventoryItemHistory = $this->InventoryItemHistories->newEntity();
                $deleted_inventoryItemHistory = $this->InventoryItemHistories->patchEntity($deleted_inventoryItemHistory, [
                            'inventory_item_id' => $inventoryItemHistory['inventory_item_id'],
                            'item_name' => $inventoryItemHistory['item_name'],
                            'start' => date('Y-m-d'.' 00:00:00',$date),
                            'end' => date('Y-m-d'.' 00:00:00',$date),
                            'deleted' => true]);
                if($this->InventoryItemHistories->save($deleted_inventoryItemHistory)){
                    //有効なデータのendを設定日にする
                    $inventoryItemHistory = $this->InventoryItemHistories->patchEntity($inventoryItemHistory,
                        [   'id' => $inventoryItemHistory -> id ,
                            'end' => date('Y-m-d',$date).' 00:00:00']);
                    if($this->InventoryItemHistories->save($inventoryItemHistory)){
                        //未来データもdeleted = trueにする
                        foreach ($future_inventoryItemHistories as $future_inventoryItemHistory) {
                            $future_inventoryItemHistory = $this->InventoryItemHistories->patchEntity($future_inventoryItemHistory,
                            [   'id' => $future_inventoryItemHistory -> id ,
                                'deleted' => true]);
                            if($this->InventoryItemHistories->save($future_inventoryItemHistory)){
                            } else {
                                $this->Flash->error('未来データの更新(deleted=true)に失敗しました');
                            }
                        }
                        $this->Flash->success('データの削除設定に成功しました');
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('データの変更に失敗しました(有効なやつ)');
                    }
                } else {
                    $this->Flash->error('データの変更に失敗しました(deleted)');
                }


            }
        }
         $this->set(compact('inventoryItemHistory', 'date','future_inventoryItemHistories'));
    }
}
