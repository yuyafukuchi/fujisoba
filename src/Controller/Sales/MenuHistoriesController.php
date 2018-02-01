<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

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
     //元々のやつ
     /*
    public function index()
    {
        $this->Session = $this->request->session();
        $companyID = $this->Session->read('Auth.Users.company_id');
        $date = null;
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '新規作成'){
                if($data['menu_number'] === ''){
                    $this->Flash->error('メニュー番号を入力してください。');
                } else if($data['menu_name'] === ''){
                    $this->Flash->error('メニュー名を入力してください。');
                } else if(($data['item_number'] === '' or $data['item_name'] === '' ) and !($data['item_number'] === '' and $data['item_name'] === '')) {
                    $this->Flash->error('XOR!!!!!!');
                } else {
                    $this->SalesItems = TableRegistry::get('sales_items');
                    $this->SalesItemHistories = TableRegistry::get('sales_item_histories');
                    if($this->Session->read('MenuHistories.date') == null){
                        $date = time();
                    } else {
                        $date = $this->Session->read('MenuHistories.date');
                        $this->Session->write('MenuHistories.date', $date);
                    }
                    //マスターメニューの重複を探す
                    // $menuHistory = $this->MenuHistories->find()
                    //     ->where([   'name' => $data['menu_name']])
                    //     ->matching('Menus', function ($q) use ($data){
                    //             return $q->where(['Menus.menu_number' => $data['menu_number']]);
                    //     })
                    //     ->limit(1)->first();
                    // debug($menuHistory);die;
                    //出庫アイテムの重複を探す
                    $salesItemHistory = $this->SalesItemHistories->find()
                        ->where([   'sales_item_histories.sales_item_name' => $data['item_name']])
                        ->matching('SalesItems', function ($q) use ($data){
                                return $q->where(['SalesItems.sales_item_number' => $data['item_number']]);
                        })
                        ->limit(1)->first();
                    // debug($salesItemHistory->id);die;
                    // $menuHistoryExists = false;
                    // $salesItemHistoryExists = false;
                    // if($menuHistory != null){
                    //     $menuHistoryExists = true;
                    // } else if()
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
                                'menu_number' => $data['menu_number'],
                                'company_id' => $companyID]);
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
                                    $this->Flash->success('データの保存に成功しました($menu, $menuHistory, $salesItemAssignHistory)');
                                } else {
                                    $this->MenuHistories->delete($menuHistory);
                                    $this->Menus->delete($menus);
                                    $this->Flash->error('データの保存に失敗しました($salesItmeAssignHistory)');
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
        //表示するマスタメニューを会社ごとに変える
        // $companyID = $this->Session->read('Auth.Users.company_id');
        // if($companyID == 3){
        //     $companyNumber = 6000;
        // } else {
        //     $companyNumber = 2000;
        // }
        //
        $menuHistories = $this->MenuHistories -> find()
            ->where(['MenuHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['MenuHistories.end >' => date('Y-m-d H:i:s', $date)],['MenuHistories.end is' => null]]])
            ->contain(['Menus','SalesItemAssignHistories','SalesItemAssignHistories.SalesItems.SalesItemHistories'])
            // ->where([['menu_number >=' => $companyNumber+1],['menu_number <=' => $companyNumber+999]])
            ->orwhere(['menu_number <=' => 1000])
            ->order(['menu_number' => 'ASC']);

        $this->set(compact('menuHistories', 'date'));

        //デバッグようsetCompact
        $this->set(compact('salesItemHistory'));
        $this->set('_serialize', ['menuHistories']);
    }
    */
    //新しいやつ
    public function index()
    {
        $this->Session = $this->request->session();
        $companyID = $this->Session->read('Auth.Users.company_id');
        $date = null;
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '新規作成'){

                //入力項目を確認する
                if($data['menu_number'] === ''){
                    $this->Flash->error('メニュー番号を入力してください。');
                } else if($data['menu_name'] === ''){
                    $this->Flash->error('メニュー名を入力してください。');
                } else if(($data['item_number'] === '' or $data['item_name'] === '' ) and !($data['item_number'] === '' and $data['item_name'] === '')) {
                    $this->Flash->error('XOR!!!!!!');
                } else {
                    $this->Menus = TableRegistry::get('menus');
                    $this->SalesItems = TableRegistry::get('sales_items');
                    $this->SalesItemHistories = TableRegistry::get('sales_item_histories');
                    $this->SalesItemAssignHistories = TableRegistry::get('sales_item_assign_histories');
                    if($this->Session->read('MenuHistories.date') == null){
                        $date = time();
                    } else {
                        $date = $this->Session->read('MenuHistories.date');
                        $this->Session->write('MenuHistories.date', $date);
                    }
                    //マスターメニューの重複を探す
                    $isMenuNumber = null;
                    $isMenuNumber = $this->Menus->find()
                        ->where(['company_id' => $companyID])
                        ->where(['menu_number' => $data['menu_number']])
                        ->toArray();
                    $isMenuName = $this->MenuHistories->find()
                        ->contain(['Menus'])
                        ->where(['Menus.company_id' => $companyID])
                        ->where(['name' => $data['menu_name']])
                        ->toArray();

                    //出庫アイテムの重複を探す
                    $isSalesItemNumber = $this->SalesItems->find()
                        ->where(['company_id' => $companyID])
                        ->where(['sales_item_number' => $data['item_number']])
                        ->toArray();
                    $isSalesItemName = $this->SalesItemHistories->find()
                        ->contain(['SalesItems'])
                        ->where(['company_id' => $companyID])
                        ->where(['sales_item_name' => $data['item_name']])
                        ->toArray();

                    if($isMenuNumber != null){
                        $this->Flash->error('そのマスターメニュー番号はすでに存在します。');
                    } else if($isMenuName != null){
                        $this->Flash->error('そのマスターメニュー名はすでに存在します。');
                    } else if($isSalesItemNumber != null){
                        $this->Flash->error('その出庫アイテム番号はすでに存在します。');
                    } else if($isSalesItemName != null){
                        $this->Flash->error('その出庫アイテム名はすでに存在します。');
                    } else {
                        //マスターメニューを作る
                        $menu = $this->Menus->newEntity();
                        $this->Menus->patchEntity($menu,[
                                'menu_number' => $data['menu_number'],
                                'company_id' => $companyID]);
                        if($this->Menus->save($menu)){
                            //マスターメニュー履歴を作る
                            $menuHistory = $this->MenuHistories->newEntity();
                            $this->MenuHistories->patchEntity($menuHistory, [
                                'menu_item_id' => $menu['id'],
                                'name' => $data['menu_name'],
                                'start' => date('Y-m-d 00:00:00',$date),
                                'deleted' => false]);
                            if($this->MenuHistories->save($menuHistory)){

                                // 出庫アイテムを記入していた場合
                                if(!($data['item_number'] === '')){
                                    // 出庫アイテムを作る
                                    $salesItem = $this->SalesItems->newEntity();
                                    $this->SalesItems->patchEntity($salesItem, [
                                        'company_id' => $companyID,
                                        'sales_item_number' => $data['item_number']]);

                                    $this->Menus->delete($menu);
                                    $this->MenuHistories->delete($menuHistory);
                                    if($this->SalesItems->save($salesItem)){
                                        //出庫アイテム履歴を作る
                                        $salesItemHistory = $this->SalesItemHistories->newEntity();
                                        $this->SalesItemHistories->patchEntity($salesItemHistory, [
                                            'sales_item_id' => $salesItem['id'],
                                            'sales_item_name' => $data['item_name'],
                                            'start' => date('Y-m-d 00:00:00',$date),
                                            'deleted' => false]);
                                        if($this->SalesItemHistories->save($salesItemHistory)){
                                            //出庫アイテム割付を作る
                                            $salesItemAssignHistory = $this->SalesItemAssignHistories->newEntity();
                                            $this->SalesItemAssignHistories->patchEntity($salesItemAssignHistory, [
                                                'sales_item_id' => $salesItem['id'],
                                                'menu_item_id' => $menu['id'],
                                                'start' => date('Y-m-d 00:00:00', $date)]);
                                            if($this->SalesItemAssignHistories->save($salesItemAssignHistory)){
                                                $this->Flash->success('データの変更に成功しました($menu, $menuHistory, $salesItem, $salesItemHistory, $salesItemAssignHistory)');
                                            } else {
                                                $this->Menus->delete($menu);
                                                $this->MenuHistories->delete($menuHistory);
                                                $this->SalesItems->delete($salesItem);
                                                $this->SalesItemHistories->delete($salesItemHistory);
                                                $this->Flash->error('データの保存に失敗しました($salesItemAssignHistory)');
                                            }
                                        } else {
                                            $this->Menus->delete($menu);
                                            $this->MenuHistories->delete($menuHistory);
                                            $this->SalesItems->delete($salesItem);
                                            $this->Flash->error('データの保存に失敗しました($salesItemHistory)');
                                        }
                                    } else {
                                        $this->Menus->delete($menu);
                                        $this->MenuHistories->delete($menuHistory);
                                        debug($menuHistory);
                                        $this->Flash->error('データの保存に失敗しました($salesItem)');
                                    }
                                } else {
                                    $this->Flash->success('データの変更に成功しました($menu, $menuHistory)');
                                }

                            } else {
                                $this->Menus->delete($menus);
                                $this->Flash->error('データの保存に失敗しました($menuHistory)');
                            }
                        } else {
                            // debug($menu->errors());
                            $this->Flash->error('データの保存に失敗しました($menu)');
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

        //設定日に有効なマスターメニューを取得する

        $menuHistories = $this->MenuHistories -> find()
            // ->contain(['Menus','Menus.SalesItemAssignHistories'])
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
			    'MenuHistories.id',
			    'MenuHistories.menu_item_id',
			    'MenuHistories.name',
			    'MenuHistories.start',
			    'MenuHistories.end',
			    'MenuHistories.deleted',
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



/*
		    $menuHistories = $this->MenuHistories -> find()
            // ->contain(['Menus','Menus.SalesItemAssignHistories'])
            ->where(['MenuHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['MenuHistories.end >' => date('Y-m-d H:i:s', $date)],['MenuHistories.end is' => null]]])
            ->where(['OR' => [['Menus.company_id' => '0'], ['Menus.company_id' => $companyID]]])
            ->where(['MenuHistories.deleted' => '0'])
//             ->join([
// 				'table' => 'menus',
// 				'alias' => 'Menus',
// 				'type' => 'INNER',
// 				'conditions' => 'MenuHistories.menu_item_id = Menus.id',
// 			])
// 			->join([
// 				'table' => 'sales_item_assign_histories',
// 				'alias' => 'SalesItemAssignHistories',
// 				'type' => 'LEFT',
// 				'conditions' => ['AND' => ['MenuHistories.menu_item_id = SalesItemAssignHistories.menu_item_id',['SalesItemAssignHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['SalesItemAssignHistories.end >' => date('Y-m-d H:i:s', $date)],['SalesItemAssignHistories.end is' => null]]]]]
// 			])
// 			->join([
// 				'table' => 'sales_items',
// 				'alias' => 'SalesItems',
// 				'type' => 'LEFT',
// 				'conditions' => 'SalesItems.id = SalesItemAssignHistories.sales_item_id',
// 			])
// 			->join([
// 				'table' => 'sales_item_histories',
// 				'alias' => 'SalesItemHistories',
// 				'type' => 'LEFT',
// 				'conditions' => ['AND' => ['SalesItems.id = SalesItemHistories.sales_item_id',['SalesItemHistories.start <=' => date('Y-m-d H:i:s', $date),'SalesItemHistories.deleted = 0', 'OR' => [['SalesItemHistories.end >' => date('Y-m-d H:i:s', $date)],['SalesItemHistories.end is' => null]]]]]
// 			])
			->select([
			    'MenuHistories.id',
			    'MenuHistories.menu_item_id',
			    'MenuHistories.name',
			    'MenuHistories.start',
			    'MenuHistories.end',
			    'MenuHistories.deleted',
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
				'SalesItemAssignHistories.SalesItems.SalesItemHistories.sales_item_name',
				'SalesItemHistories.start',
				'SalesItemHistories.end',
				'SalesItemHistories.deleted'
			])
			->contain(['Menus','SalesItemAssignHistories','SalesItemAssignHistories.SalesItems','SalesItemAssignHistories.SalesItems.SalesItemHistories']);

*/


// debug($menuHistories);die;

// 			->contain('SalesItems.SalesItemHistories');

// 			->select([
// 				"sales_item_number" => "SalesItems.sales_item_number"
// 			]);
// 			->contain(['Menus','Menus.SalesItemAssignHistories','Menus.SalesItemAssignHistories.SalesItems','Menus.SalesItemAssignHistories.SalesItems.SalesItemHistories'])
			 //->where(['Menus.SalesItemAssignHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['Menus.SalesItemAssignHistories.end >' => date('Y-m-d H:i:s', $date)],['Menus.SalesItemAssignHistories.end is' => null]]]);


        // $menuHistories = $this->MenuHistories->find()
        //     ->contain(['Menus','SalesItemAssignHistories','SalesItemAssignHistories.SalesItems','SalesItemAssignHistories.SalesItems.SalesItemHistories'])
        //     ->where(['MenuHistories.start <=' => date('Y-m-d H:i:s', $date), 'OR' => [['MenuHistories.end >' => date('Y-m-d H:i:s', $date)],['MenuHistories.end is' => null]]])
        //     ->where(['OR' => [['Menus.company_id' => '0'], ['Menus.company_id' => $companyID]]])
        //     ->where(['deleted' => '0'])
        //     ->where(['OR' => ['SalesItemAssignHistories.start <=' => date('Y-m-d H:i:s', $date),['SalesItemAssignHistories.start is' => null]], 'OR' => [['SalesItemAssignHistories.end >' => date('Y-m-d H:i:s', $date)],['SalesItemAssignHistories.end is' => null]]]);





        // $menuHistories = $this->MenuHistories->find()
        //     ->contain(['Menus','Menus.SalesItemAssignHistories']);






        // $query = $this->MenuHistories->find()
        //     ->leftJoin("Menus")
        //     ->contain(["menus"]);





        $this->set(compact('menuHistories', 'date','query'));



        //デバッグようsetCompact
        $this->set(compact('salesItemHistory','menu','menuHistory'));
        $this->set('_serialize', ['menuHistories']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Inventory Item History id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
     //元々のやつ
     /*
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
    */

    //新しいやつ
    public function edit($id = null)
    {
    $this->Session = $this->request->session();
    $date = $this->Session->read('MenuHistories.date');
    if($date == null){
        $date = time();
    }
    //設定日で有効な履歴
    $menuHistory = $this->MenuHistories -> find()
        ->where(['MenuHistories.id' => $id])
        ->contain(['Menus'])
        ->toArray()[0];
    //設定日から見た最古の未来データ
    $future_menuHistories = $this->MenuHistories -> find()
        ->where(['MenuHistories.menu_item_id' => $menuHistory['menu_item_id']])
        ->contain(['Menus'])
        ->where(['start >' => date('Y-m-d H:i:s', $date)])
        ->where(['deleted' => '0']);

    //設定日からみた最古の未来データのstart
    $future_start = $this->MenuHistories -> find()
        ->where(['MenuHistories.menu_item_id' => $menuHistory['menu_item_id']])
        ->contain(['Menus'])
        ->where(['start >' => date('Y-m-d H:i:s', $date)])
        ->where(['deleted' => '0'])
        ->min('start');

    //flag
    $flag_future = 0;

    if(!$future_start == null){
        $flag_future = 1;
    }

    if ($this->request->is(['patch', 'post', 'put'])) {
        if(array_key_exists('button', $this->request->data())){
            if($this->request->data()['button'] === 'キャンセル'){
                return $this->redirect(['action' => 'index']);
            } else if($this->request->data()['button'] === '変更') {

                $new_menuHistory = $this->MenuHistories->newEntity();
                $new_menuHistory = $this->MenuHistories->patchEntity($new_menuHistory, [
                            'menu_item_id' => $menuHistory['menu_item_id'],
                            'name' => $this->request->data()['name'],
                            'start' => date('Y-m-d'.' 00:00:00',$date),
                            'deleted' => false]);
                //過去データのendを変更
                $menuHistory = $this->MenuHistories->patchEntity($menuHistory,
                [   'id' => $menuHistory -> id ,
                    'end' => date('Y-m-d'.' 00:00:00',$date)]);
                //未来データがある時
                if($flag_future){
                    //挿入データのendを設定
                    $new_menuHistory = $this->MenuHistories->patchEntity($new_menuHistory,
                    [   'name' => $this->request->data()['name'],
                        'end' => $future_start['start'],
                        'deleted' => false]);
                }
                if($this->MenuHistories->save($new_menuHistory)){
                    if($flag_future){
                        if($this->MenuHistories->save($menuHistory)){
                            $this->Flash->success('データの変更に成功しました(new-past-future)');
                            return $this->redirect(['action' => 'index']);
                        } else {
                            $this->Flash->error('データの変更に失敗しました(past-future)');
                        }
                    } else {
                        if($this->MenuHistories->save($menuHistory)){
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
     $this->set(compact('menuHistory','date','past_menuHistory','future_menuHistories','future_menuHistory','new_menuHistory','future_start'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inventory Item History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     //元々のやつ
     /*
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
    */

    //新しいやつ
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->Session = $this->request->session();
        if($this->Session->read('MenuHistories.date') == null){
            $date = time();
        } else {
            $date = $this->Session->read('MenuHistories.date');
            $this->Session->write('MenuHistories.date', $date);
        }

        //設定日で有効な履歴
        $menuHistory = $this->MenuHistories -> find()->where(['MenuHistories.id' => $id])->contain(['Menus'])->toArray()[0];
        //設定日から見た未来データ
        $future_menuHistories = $this->MenuHistories -> find()
        ->where(['MenuHistories.menu_item_id' => $menuHistory['menu_item_id']])
        ->contain(['Menus'])
        ->where(['start >' => date('Y-m-d H:i:s', $date)]);

        if(array_key_exists('button', $this->request->data())){
            if($this->request->data()['button'] === 'キャンセル'){
                return $this->redirect(['action' => 'index']);
            } else if($this->request->data()['button'] === '削除') {

                //削除した日を保存する新しいデータを登録する
                $deleted_menuHistory = $this->MenuHistories->newEntity();
                $deleted_menuHistory = $this->MenuHistories->patchEntity($deleted_menuHistory, [
                            'menu_item_id' => $menuHistory['menu_item_id'],
                            'name' => $menuHistory['name'],
                            'start' => date('Y-m-d'.' 00:00:00',$date),
                            'end' => date('Y-m-d'.' 00:00:00',$date),
                            'deleted' => true]);
                if($this->MenuHistories->save($deleted_menuHistory)){
                    //有効なデータのendを設定日にする
                    $menuHistory = $this->MenuHistories->patchEntity($menuHistory,
                        [   'id' => $menuHistory -> id ,
                            'end' => date('Y-m-d',$date).' 00:00:00']);
                    if($this->MenuHistories->save($menuHistory)){
                        //未来データもdeleted = tureにする
                        foreach ($future_menuHistories as $future_menuHistory) {
                            $future_menuHistory = $this->MenuHistories->patchEntity($future_menuHistory,
                            [   'id' => $future_menuHistory -> id ,
                                'deleted' => true]);
                            if($this->MenuHistories->save($future_menuHistory)){
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
         $this->set(compact('menuHistory', 'date','future_menuHistories'));
    }
}