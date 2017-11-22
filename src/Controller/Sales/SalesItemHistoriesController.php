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
        $date = null;
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '新規作成'){
                if($data['name'] === ''){
                    $this->Flash->error('マスタ在庫アイテム名を入力してください。');
                } else {
                    $this->SalesItems = TableRegistry::get('sales_items');
                    if($this->Session->read('SalesItemHistories.date') == null){
                        $date = time();
                    } else {
                        $date = $this->Session->read('SalesItemHistories.date');
                        $this->Session->write('SalesItemHistories.date', $date);
                    }
                    $salesItem = $this->SalesItems->newEntity();
                    $salesItem = $this->SalesItems->patchEntity($salesItem, ['sales_item_number' => $data['number']]);
                    if($this->SalesItems->save($salesItem)){
                        $salesItemHistory = $this->SalesItemHistories->newEntity();
                        $salesItemHistory = $this->SalesItemHistories->patchEntity($salesItemHistory, [
                                'sales_item_id' => $salesItem['id'],
                                'sales_item_name' => $data['name'],
                                'start' => date('Y-m-d'.' 00:00:00',$date),
                                'deleted' => false]);
                        if($this->SalesItemHistories->save($salesItemHistory)){
                            $this->Flash->success('データの保存に成功しました');
                        } else {
                            debug($salesItemHistory->errors());
                            $this->SalesItemHistories->delete($salesItem);
                            $this->Flash->error('データの保存に失敗しました');
                        }
                    } else {
                        $this->Flash->error('データの保存に失敗しました');
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
            ->contain(['SalesItems']);

        $this->set(compact('salesItemHistories', 'date'));
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
        $salesItemHistory = $this->SalesItemHistories -> find()->where(['SalesItemHistories.id' => $id])->contain(['SalesItems'])->toArray()[0];
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(array_key_exists('button', $this->request->data())){
                if($this->request->data()['button'] === 'キャンセル'){
                    return $this->redirect(['action' => 'index']);
                } else if($this->request->data()['button'] === '変更') {
                    $salesItemHistory = $this->SalesItemHistories->patchEntity($salesItemHistory,
                        [   'id' => $salesItemHistory -> id , 
                            'sales_item_name' => $this->request->data()['name']]);
                    if($this->SalesItemHistories->save($salesItemHistory)){
                        $this->Flash->success('データの変更に成功しました');
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('データの変更に失敗しました');
                    }
                }
            }
        }
         $this->set(compact('salesItemHistory'));
        //return $this->redirect(['action' => 'index']);
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
        $salesItemHistory = $this->SalesItemHistories -> find()->where(['SalesItemHistories.id' => $id])->contain(['SalesItems'])->toArray()[0];
        $this->request->allowMethod(['post', 'delete']);
        $this->Session = $this->request->session();
        if($this->Session->read('SalesItemHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('SalesItemHistories.date');
            $this->Session->write('SalesItemHistories.date', $date);
        }
        if(array_key_exists('button', $this->request->data())){
            if($this->request->data()['button'] === 'キャンセル'){
                return $this->redirect(['action' => 'index']);
            } else if($this->request->data()['button'] === '削除') {
                $salesItemHistory = $this->SalesItemHistories->patchEntity($salesItemHistory,
                    [   'id' => $salesItemHistory -> id , 
                        'end' => date('Y-m-d',$date).' 00:00:00']);
                if($this->SalesItemHistories->save($salesItemHistory)){
                    $this->Flash->success('データの削除設定に成功しました');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('データの削除設定に失敗しました');
                }
            }
        }
         $this->set(compact('salesItemHistory', 'date'));
        //return $this->redirect(['action' => 'index']);
    }
}
