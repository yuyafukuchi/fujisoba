<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Menuistories Controller
 *
 * @property \App\Model\Table\InventoryItemHistoriesTable $InventoryItemHistories
 *
 * @method \App\Model\Entity\InventoryItemHistory[] paginate($object = null, array $settings = [])
 */
class SalesItemHistoriesController extends AppController
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
            $data = $this->request->data;
            if($data['button'] === '新規作成'){
                // debug($data);die;
                if($data['number'] === ''){
                    $this->Flash->error('マスタ出庫アイテム番号を入力してください。');
                }else if($data['name'] === ''){
                    $this->Flash->error('マスタ出庫アイテム名を入力してください。');
                } else {
                    $this->SalesItems = TableRegistry::get('sales_items');
                    if($this->Session->read('SalesItemHistories.date') == null){
                        $date = time();
                    } else {
                        $date = $this->Session->read('SalesItemHistories.date');
                        $this->Session->write('SalesItemHistories.date', $date);
                    }
                    $salesItem = $this->SalesItems->newEntity();
                    // debug($companyID);
                    $salesItem = $this->SalesItems->patchEntity($salesItem, [
                        'company_id' => $companyID,
                        'sales_item_number' => $data['number']]);

                        // debug($salesItem);die;

                    if($this->SalesItems->save($salesItem)){
                        $salesItemHistory = $this->SalesItemHistories->newEntity();
                        $salesItemHistory = $this->SalesItemHistories->patchEntity($salesItemHistory, [
                                'sales_item_id' => $salesItem['id'],
                                'sales_item_name' => $data['name'],
                                'start' => date('Y-m-d'.' 00:00:00',$date),
                                'deleted' => false]);
                        // debug($salesItemHistory);die;
                        if($this->SalesItemHistories->save($salesItemHistory)){
                            $this->Flash->success('データの保存に成功しました($salesItemHistory)');
                        } else {
                            debug($salesItemHistory->errors());
                            $this->SalesItemHistories->delete($salesItem);
                            $this->Flash->error('データの保存に失敗しました($salesItemHistory)');
                        }
                    } else {
                        $this->Flash->error('データの保存に失敗しました($salesItem)');
                    }
                }
            } else if($data['button'] === '設定') {
                if(strtotime($data['date'])){
                    $date = strtotime($data['date']);
                    $this->Session->write('SalesItemHistories.date', $date);
                }
            }

        }
        if($date == null){
            if($this->Session->read('SalesItemHistories.date') == null){
                $date = time();
            } else {
                $date = $this->Session->read('SalesItemHistories.date');
                $this->Session->write('SalesItemHistories.date', $date);
            }
        }
        $salesItemHistories = $this->SalesItemHistories -> find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
            ->contain(['SalesItems'])
            ->where(['company_id' => $companyID])
            ->where(['deleted' => '0']);

        $this->set(compact('salesItemHistories', 'date','companyID'));
    }



    /**
     * Edit method
     *
     * @param string|null $id Inventory Item History id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
    $this->Session = $this->request->session();
    $date = $this->Session->read('SalesItemHistories.date');
    if($date == null){
        $date = time();
    }
    //設定日で有効な履歴
    $salesItemHistory = $this->SalesItemHistories -> find()
        ->where(['SalesItemHistories.id' => $id])
        ->contain(['SalesItems'])
        ->toArray()[0];
    //設定日から見た最古の未来データ
    $future_salesItemHistories = $this->SalesItemHistories -> find()
        ->where(['SalesItemHistories.sales_item_id' => $salesItemHistory['sales_item_id']])
        ->contain(['SalesItems'])
        ->where(['start >' => date('Y-m-d H:i:s', $date)])
        ->where(['deleted' => '0']);
        // ->toArray()[0];


    //設定日からみた最古の未来データのstart
    $future_start = $this->SalesItemHistories -> find()
        // ->select(['start'])
        ->where(['SalesItemHistories.sales_item_id' => $salesItemHistory['sales_item_id']])
        ->contain(['SalesItems'])
        ->where(['start >' => date('Y-m-d H:i:s', $date)])
        ->where(['deleted' => '0'])
        ->min('start');

    //flag
    $flag_future = 0;

    // if(!$future_salesItemHistories->isEmpty()){
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
                //元々のやつ
                // $salesItemHistory = $this->SalesItemHistories->patchEntity($salesItemHistory,
                //     [   'id' => $salesItemHistory -> id ,
                //         'sales_item_name' => $this->request->data()['name']]);
                // if($this->SalesItemHistories->save($salesItemHistory)){
                //     $this->Flash->success('データの変更に成功しました');
                //     return $this->redirect(['action' => 'index']);
                // } else {
                //     $this->Flash->error('データの変更に失敗しました');
                // }

                //新しいやつ
                $new_salesItemHistory = $this->SalesItemHistories->newEntity();
                $new_salesItemHistory = $this->SalesItemHistories->patchEntity($new_salesItemHistory, [
                            'sales_item_id' => $salesItemHistory['sales_item_id'],
                            'sales_item_name' => $this->request->data()['name'],
                            'start' => date('Y-m-d'.' 00:00:00',$date),
                            'deleted' => false]);
                //過去データのendを変更
                $salesItemHistory = $this->SalesItemHistories->patchEntity($salesItemHistory,
                [   'id' => $salesItemHistory -> id ,
                    'end' => date('Y-m-d'.' 00:00:00',$date)]);
                //未来データがある時
                if($flag_future){
                    //挿入データのendを設定
                    $new_salesItemHistory = $this->SalesItemHistories->patchEntity($new_salesItemHistory,
                    [   //'id' => $new_salesItemHistory -> id ,
                        'sales_item_name' => $this->request->data()['name'],
                        'end' => $future_start['start'],
                        'deleted' => false]);
                }
                if($this->SalesItemHistories->save($new_salesItemHistory)){
                    if($flag_future){
                        if($this->SalesItemHistories->save($salesItemHistory)){
                            $this->Flash->success('データの変更に成功しました(new-past-future)');
                            return $this->redirect(['action' => 'index']);
                        } else {
                            $this->Flash->error('データの変更に失敗しました(past-future)');
                        }
                    } else {
                        if($this->SalesItemHistories->save($salesItemHistory)){
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
     $this->set(compact('salesItemHistory','date','past_salesItemHistory','future_salesItemHistories','future_salesItemHistory','new_salesItemHistory','future_start'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inventory Item History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->Session = $this->request->session();
        if($this->Session->read('SalesItemHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('SalesItemHistories.date');
            $this->Session->write('SalesItemHistories.date', $date);
        }

        //設定日で有効な履歴
        $salesItemHistory = $this->SalesItemHistories -> find()->where(['SalesItemHistories.id' => $id])->contain(['SalesItems'])->toArray()[0];
        //設定日から見た未来データ
        $future_salesItemHistories = $this->SalesItemHistories -> find()
        ->where(['SalesItemHistories.sales_item_id' => $salesItemHistory['sales_item_id']])
        ->contain(['SalesItems'])
        ->where(['start >' => date('Y-m-d H:i:s', $date)]);


        if(array_key_exists('button', $this->request->data())){
            if($this->request->data()['button'] === 'キャンセル'){
                return $this->redirect(['action' => 'index']);
            } else if($this->request->data()['button'] === '削除') {
                //元のやつ
                // $salesItemHistory = $this->SalesItemHistories->patchEntity($salesItemHistory,
                //     [   'id' => $salesItemHistory -> id ,
                //         'end' => date('Y-m-d',$date).' 00:00:00']);
                // if($this->SalesItemHistories->save($salesItemHistory)){
                //     $this->Flash->success('データの削除設定に成功しました');
                //     return $this->redirect(['action' => 'index']);
                // } else {
                //     $this->Flash->error('データの削除設定に失敗しました');
                // }

                //新しいやつ


                //削除した日を保存する新しいデータを登録する
                $deleted_salesItemHistory = $this->SalesItemHistories->newEntity();
                $deleted_salesItemHistory = $this->SalesItemHistories->patchEntity($deleted_salesItemHistory, [
                            'sales_item_id' => $salesItemHistory['sales_item_id'],
                            'sales_item_name' => $salesItemHistory['sales_item_name'],
                            'start' => date('Y-m-d'.' 00:00:00',$date),
                            'end' => date('Y-m-d'.' 00:00:00',$date),
                            'deleted' => true]);
                if($this->SalesItemHistories->save($deleted_salesItemHistory)){
                    //有効なデータのendを設定日にする
                    $salesItemHistory = $this->SalesItemHistories->patchEntity($salesItemHistory,
                        [   'id' => $salesItemHistory -> id ,
                            'end' => date('Y-m-d',$date).' 00:00:00']);
                    if($this->SalesItemHistories->save($salesItemHistory)){
                        //未来データもdeleted = tureにする
                        foreach ($future_salesItemHistories as $future_salesItemHistory) {
                            $future_salesItemHistory = $this->SalesItemHistories->patchEntity($future_salesItemHistory,
                            [   'id' => $future_salesItemHistory -> id ,
                                'deleted' => true]);
                            // debug($future_salesItemHistory);die;
                            if($this->SalesItemHistories->save($future_salesItemHistory)){
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
         $this->set(compact('salesItemHistory', 'date','future_salesItemHistories'));
        //return $this->redirect(['action' => 'index']);
    }
}
