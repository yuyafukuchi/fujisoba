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
            $companies = $this->Employees->Companies->find('list', ['limit' => 200]);
            $stores = $this->Employees->Stores->find('list', ['limit' => 200]);
        }
        else if($type === 'M')       
        {
            $searchQuery['company_id'] = $this->Auth->user('company_id');
            $searchQuery['store_id'] = $this->Auth->user('store_id');
            $name = $this->Employees->Stores->get($this->Auth->user('store_id'))['name'].'管理者 様';
            $companies = $this->Employees->Companies->find('list', ['limit' => 200])->where(['id' => $this->Auth->user('company_id')]);
            $stores = $this->Employees->Stores->find('list', ['limit' => 200])->where(['id' => $this->Auth->user('store_id')]);
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
        $searchQuery = $this->request->query();
        $searchQuery['deleted'] = 0;
        if(!array_key_exists('retired',$searchQuery)){
            $searchQuery['retired'] = 0;
        }
        $this->paginate = [
            'contain' => ['Companies', 'Stores']
        ];
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
        
        $employees = $this->Employees->find('search', ['search' => $searchQuery]);
        $employees = $this->paginate($employees)->toArray();
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
            if($employee['retired'] != null){
                $employee['retired'] = ' (退職)';
            }
        }
        $this->set(compact('employees'));
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
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            if(array_key_exists('code',$employee->errors())){
                if(array_key_exists('unique',$employee->errors()['code'])){
                    $this->Flash->error(__('エラー：その従業員コードはすでに存在します'));
                } else {
                    $this->Flash->error(__('The employee could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
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
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
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
