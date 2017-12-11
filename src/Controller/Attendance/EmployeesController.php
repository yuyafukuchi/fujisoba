<?php
namespace App\Controller\Attendance;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class EmployeesController extends AppController
{
    public $paginate = [
        'order' => [
            'Employees.code' => 'asc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => '/../Users',
                'action' => 'login',
            ],
            'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Employees',
                    'fields' => ['code' => 'code']    // ログインID対象をemailカラムへ
                ]
            ]
        ]);
        $this->loadComponent('Search.Prg');
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
            $name = '本社管理者 様';
            $searchQuery['company_id'] = $this->Auth->user('company_id');
            $companies = $this->Employees->Companies->find('list', ['limit' => 200])
                ->where(['id' => $this->Auth->user('company_id')]);
            $stores = $this->Employees->Stores->find('list', ['limit' => 200])
                ->where(['company_id' => $this->Auth->user('company_id')]);
        }
        else if($type === 'M')
        {
            $searchQuery['company_id'] = $this->Auth->user('company_id');
            $searchQuery['store_id'] = $this->Auth->user('store_id');
            $name = $this->Employees->Stores->get($this->Auth->user('store_id'))['name'].'管理者 様';
            $companies = $this->Employees->Companies->find('list', ['limit' => 200])
                ->where(['id' => $this->Auth->user('company_id')]);
            $stores = $this->Employees->Stores->find('list', ['limit' => 200])
                ->where(['id' => $this->Auth->user('store_id')]);
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
        // なぜか POST が GET に変換されるバグの応急処置
        $this->request->data = $this->request->query();

        $searchQuery = $this->request->query();
        $searchQuery['deleted'] = 0;

        $type = $this->Auth->user('type');
        if($type === 'H')
        {
            $searchQuery['company_id'] = $this->Auth->user('company_id');
        }
        else if($type === 'M')
        {
            $searchQuery['company_id'] = $this->Auth->user('company_id');
            $searchQuery['store_id'] = $this->Auth->user('store_id');
        }

        $isSearch = !empty($this->request->getQuery('is_search'));

        $employees = $this->Employees->find('search', ['search' => $searchQuery])
            ->contain(['Companies', 'Stores'])
            ->order(['Stores.name_kana' => 'ASC'])
            ->order(['Employees.code' => 'ASC'])
            ->toArray();
        foreach ($employees as $employee){
            switch ($employee['contact_type']){
                case 'P':
                    $employee['contact_type'] = '正社員';
                    break;
                case 'C':
                    $employee['contact_type'] = '契約社員';
                    break;
                case 'A':
                    $employee['contact_type'] = 'アルバイト';
                    break;
            }
        }
        $this->set(compact('employees', 'isSearch'));
        //$this->set(compact('employees'));
        $this->set('_serialize', ['employees']);
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => ['Companies', 'Stores', 'TimeCards']
        ]);

        $this->set('employee', $employee);
        $this->set('_serialize', ['employee']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $sentData = $this->request->data();
            $sentData['deleted'] = false;
            $employee = $this->Employees->patchEntity($employee, $sentData);
            $saveResult = $this->Employees->save($employee);
            if ($saveResult) {
                $this->Flash->success('従業員を登録しました。');

                return $this->redirect(['action' => 'edit', $saveResult->id]);
            } else {
                $this->Flash->error('登録に失敗しました。もう一度お試しください。');
            }
        }

        $this->set(compact('employee'));
        $this->set('_serialize', ['employee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->data);
            // debug($employee); die;
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'edit', $id]);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }

        $this->set(compact('employee'));
        $this->set('_serialize', ['employee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        $employee->deleted = true;
        if ($this->Employees->save($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function admin(){

    }
    public function login(){
         if ($this->request->is('post')) {
             $user = $this->Auth->identify();
             if ($user) {
                 $this->Auth->setUser($user);    // データをセットしてログイン
                 return $this->redirect($this->Auth->redirectUrl());
             } else {
                 $this->Flash->error(
                     __('Username or password is incorrect'),
                    'default',
                    [],
                    'auth'
                 );
            }
        }
    }
}
