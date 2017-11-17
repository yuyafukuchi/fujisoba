<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * CashAccountTrans Controller
 *
 * @property \App\Model\Table\CashAccountTransTable $CashAccountTrans
 *
 * @method \App\Model\Entity\CashAccountTran[] paginate($object = null, array $settings = [])
 */
class CashAccountTransController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => '/../Users',
                'action' => 'login',
            ],
            'authError' => 'このページにアクセスするためにはログインが必要です。',
        ]);
        $this->Auth->sessionKey = 'Auth.Users';
    }
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $type = $this->Auth->user('type');
        $name = '';
        if($type === 'G')
        {
            $this->redirect(array('controller' => 'Attendance/TimeCards', 'action' => 'login'));
        }
        else if($type === 'H')
        {
            $name = '本社管理者';
            $searchQuery['company_id'] = $this->Auth->user('company_id');
        }
        else if($type === 'M')       
        {
            $searchQuery['company_id'] = $this->Auth->user('company_id');
            $searchQuery['store_id'] = $this->Auth->user('store_id');
            $name = $this->CashAccountTrans->Stores->get($this->Auth->user('store_id'))['name'];
        }
         $data = array('type' => $type, 'name' => $name);
         $this->set(compact('data'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        debug($this->request->data());
        $this->paginate = [
            'contain' => ['Stores', 'Accounts']
        ];
        if(isset($_GET['store'])){
            $storeId = intval($_GET['store']);
        } else {
            $storeId = 0;
        }
        if($storeId === 0) {
            return $this->redirect(['controller' => '/../Users', 'action' => 'sales']);
        }
        if ($this->request->is('post')) {
            $data = $this->request->data()['transaction_month'];
            $date = strtotime($data['year'].'-'.$data['month']);
        } else {
            $date = strtotime(date('Y-m',time()));
        }
        $cashAccountTrans =$this->CashAccountTrans->find()->where(['store_id' => $storeId, 'transaction_date >=' => date('Y-m-d',$date), 'transaction_date <' => date('Y-m-d',strtotime('+1 month', $date))])
                                    ->order(['transaction_date' => 'ASC']);
        $this->Session = $this->request->session();
        $this->Session->write('CashAccountTrans.newTrans', array());
        $this->Session->write('CashAccountTrans.date',null);
        $date = explode('-',date('Y-m',$date));
        $accounts = $this->CashAccountTrans->Accounts->find('list', ['limit' => 200]);
        $this->set(compact('cashAccountTrans', 'date', 'accounts'));
        $this->set('_serialize', ['cashAccountTrans']);
    }

    /**
     * View method
     *
     * @param string|null $id Cash Account Tran id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cashAccountTran = $this->CashAccountTrans->get($id, [
            'contain' => ['Stores', 'Accounts']
        ]);

        $this->set('cashAccountTran', $cashAccountTran);
        $this->set('_serialize', ['cashAccountTran']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $type = $this->Auth->user('type');
        if($type != 'M')
        {
            $this->redirect(array('action' => 'index'));
        }
        $this->Session = $this->request->session();
        $cashAccountTrans = $this->Session->read('CashAccountTrans.newTrans');
        $date = $this->Session->read('CashAccountTrans.date');
        if($date == null){
            $date = time();
            $this->Session->write('CashAccountTrans.date', date('Y-m-d',$date));
        } else {
            $date = strtotime($date);
        }
        if ($this->request->is('post')) {
            $data = $this->request->data();
            if($data['button'] === '設定'){
                if($date = strtotime($data['date'])){
                    $this->Session->write('CashAccountTrans.date', date('Y-m-d',$date));
                } else {
                    $this->Flash->error('入力された日付が不正です。');
                }
            } else if($data['button'] === '送信'){
                unset($data['button']);
                if(!is_array($cashAccountTrans)){
                    $cashAccountTrans = array();
                }
                if(count($data) != 0){
                    array_push($cashAccountTrans, $data);
                    $this->Session->write('CashAccountTrans.newTrans',$cashAccountTrans);
                }
            }
        }
            $cashAccountTran = $this->CashAccountTrans->newEntity();
            /*
            if ($this->request->is('post')) {
                $cashAccountTran = $this->CashAccountTrans->patchEntity($cashAccountTran, $this->request->getData());
                if ($this->CashAccountTrans->save($cashAccountTran)) {
                    $this->Flash->success(__('The cash account tran has been saved.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The cash account tran could not be saved. Please, try again.'));
            }
            }
        */
        $date = explode('-',date('Y-m-d',$date));
        $stores = $this->CashAccountTrans->Stores->find('list', ['limit' => 200]);
        $accounts = $this->CashAccountTrans->Accounts->find('list', ['limit' => 200]);
        $this->set(compact('cashAccountTran','cashAccountTrans', 'stores', 'accounts','date'));
        $this->set('_serialize', ['cashAccountTrans']);
    }
    
    public function addConfirm() {
        $this->Session = $this->request->session();
        $cashAccountTrans = $this->Session->read('CashAccountTrans.newTrans');
        $date = $this->Session->read('CashAccountTrans.date');
        if($date = null){
            $date = time();
        } else {
            $date = strtotime($this->Session->read('CashAccountTrans.date'));
        }
        $store_id = $this->Auth->user('store_id');
        foreach ($cashAccountTrans as &$cashAccountTran){
            $cashAccountTran['transaction_date'] = date('Y-m-d H:i:s', $date);
            $cashAccountTran['store_id'] = $store_id;
        }
        $cashAccountTrans = $this->CashAccountTrans->newEntities($cashAccountTrans);
        if($this->CashAccountTrans->saveMany($cashAccountTrans)){
            $this->Flash->success('現金出納のデータを登録しました。');
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error('データの保存に失敗しました');
            return $this->redirect(['action' => 'add']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Cash Account Tran id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cashAccountTran = $this->CashAccountTrans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cashAccountTran = $this->CashAccountTrans->patchEntity($cashAccountTran, $this->request->getData());
            if ($this->CashAccountTrans->save($cashAccountTran)) {
                $this->Flash->success(__('The cash account tran has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cash account tran could not be saved. Please, try again.'));
        }
        $stores = $this->CashAccountTrans->Stores->find('list', ['limit' => 200]);
        $accounts = $this->CashAccountTrans->Accounts->find('list', ['limit' => 200]);
        $this->set(compact('cashAccountTran', 'stores', 'accounts'));
        $this->set('_serialize', ['cashAccountTran']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cash Account Tran id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cashAccountTran = $this->CashAccountTrans->get($id);
        if ($this->CashAccountTrans->delete($cashAccountTran)) {
            $this->Flash->success(__('The cash account tran has been deleted.'));
        } else {
            $this->Flash->error(__('The cash account tran could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function deleteCache($id = null)
    {
        $id = intVal($id);
        if($id == 0){
             $this->Flash->error('エラー：不正な操作です');
             return $this->redirect(['action' => 'add']);
        } else {
            $id --;
            $this->Session = $this->request->session();
            $cashAccountTrans = $this->Session->read('CashAccountTrans.newTrans');
            unset($cashAccountTrans[$id]);
            $this->Session->write('CashAccountTrans.newTrans', $cashAccountTrans);
            $this->Flash->success('現金出納のデータを削除しました');
            return $this->redirect(['action' => 'add']);
        }
        
        //$data = $this->request->data();
        //return $this->redirect(['action' => 'index']);
    }
}
