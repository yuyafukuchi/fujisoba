<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'authError' => 'このページを見るためにはログインが必要です',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'name','password' => 'password']    // ログインID対象をemailカラムへ
                ]
            ]
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
            $companies = $this->Users->Companies->find('list', ['limit' => 200]);
            $stores = $this->Users->Stores->find('list', ['limit' => 200]);
        }
        else if($type === 'M')
        {
            $searchQuery['company_id'] = $this->Auth->user('company_id');
            $searchQuery['store_id'] = $this->Auth->user('store_id');
            $name = $this->Users->Stores->get($this->Auth->user('store_id'))['name'].'/店舗管理者';
            $companies = $this->Users->Companies->find('list', ['limit' => 200])->where(['id' => $this->Auth->user('company_id')]);
            $stores = $this->Users->Stores->find('list', ['limit' => 200])->where(['id' => $this->Auth->user('store_id')]);
        }
         $data = array('type' => $type, 'name' => $name);
         $this->set(compact('companies', 'stores','data'));
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies', 'Stores']
        ];
        $users = $this->paginate($this->Users);
        if($this->Auth->user('type') === 'G'){
            $this->redirect(array('controller' => 'Attendance/TimeCards', 'action' => 'login'));
        }
        $data = array('users' => $users, 'type' => $this->Auth->user('type'));
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);

    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Companies', 'Stores']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $companies = $this->Users->Companies->find('list', ['limit' => 200]);
        $stores = $this->Users->Stores->find('list', ['limit' => 200]);
        $this->set(compact('user', 'companies', 'stores'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            if($data['button'] === 'キャンセル'){
                return $this->redirect(['action' => 'list']);
            } else if($data['button'] === '変更'){
                $data['id'] = $id;
                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('パスワードを変更しました。'));
                    return $this->redirect(['action' => 'list']);
                }
                debug($user->errors());
                $this->Flash->error(__('正しいパスワードを入力してください'));
            }
        }
        $companies = $this->Users->Companies->find('list', ['limit' => 200]);
        $stores = $this->Users->Stores->find('list', ['limit' => 200]);
        $this->set(compact('user', 'companies', 'stores'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        if($this->request->is('post')) {
            $user = $this->Auth->identify();

            if($user) {
              $this->Auth->setUser($user);
              if($user['type'] === 'G'){
                  $this->redirect('/attendance/time-cards/login');
              }
              else{
                  $this->redirect(array('controller' => 'Users', 'action' => 'index'));
              }
              //$this->redirect($this->Auth->redirectUrl());
            } else {
              $this->Flash->error('ログインエラーです');
            }
         }
    }

    public function logout() {
        $this->Auth->logout();
        $this->redirect(array('controller' => 'Users', 'action' => 'login'));
    }

    public function attendance() {
        $this->set('mode', 'atendance');

        if($this->Auth->user('type') === 'G'){
            $this->redirect(array('controller' => 'Attendance/TimeCards', 'action' => 'login'));
        }
        $users = $this->paginate($this->Users);
        $type = $this->Auth->user('type');
        $name = '';
        if($type === 'H')
        {
            $name = '本社管理者 様';
        }
        if($type === 'M')
        {
            $name = $this->Users->Stores->get($this->Auth->user('store_id'))['name'].'管理者 様';
        }
        $data = array('users' => $users, 'type' => $type, 'name' => $name);
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

    public function sales() {
       $storeId = $this->Auth->user('store_id');
       if($this->Auth->user('type') == 'H'){
            $this->Stores = TableRegistry::get('stores');
            $stores = $this->Stores->find()->select(['id','name'])->where(['company_id' => $this->Auth->user('company_id')]);
            $storeId = null;
       }
       $this->set(compact('storeId', 'stores'));
    }

    public function list() {
        $users = $this->Users->find()->select(['id', 'name']);
        $this->set(compact('users'));
    }

}
