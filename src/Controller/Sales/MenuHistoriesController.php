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
                if($data['name'] === ''){
                    $this->Flash->error('マスタ在庫アイテム名を入力してください。');
                } else {
                    $this->Menus = TableRegistry::get('menus');
                    if($this->Session->read('MenuHistories.date') == null){
                        $date = time();
                    } else {
                        $date = $this->Session->read('MenuHistories.date');
                        $this->Session->write('MenuHistories.date', $date);
                    }
                    $menu = $this->Menus->newEntity();
                    $menu = $this->Menus->patchEntity($menu, ['menu_number' => $data['number']]);
                    if($this->Menus->save($menu)){
                        $menuHistory = $this->MenuHistories->newEntity();
                        $menuHistory = $this->MenuHistories->patchEntity($menuHistory, [
                                'menu_item_id' => $menu['id'],
                                'name' => $data['name'],
                                'start' => date('Y-m-d'.' 00:00:00',$date),
                                'deleted' => false]);
                        if($this->MenuHistories->save($menuHistory)){
                            $this->Flash->success('データの保存に成功しました');
                        } else {
                            $this->Menus->delete($menu);
                            $this->Flash->error('データの保存に失敗しました');
                        }
                    } else {
                        $this->Flash->error('データの保存に失敗しました');
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
            ->where(['start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['end >' => date('Y-m-d H:i:s', $date)],['end is' => null]]])
            ->contain(['Menus']);

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
