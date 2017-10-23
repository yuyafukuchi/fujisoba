<?php
namespace App\Controller\Attendance;

use App\Controller\AppController;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class EmployeesController extends AppController
{
    
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
        $this->Auth->sessionKey = 'Auth.Users';
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
        $employees = $this->paginate($this->Employees);
        debug($this->Employees->find()->toArray());
        $this->set(compact('employees'));
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
            debug($employee->errors());
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
        $companies = $this->Employees->Companies->find('list', ['limit' => 200]);
        $stores = $this->Employees->Stores->find('list', ['limit' => 200]);
        $this->set(compact('employee', 'companies', 'stores'));
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
        $companies = $this->Employees->Companies->find('list', ['limit' => 200]);
        $stores = $this->Employees->Stores->find('list', ['limit' => 200]);
        $this->set(compact('employee', 'companies', 'stores'));
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
        if ($this->Employees->delete($employee)) {
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
