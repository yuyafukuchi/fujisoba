<?php
namespace App\Controller\Attendance;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * TimeCards Controller
 *
 * @property \App\Model\Table\TimeCardsTable $TimeCards
 */
class TimeCardsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'TimeCards',
                'action' => 'login',
            ],
            'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'code','password' => 'code']    // ログインID対象をemailカラムへ
                ]
            ]
        ]);
        $this->Auth->config('authenticate', [
            'Form' => ['userModel' => 'Employees']
        ]);
        $this->Auth->sessionKey = 'Auth.Employee';
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees', 'Stores']
        ];
        $timeCards = $this->paginate($this->TimeCards);
        $this->set(compact('timeCards'));
        $this->set('_serialize', ['timeCards']);
    }

    /**
     * View method
     *
     * @param string|null $id Time Card id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $timeCard = $this->TimeCards->get($id, [
            'contain' => ['Employees', 'Stores']
        ]);

        $this->set('timeCard', $timeCard);
        $this->set('_serialize', ['timeCard']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $timeCard = $this->TimeCards->newEntity();
        if ($this->request->is('post')) {
            $timeCard = $this->TimeCards->patchEntity($timeCard, $this->request->data);
            if ($this->TimeCards->save($timeCard)) {
                $this->Flash->success(__('The time card has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The time card could not be saved. Please, try again.'));
        }
        $employees = $this->TimeCards->Employees->find('list', ['limit' => 200]);
        $stores = $this->TimeCards->Stores->find('list', ['limit' => 200]);
        $this->set(compact('timeCard', 'employees', 'stores'));
        $this->set('_serialize', ['timeCard']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Time Card id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $timeCard = $this->TimeCards->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timeCard = $this->TimeCards->patchEntity($timeCard, $this->request->data);
            if ($this->TimeCards->save($timeCard)) {
                $this->Flash->success(__('The time card has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The time card could not be saved. Please, try again.'));
        }
        $employees = $this->TimeCards->Employees->find('list', ['limit' => 200]);
        $stores = $this->TimeCards->Stores->find('list', ['limit' => 200]);
        $this->set(compact('timeCard', 'employees', 'stores'));
        $this->set('_serialize', ['timeCard']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Time Card id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $timeCard = $this->TimeCards->get($id);
        if ($this->TimeCards->delete($timeCard)) {
            $this->Flash->success(__('The time card has been deleted.'));
        } else {
            $this->Flash->error(__('The time card could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function emboss(){
        $this->Session = $this->request->session();
        if($this->Session->read('TimeCard.isSupport')){
            $support = 'ほげほげ';
        }else{
            $support = '';
        }
        $timeCard = $this->TimeCards->find()->where(['date' => date('Y-m-d')])->toArray();
        if(count($timeCard) == 0){
            $this->set('timeCard',array('in_time'=> null,'out_time'=> null, 'in_time2' => null, 'out_time2'=> null, 'support' => $support));
        }else{
            $timeCard[0]['support'] = $support;
            $this->set('timeCard',$timeCard[0]);
        }
        $this->set('_serialize', ['timeCard']);
       if(!array_key_exists('button',$type = $this->request->data())){
           return;
       }
       $type =  $type = $this->request->data['button'];
        if ($this->request->is('post')) {
            if(count($timeCard) == 0){
                $user = $this->Auth->user();
                $timeCard = $this->TimeCards->newEntity();
                $timeCard = $this->TimeCards->patchEntity($timeCard,array(
                    'employee_id' => $user['id'],
                    'store_id' => $user['store_id'],
                    'in_time' => date('Y-m-d H:i:s'),
                    'date' =>date('Y-m-d')));
                $this->TimeCards->save($timeCard);
            }else{
                $timeCard = $timeCard[0];
                if($type === '退勤'){
                    if($timeCard['out_time'] == null ){
                        $timeCard = $this->TimeCards->patchEntity($timeCard,array(
                        'out_time' => date('Y-m-d H:i:s')));
                        $this->TimeCards->save($timeCard);
                    }else if($timeCard['in_time2'] != null && $timeCard['out_time2'] == null){
                        $timeCard = $this->TimeCards->patchEntity($timeCard,array(
                        'out_time2' => date('Y-m-d H:i:s')));
                        $this->TimeCards->save($timeCard);
                    }
                }else if($type === '出勤'){
                    if($timeCard['out_time'] != null && $timeCard['in_time2'] == null){
                        $timeCard = $this->TimeCards->patchEntity($timeCard,array(
                        'in_time2' => date('Y-m-d H:i:s')));
                        $this->TimeCards->save($timeCard);
                    }else if($timeCard['out_time2'] != null){
                        $this->Flash->error('１日に出勤可能な回数は２回です');
                        return;
                    }else {
                        $this->Flash->error('退勤ボタンが押されていません。');
                        return;
                    }
                }
            }
            $this->Session->write('TimeCard.confirm', array('type' =>$type ,'time' => date('H:i')));
            return $this->redirect(['action' => 'confirm']);
        }
    }
    
    public function login(){
         if ($this->request->is('post')) {
            $this->Employees = TableRegistry::get('employees') ;
            $user = $this->Employees
            ->find()
            ->where(['code' => $this->request->data()['code']])
            ->toArray();
             if (count($user) == 1) {
                 $this->Auth->setUser($user[0]);    // データをセットしてログイン
                 $button = $this->request->data()['loginButton'];
                 debug($button);
                 if($button === 'ログイン'){
                    $this->Session = $this->request->session();
                    $this->Session->write('TimeCard.isSupport', false);
                    //debug("ログインだよ");
                 }else if($button === '別店舗応援'){
                    $this->Session = $this->request->session();
                    $this->Session->write('TimeCard.isSupport', true);
                    //debug("別店舗だよ");
                 }else if($button === '勤怠データ確認'){
                     
                 }
                 $this->redirect(array('controller' => 'TimeCards', 'action' => 'emboss'));
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
    public function confirm(){
        $this->Session = $this->request->session();
        $this->Auth->logout();
        $data = $this->Session->read('TimeCard.confirm');
        $data = $this->Session->delete('TimeCard.confirm');
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }
}
