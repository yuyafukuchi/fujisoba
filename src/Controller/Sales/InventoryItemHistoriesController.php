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
        $this->paginate = [
            'contain' => ['InventoryItems']
        ];
        $inventoryItemHistories = $this->InventoryItemHistories -> find()
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]]);
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

    /**
     * Delete method
     *
     * @param string|null $id Inventory Item History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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
}
