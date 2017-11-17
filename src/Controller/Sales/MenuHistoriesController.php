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
class MenuHistoriesController extends AppController
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
                if($data['menu_number'] === ''){
                    $this->Flash->error('メニュー番号を入力してください。');
                } else if($data['menu_name'] === ''){
                    $this->Flash->error('メニュー名を入力してください。');
                } else {
                    $this->SalesItems = TableRegistry::get('sales_items');
                    $this->SalesItemHistories = TableRegistry::get('sales_item_histories');
                    if($this->Session->read('MenuHistories.date') == null){
                        $date = time();
                    } else {
                        $date = $this->Session->read('MenuHistories.date');
                        $this->Session->write('MenuHistories.date', $date);
                    }
                    $salesItemHistory = $this->SalesItemHistories->find()
                        ->where([   'sales_item_histories.sales_item_name' => $data['item_name']])
                        ->matching('SalesItems', function ($q) use ($data){
                                return $q->where(['SalesItems.sales_item_number' => $data['item_number']]);
                        })
                        ->limit(1)->first();
                    $salesItemHistoryExists = false
                    if($salesItemHistory != null){
                        $salesItemHistoryExists = true;
                    } else if($this->SalesItems->find()->where(['sales_item_number' => $data['item_number']])->first() != null){
                        $this->Flash->error('その出庫アイテム番号はすでに存在します。');
                    } else if($this->SalesItemHistories->find()->where(['sales_item_name' => $data['item_name']])->first() != null){
                        $this->Flash->error('その出庫アイテム名はすでに存在します。');
                    } else {
                        $this->Menus = TableRegistry::get('menus');
                        $menu = $this->Menus->newEntity();
                        $this->Menus->patchEntity($menu,[
                                'menu_number' => $data['menu_number']]);
                        if($this->Menus->save($menu)){
                            $menuHistory = $this->MenuHistories->newEntity();
                            $this->MenuHistories->patchEntity($menuHistory, [
                                'menu_item_id' => $menu['id'],
                                'name' => $data['menu_name'],
                                'start' => date('Y-m-d 00:00:00',$date),
                                'deleted' => false]);
                            if($this->MenuHistories->save($menuHistory)){
                                $this->SalesItemAssignHistories = TableRegistry::get('sales_item_assign_histories');
                                $salesItemAssignHistory = $this->SalesItemAssignHistories->newEntity();
                                $this->SalesItemAssignHistories->patchEntity($salesItemAssignHistory,[
                                    'menu_item_id' => $menu['id'],
                                    'sales_item_id' => $salesItemHistory->_matchingData['SalesItems']['sales_item_number'],
                                    'start' => date('Y-m-d 00:00:00',$date)]);
                                if($this->SalesItemAssignHistories->save($salesItemAssignHistory)){
                                    $this->Flash->success('データの保存に成功しました。');
                                } else {
                                    $this->MenuHistories->delete($menuHistory);
                                    $this->Menus->delete($menus);
                                    $this->Flash->error('データの保存に失敗しました。3');
                                }
                            }
                            else {
                                $this->Menus->delete($menus);
                                $this->Flash->error('データの保存に失敗しました。2');
                            }
                        } else {
                            debug($menu->errors());
                            $this->Flash->error('データの保存に失敗しました。1');
                        }
                    }
                }
            } else if($data['button'] === '設定') {
                if(strtotime($data['date'])){
                    $date = strtotime($data['date']);
                    $this->Session->write('MenuHistories.date', $date);
                }
            }

        }
        if($date == null){
            if($this->Session->read('MenuHistories.date') == null){
                $date = time();
            } else {
                $date = $this->Session->read('MenuHistories.date');
                $this->Session->write('MenuHistories.date', $date);
            }
        }
        $menuHistories = $this->MenuHistories -> find()
            ->where(['MenuHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['MenuHistories.end >' => date('Y-m-d H:i:s', $date)],['MenuHistories.end is' => null]]])
            ->contain(['Menus','SalesItemAssignHistories','SalesItemAssignHistories.SalesItems.SalesItemHistories']);

        $this->set(compact('menuHistories', 'date'));
        $this->set('_serialize', ['menuHistories']);
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
        $menuHistory = $this->MenuHistories -> find()->where(['MenuHistories.id' => $id])->contain(['Menus'])->toArray()[0];
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(array_key_exists('button', $this->request->data())){
                if($this->request->data()['button'] === 'キャンセル'){
                    return $this->redirect(['action' => 'index']);
                } else if($this->request->data()['button'] === '変更') {
                    $menuHistory = $this->MenuHistories->patchEntity($menuHistory,
                        [   'id' => $menuHistory -> id , 
                            'name' => $this->request->data()['name']]);
                    if($this->MenuHistories->save($menuHistory)){
                        $this->Flash->success('データの変更に成功しました');
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('データの変更に失敗しました');
                    }
                }
            }
        }
         $this->set(compact('menuHistory'));
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
        $menuHistory = $this->MenuHistories -> find()->where(['MenuHistories.id' => $id])->contain(['Menus'])->toArray()[0];
        $this->request->allowMethod(['post', 'delete']);
        $this->Session = $this->request->session();
        if($this->Session->read('MenuHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('MenuHistories.date');
            $this->Session->write('MenuHistories.date', $date);
        }
        if(array_key_exists('button', $this->request->data())){
            if($this->request->data()['button'] === 'キャンセル'){
                return $this->redirect(['action' => 'index']);
            } else if($this->request->data()['button'] === '削除') {
                $menuHistory = $this->MemuHistories->patchEntity($menuHistory,
                    [   'id' => $menuHistory -> id , 
                        'end' => date('Y-m-d',$date).' 00:00:00']);
                if($this->MenuHistories->save($menuHistory)){
                    $this->Flash->success('データの削除設定に成功しました');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('データの削除設定に失敗しました');
                }
            }
        }
         $this->set(compact('menuHistory', 'date'));
        //return $this->redirect(['action' => 'index']);
    }
}
