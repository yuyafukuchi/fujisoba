<?php
namespace App\Controller\Attendance;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * MonthlyTimeCards Controller
 *
 * @property \App\Model\Table\MonthlyTimeCardsTable $MonthlyTimeCards
 *
 * @method \App\Model\Entity\MonthlyTimeCard[] paginate($object = null, array $settings = [])
 */
class MonthlyTimeCardsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => '/../Users',
                'action' => 'login',
            ],
            'authError' => 'ログインしてください',
        ]);
        $this->loadComponent('Search.Prg');
        $this->Auth->sessionKey = 'Auth.Users';
    }


    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Users = TableRegistry::get('users');
        $type = $this->Auth->user('type');
        $name = '';
        if($type === 'G')
        {
            $this->redirect(array('controller' => 'TimeCards', 'action' => 'login'));
        }
        else if($type === 'H')
        {
            $name = '本社管理者 様';
            $companies = $this->Users->Companies->find('list', ['limit' => 200])
                ->where(['id' => $this->Auth->user('company_id')]);
            $stores = $this->Users->Stores->find('list', ['limit' => 200])
                ->where(['company_id' => $this->Auth->user('company_id')]);
        }
        else if($type === 'M')
        {
            $name = $this->Users->Stores->get($this->Auth->user('store_id'))['name'].'管理者 様';
            $companies = $this->Users->Companies->find('list', ['limit' => 200])
                ->where(['id' => $this->Auth->user('company_id')]);
            $stores = $this->Users->Stores->find('list', ['limit' => 200])
                // ->where(['company_id' => $this->Auth->user('company_id')])
                ->where(['id' => $this->Auth->user('store_id')]);
        }
         $data = array('type' => $type, 'name' => $name);
         $this->set(compact('companies', 'stores','data'));
         $this->set('data2', $data);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        // なぜか POST が GET に変換されるバグの応急処置
        $this->request->data = $this->request->query();

        $this->paginate = [
            'contain' => ['Employees','Employees.Companies', 'Employees.Stores']
        ];
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
        if(array_key_exists('date',$searchQuery)){
             $searchQuery['dateQuery'] = $searchQuery['date']['year'].'-'.$searchQuery['date']['month'].'-01';
        }
        $monthlyTimeCards = $this->MonthlyTimeCards->find('search', ['search' => $searchQuery])
            ->contain(['Employees','Employees.Companies', 'Employees.Stores'])
            ->order(['Stores.name_kana' => 'ASC'])
            ->order(['Employees.code' => 'ASC'])
            ->toArray();
        $timeCardIDs = array();
        /* これを入れると止まる（なんで？）
        foreach ($monthlyTimeCards as $monthlyTimeCard){
            array_push($timeCardIDs,$monthlyTimeCard['id']);
        }*/

        $isSearch = !empty($this->request->getQuery('is_search'));

        // $monthlyTimeCards = $this->paginate($monthlyTimeCards)->toArray();
        foreach ($monthlyTimeCards as $monthlyTimeCard){
            array_push($timeCardIDs,$monthlyTimeCard['id']);
            switch ($monthlyTimeCard->employee->contact_type){
                case 'P':
                    $monthlyTimeCard->employee->contact_type = '正社員';
                    break;
                case 'C':
                    $monthlyTimeCard->employee->contact_type = '契約社員';
                    break;
                case 'A':
                    $monthlyTimeCard->employee->contact_type = 'アルバイト';
                    break;
            }
            if ($monthlyTimeCard->employee->retired != null && $monthlyTimeCard->employee->retired->format('Y-m-d') <= date('Y-m-d')) {
                $monthlyTimeCard->employee->retired = ' <span class="text-danger">(退職)</span>';
            } else {
                $monthlyTimeCard->employee->retired = null;
            }
        }
        $this->Session = $this->request->session();
        $this->Session->write('MonthlyTimeCard.idArray', $timeCardIDs);
        $this->set(compact('monthlyTimeCards', 'isSearch'));
        $this->set('_serialize', ['monthlyTimeCards']);
    }

    /**
     * View method
     *
     * @param string|null $id Monthly Time Card id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($index = null)
    {
        $this->loadModel('TimeCards');

        $index = intval($index);
        $this->Session = $this->request->session();
        $idArray = $this->Session->read('MonthlyTimeCard.idArray');
        if($idArray == null || count($idArray) == 0){
            $this->Session->delete('MonthlyTimeCard.idArray');
            return $this->redirect(['action' => 'index']);
        }
        $length = count($idArray);
        if(!($index-1 >= 0 && $index-1 < $length)){
            $this->Session->delete('MonthlyTimeCard.idArray');
            return $this->redirect(['action' => 'index']);
        }
        $id = $idArray[$index-1];
        $monthlyTimeCard = $this->MonthlyTimeCards->get($id, [
            'contain' => ['Employees','Employees.Companies', 'Employees.Stores']
        ]);

        // Set date
        if(!isset($_GET['t']) || !preg_match('/\A\d{4}-\d{2}\z/', $_GET['t'])){
            if(intval(date('d',time())) >= 16){
                $date = strtotime('+1 month',time());
            } else {
                $date = time();
            }
        }else{
            $date = strtotime($_GET['t']);
        }

        // Get current MonthlyTimeCard entity
        $currentMonthlyTimeCard = $this->MonthlyTimeCards->find()
            ->where(['MonthlyTimeCards.date' => date('Y-m-01', $date)])
            ->where(['MonthlyTimeCards.employee_id' => $monthlyTimeCard->employee_id])
            ->first();

        if ($this->request->is('post')) {
            // debug($this->request->data()); // die;

            // Save summary
            if (!empty($this->request->getData('MonthlyTimeCards'))) {
                // debug($this->request->getData('MonthlyTimeCards'));
                if (isset($currentMonthlyTimeCard->id)) {
                    // UPDATE
                    $currentMonthlyTimeCard = $this->MonthlyTimeCards->patchEntity($currentMonthlyTimeCard, $this->request->getData('MonthlyTimeCards'));
                    // debug($currentMonthlyTimeCard);die;
                    $this->MonthlyTimeCards->save($currentMonthlyTimeCard);
                } else {
                    // NEW
                    $currentMonthlyTimeCard = $this->MonthlyTimeCards->newEntity();
                    $currentMonthlyTimeCard = $this->MonthlyTimeCards->patchEntity($currentMonthlyTimeCard, $this->request->getData('MonthlyTimeCards'));
                    $currentMonthlyTimeCard = $this->MonthlyTimeCards->patchEntity($currentMonthlyTimeCard, [
                        'employee_id' => $monthlyTimeCard->employee_id,
                        'date' => date('Y-m-01', $date),
                    ]);
                    $this->MonthlyTimeCards->save($currentMonthlyTimeCard);
                }
            }

            // Save TimeCards
            if (!empty($this->request->getData('TimeCard'))) {
                $tempTimeCards = $this->request->getData('TimeCard');
                // debug($tempTimeCards); // die;

                foreach ($tempTimeCards as $tempTimeCard) {
                    // Determine blank data
                    $isNull = true;
                    // debug($tempTimeCard);
                    foreach ($tempTimeCard as $key => $tempTimeCardData) {
                        if (in_array($key, ['employee_id', 'date', 'store_id', 'attendance_store_id'])) {
                            continue;
                        }

                        if (!empty($tempTimeCardData)) {
                            $isNull = false;
                        }

                        // Append date into user input time
                        if (in_array($key, ['in_time', 'out_time', 'in_time2', 'out_time2', 'scheduled_in_time', 'scheduled_out_time', 'scheduled_in_time2', 'scheduled_out_time2'])) {
                            if (preg_match('/^[0-9]{2}:[0-9]{2}$/', $tempTimeCardData)) {
                                $tempTime = explode(':', $tempTimeCardData);
                                if (count($tempTime) === 2) {
                                    if ((int)$tempTime[0] >= 24) {
                                        $tempTime[0] = $tempTime[0] - 24;
                                        $tempTime[0] = sprintf('%02d', $tempTime[0]);
                                        $tempTime = implode(':', $tempTime);
                                        $tempTimeCard[$key] = sprintf('%s %s:00', date('Y-m-d', strtotime('+1 days', strtotime($tempTimeCard['date']))), $tempTime);
                                    } else {
                                        $tempTimeCard[$key] = sprintf('%s %s:00', $tempTimeCard['date'], $tempTimeCardData);
                                    }
                                }
                                $tempDate = strtotime($tempTimeCard[$key]);
                            }
                        }
                    } // debug($tempTimeCard);

                    // Save data
                    if (!$isNull) {
                        if (isset($tempTimeCard['id'])) {
                            // UPDATE
                            $newTimeCard = $this->TimeCards->get($tempTimeCard['id']);
                            $newTimeCard = $this->TimeCards->patchEntity($newTimeCard, $tempTimeCard);
                            $dirtyFields = $newTimeCard->dirty_fields;
                            if (!empty($dirtyFields)) {
                                $dirtyFields = unserialize($dirtyFields);
                                $dirtyFields = array_merge($dirtyFields, $newTimeCard->getDirty());
                                $dirtyFields = array_unique($dirtyFields);
                            } else {
                                $dirtyFields = $newTimeCard->getDirty();
                            }
                            $newTimeCard = $this->TimeCards->patchEntity($newTimeCard, ['dirty_fields' => serialize($dirtyFields)]);
                            // debug($newTimeCard);
                            $this->TimeCards->save($newTimeCard);
                        } else {
                            // NEW
                            $newTimeCard = $this->TimeCards->newEntity();
                            $newTimeCard = $this->TimeCards->patchEntity($newTimeCard, $tempTimeCard);
                            // debug($newTimeCard);die;
                            $this->TimeCards->save($newTimeCard);
                        }
                    }
                }
            }

            if($this->request->data()['button'] === '承認'){
                $monthlyTimeCard = $this->MonthlyTimeCards->patchEntity($monthlyTimeCard,array('id' => $monthlyTimeCard['id'],'approved' => true));
                $this->MonthlyTimeCards->save($monthlyTimeCard);
                $this->Flash->success('この勤務表を承認しました');
            }
            else if($this->request->data()['button'] === '非承認'){
                $monthlyTimeCard = $this->MonthlyTimeCards->patchEntity($monthlyTimeCard,array('id' => $monthlyTimeCard['id'],'approved' => false));
                $this->MonthlyTimeCards->save($monthlyTimeCard);
                $this->Flash->success('この勤務表の承認を取り消しました');
            }
        }
        $approveButton = $monthlyTimeCard['approved'] ? '非承認' : '承認';

        // get timeCards
        $timeCardsOld = $this->TimeCards->find()
            ->where([
                'employee_id' => $monthlyTimeCard['employee_id'],
                'date >=' => date('Y-m',strtotime('-1 month',$date)).'-16',
                'date <=' => date('Y-m',$date).'-15'
            ])
            ->toArray();
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

        $data = array(  'index' => $index,
                        'length' => $length,
                        'current_year'=>date('Y',$date),
                        'current_month'=>date('m',$date),
                        'approveButton' => $approveButton,
                        'employee' => $monthlyTimeCard->employee,
        );

        $this->set(compact('monthlyTimeCard','timeCards','data','currentMonthlyTimeCard'));
        $this->set('_serialize', ['monthlyTimeCard']);
    }

    /**
     * Print View method
     *
     * @param string|null $id Monthly Time Card id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewPrint($index = null)
    {
        $this->viewBuilder()->setLayout('print');

        $index = intval($index);
        $this->Session = $this->request->session();
        $idArray = $this->Session->read('MonthlyTimeCard.idArray');
        if($idArray == null || count($idArray) == 0){
            $this->Session->delete('MonthlyTimeCard.idArray');
            return $this->redirect(['action' => 'index']);
        }
        $length = count($idArray);
        if(!($index-1 >= 0 && $index-1 < $length)){
            $this->Session->delete('MonthlyTimeCard.idArray');
            return $this->redirect(['action' => 'index']);
        }
        $id = $idArray[$index-1];
        $monthlyTimeCard = $this->MonthlyTimeCards->get($id, [
            'contain' => ['Employees','Employees.Companies', 'Employees.Stores']
        ]);
        if ($this->request->is('post')) {
            if($this->request->data()['button'] === '承認'){
                $monthlyTimeCard = $this->MonthlyTimeCards->patchEntity($monthlyTimeCard,array('id' => $monthlyTimeCard['id'],'approved' => true));
                $this->MonthlyTimeCards->save($monthlyTimeCard);
                $this->Flash->success('この勤務表を承認しました');
            }
            else if($this->request->data()['button'] === '非承認'){
                $monthlyTimeCard = $this->MonthlyTimeCards->patchEntity($monthlyTimeCard,array('id' => $monthlyTimeCard['id'],'approved' => false));
                $this->MonthlyTimeCards->save($monthlyTimeCard);
                $this->Flash->success('この勤務表の承認を取り消しました');
            }
            debug($this->request->data());
        }
        $approveButton = $monthlyTimeCard['approved'] ? '非承認' : '承認';

        // get timeCards
        $this->TimeCards = TableRegistry::get('time_cards');

        if(!isset($_GET['t']) || !preg_match('/\A\d{4}-\d{2}\z/', $_GET['t'])){
            if(intval(date('d',time())) >= 16){
                $date = strtotime('+1 month',time());
            } else {
                $date = time();
            }
        }else{
            $date = strtotime($_GET['t']);
        }
        $timeCardsOld = $this->TimeCards->find()
            ->where([
                'employee_id' => $monthlyTimeCard['employee_id'],
                'date >=' => date('Y-m', strtotime('-1 month',$date)).'-16',
                'date <=' => date('Y-m', $date).'-15',
            ])
            ->toArray();

        $timeCards = [];
        foreach ($timeCardsOld as $timeCard){
            $key = $timeCard['date']->i18nFormat('YYYY-MM-dd');
            $storeName = $this->TimeCards->Stores->get($timeCard['attendance_store_id'])['name'];
            if($timeCard['store_id'] != $timeCard['attendance_store_id']){
                $storeName = $storeName . '【応援】';
            }
            $timeCard['storeName'] = $storeName;
            $timeCards[$key] = $timeCard;
        }

        $data = [
            'index' => $index,
            'length' => $length,
            'current_year'=>date('Y',$date),
            'current_month'=>date('m',$date),
            'approveButton' => $approveButton,
            'employee' => $monthlyTimeCard->employee,
        ];

        // Update `printed` flag
        $currentMonthlyTimeCard = $this->MonthlyTimeCards->find()
            ->where(['MonthlyTimeCards.date' => date('Y-m-01', $date)])
            ->where(['MonthlyTimeCards.employee_id' => $monthlyTimeCard['employee_id']])
            ->first();
        if (isset($currentMonthlyTimeCard->id)) {
            $currentMonthlyTimeCard = $this->MonthlyTimeCards->patchEntity($currentMonthlyTimeCard, ['printed' => 1]);
            $this->MonthlyTimeCards->save($currentMonthlyTimeCard);
        }

        $this->set(compact('monthlyTimeCard','timeCards','data','currentMonthlyTimeCard'));
        $this->set('_serialize', ['monthlyTimeCard']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $monthlyTimeCard = $this->MonthlyTimeCards->newEntity();
        if ($this->request->is('post')) {
            $monthlyTimeCard = $this->MonthlyTimeCards->patchEntity($monthlyTimeCard, $this->request->getData());
            if ($this->MonthlyTimeCards->save($monthlyTimeCard)) {
                $this->Flash->success(__('The monthly time card has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The monthly time card could not be saved. Please, try again.'));
        }
        $employees = $this->MonthlyTimeCards->Employees->find('list', ['limit' => 200]);
        $this->set(compact('monthlyTimeCard', 'employees'));
        $this->set('_serialize', ['monthlyTimeCard']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Monthly Time Card id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $monthlyTimeCard = $this->MonthlyTimeCards->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $monthlyTimeCard = $this->MonthlyTimeCards->patchEntity($monthlyTimeCard, $this->request->getData());
            if ($this->MonthlyTimeCards->save($monthlyTimeCard)) {
                $this->Flash->success(__('The monthly time card has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The monthly time card could not be saved. Please, try again.'));
        }
        $employees = $this->MonthlyTimeCards->Employees->find('list', ['limit' => 200]);
        $this->set(compact('monthlyTimeCard', 'employees'));
        $this->set('_serialize', ['monthlyTimeCard']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Monthly Time Card id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $monthlyTimeCard = $this->MonthlyTimeCards->get($id);
        if ($this->MonthlyTimeCards->delete($monthlyTimeCard)) {
            $this->Flash->success(__('The monthly time card has been deleted.'));
        } else {
            $this->Flash->error(__('The monthly time card could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
