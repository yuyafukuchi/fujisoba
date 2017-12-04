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
        $this->Auth->sessionKey = 'Auth.Employees';
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        // Set breadcrumbs
        $this->Auth->sessionKey = 'Auth.Users';
        $parentUser = $this->Auth->user();
        $storeName = TableRegistry::get('Stores')->get($parentUser['store_id'])['name'];
        $this->Auth->sessionKey = 'Auth.Employees';
        $user = $this->Auth->user();
        $this->set(compact('storeName', 'user'));

		if(!isset($_GET['t']) || !preg_match('/\A\d{4}-\d{2}\z/', $_GET['t'])){
			$date = time();
		}else{
		    $date = strtotime($_GET['t']);
		}
        $this->paginate = [
            'contain' => ['Employees', 'Stores']
        ];
        //$timeCards = $this->paginate($this->TimeCards);
        //$this->set(compact('timeCards'));
        //$this->set('_serialize', ['timeCards']);

        $this->Auth->sessionKey = 'Auth.Employees';
        $employee_id = $this->Auth->user()['id'];
        $timeCardsOld = $this->TimeCards->find()->where([   'employee_id' => $employee_id,
                                                        'date >=' => date('Y-m',strtotime('-1 month',$date)).'-16',
                                                        'date <=' => date('Y-m',$date).'-15'])->toArray();
        $timeCards = array();
        foreach ($timeCardsOld as $timeCard){
            $key = $timeCard['date']->i18nFormat('YYYY-MM-dd');
            $storeName = $this->TimeCards->Stores->get($timeCard['attendance_store_id'])['name'];
            if($timeCard['store_id'] != $timeCard['attendance_store_id']){
                $storeName = $storeName . '【応援】';
            }
            $timeCard['storeName'] = $storeName;
            $timeCards[$key] = $timeCard;
        }
        //debug($timeCards);
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

    public function emboss()
    {
        $this->Session = $this->request->session();
        $timeCard = $this->TimeCards->find()
            ->where([
                'date' => date('Y-m-d'),
                'employee_id' => $this->Auth->user()['id']
            ])
            ->toArray();

        $this->Auth->sessionKey = 'Auth.Users';
        $parentUser = $this->Auth->user();
        $this->Stores = TableRegistry::get('stores');
        $storeName = $this->Stores->get($parentUser['store_id'])['name'];
        $this->set(compact('storeName'));
        $this->set('_serialize', ['storeName']);
        if($this->Session->read('TimeCard.isSupport')){
            $support = $storeName . '店の応援の勤怠入力です！';
        }else{
            $support = '';
        }
        $this->Auth->sessionKey = 'Auth.Employees';

        if(count($timeCard) == 0){
            $this->set('timeCard',array('in_time'=> null,'out_time'=> null, 'in_time2' => null, 'out_time2'=> null, 'support' => $support));
        }else{
            $timeCard[0]['support'] = $support;
            $this->set('timeCard',$timeCard[0]);
        }
        $this->set('_serialize', ['timeCard']);
        $user = $this->Auth->user();
        $this->set('user',$user);
        $this->set('_serialize', ['user']);
       if(!array_key_exists('button',$type = $this->request->data())){
           return;
       }
       $type =  $type = $this->request->data['button'];

        if ($this->request->is('post')) {  //if post
            $this->Auth->sessionKey = 'Auth.Employees';
            $user = $this->Auth->user();
            $this->MonthlyTimeCards = TableRegistry::get('monthly_time_cards');
            $timeCardMonth = '';
            if(intval(date('d',time())) >= 16){
                $timeCardMonth = date('Y-m-01',strtotime('+1 month',time()));
            } else {
                $timeCardMonth = date('Y-m-01',time());
            }
            $monthlyTimeCard = null;
            if($this->MonthlyTimeCards->find()->where(['employee_id' => $user['id'], 'date' => $timeCardMonth])->count() == 0){
                $monthlyTimeCard = $this->MonthlyTimeCards->newEntity();
                $this->MonthlyTimeCards->patchEntity($monthlyTimeCard,array(
                        'employee_id' => $user['id'],
                        'date' => $timeCardMonth,
                        'printed' => false,
                        'approved' => false,
                        'csv_exported' => false
                        ));
            } else {
                $monthlyTimeCard = $this->MonthlyTimeCards->find()->where(['employee_id' => $user['id'], 'date' => $timeCardMonth])->toArray()[0];
            }

            if(count($timeCard) == 0){
                $timeCard = $this->TimeCards->newEntity();
                $timeCard = $this->TimeCards->patchEntity($timeCard,array(
                    'employee_id' => $user['id'],
                    'store_id' => $user['store_id'],
                    'in_time' => date('Y-m-d H:i:s'),
                    'date' =>date('Y-m-d'),
                    'attendance_store_id' => $parentUser['store_id']));
                $this->TimeCards->save($timeCard);
                $this->saveMonthlyTimeCard($monthlyTimeCard, false);
            }else{
                $timeCard = $timeCard[0];
                if($type === '退勤'){
                    if($timeCard['out_time'] == null ){
                        $timeCard = $this->TimeCards->patchEntity($timeCard,array(
                        'out_time' => date('Y-m-d H:i:s')));
                        $this->TimeCards->save($timeCard);
                        $this->saveMonthlyTimeCard($monthlyTimeCard, true);
                    }else if($timeCard['in_time2'] != null && $timeCard['out_time2'] == null){
                        $timeCard = $this->TimeCards->patchEntity($timeCard,array(
                        'out_time2' => date('Y-m-d H:i:s')));
                        $this->TimeCards->save($timeCard);
                        $this->saveMonthlyTimeCard($monthlyTimeCard, true);
                    }
                }else if($type === '出勤'){
                    if($timeCard['out_time'] != null && $timeCard['in_time2'] == null){
                        $timeCard = $this->TimeCards->patchEntity($timeCard,array(
                        'in_time2' => date('Y-m-d H:i:s')));
                        $this->TimeCards->save($timeCard);
                        $this->saveMonthlyTimeCard($monthlyTimeCard, false);
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

    public function login()
    {
        $this->Auth->sessionKey = 'Auth.Users';
        if($this->Auth->user() == null){
            return $this->redirect(['controller' => '/../Users', 'action' => 'login']);
        }
        $store_id = $this->Auth->user()['store_id'];
        $store_name = $this->TimeCards->Stores->get($store_id)->name;
        $this->set(compact('store_name'));
        $this->set('_serialize', ['store_name']);
        $this->Auth->sessionKey = 'Auth.Employees';
         if ($this->request->is('post')) {
            $button = $this->request->data()['loginButton'];
            $this->Employees = TableRegistry::get('employees') ;
            $this->Session = $this->request->session();
            $user = $this->Employees
            ->find()
            ->where(['code' => $this->request->data()['code']])
            ->toArray();
             if (count($user) == 1) {
                 $user = $user[0];
                 $logIn = false;
                 if($button === '別店舗応援'){
                     if($store_id != $user['store_id']){
                        $this->Session->write('TimeCard.isSupport', true);
                        $logIn = true;
                     }
                 }
                 else if($button === 'ログイン'){
                     if($store_id == $user['store_id']){
                        $this->Session->write('TimeCard.isSupport', false);
                        $logIn = true ;
                     }
                 }else if($button === '勤怠データ確認'){
                     if($store_id == $user['store_id']){
                        $this->Session->write('TimeCard.isSupport', false);
                        $this->Auth->setUser($user);    // データをセットしてログイン
                        $logIn = true ;
                        if(intval(date('d',time())) >= 16){
                            $this->redirect(array('controller' => 'TimeCards', 'action' => 'index','t' => date('Y-m',strtotime('+1 month',strtotime('first day of',time())))));
                        }
                        $this->redirect(array('controller' => 'TimeCards', 'action' => 'index'));
                     }
                 }
                 if($logIn){
                    $this->Auth->setUser($user);    // データをセットしてログイン
                    $this->redirect(array('controller' => 'TimeCards', 'action' => 'emboss'));
                 } else {
                         $this->Flash->error(
                         __('従業員コードが違います'),
                        'default',
                        [],
                        'auth'
                    );
                 }
             } else {
                 $this->Flash->error(
                     __('従業員コードが違います'),
                    'default',
                    [],
                    'auth'
                 );

            }
        }
    }
    public function confirm()
    {
        $this->Session = $this->request->session();

        // Set breadcrumbs
        $this->Auth->sessionKey = 'Auth.Users';
        $parentUser = $this->Auth->user();
        $storeName = TableRegistry::get('Stores')->get($parentUser['store_id'])['name'];
        $this->Auth->sessionKey = 'Auth.Employees';
        $user = $this->Auth->user();
        $this->set(compact('storeName', 'user'));

        $data = $this->Session->read('TimeCard.confirm');
        $this->Session->delete('TimeCard.confirm');

        $this->Auth->logout();

        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }

    public function logout()
    {
        $this->Auth->sessionKey = 'Auth.Employees';
        $this->Auth->logout();
        $this->redirect(array('controller' => 'TimeCards', 'action' => 'login'));
    }

    public function logoutParent()
    {
        $this->Auth->sessionKey = 'Auth.Users';
        $this->Auth->logout();
        $this->redirect(array('controller' => 'Users', 'action' => 'login'));
    }

    public function search()
    {
        $this->Companies = TableRegistry::get('companies');
        $this->Stores = TableRegistry::get('stores');
        $companies = $this->Companies->find('list', ['limit' => 200]);
        $stores = $this->Stores->find('list', ['limit' => 200]);
        $this->set(compact( 'companies', 'stores'));
    }

    private function saveMonthlyTimeCard ($monthlyTimeCard, $finish)
    {
        $this->MonthlyTimeCards = TableRegistry::get('monthly_time_cards');
        $monthlyTimeCard = $this->MonthlyTimeCards->patchEntity($monthlyTimeCard, array(
                    'date' => $monthlyTimeCard['date'],
                    'latest_emboss_day' => date('Y-m-d H:i:s'),
                    'finished' => $finish,
                    'printed' => $monthlyTimeCard['printed'],
                    'approved' => $monthlyTimeCard['approved'],
                    'csv_exported' => $monthlyTimeCard['csv_exported']));
        return $this->MonthlyTimeCards->save($monthlyTimeCard);
    }
}
