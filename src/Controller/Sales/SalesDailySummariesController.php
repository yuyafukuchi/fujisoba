<?php
namespace App\Controller\Sales;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


class SalesDailySummariesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => '/../Users',
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

    public function index()
    {
        $salesDailySummaries = $this->paginate($this->SalesDailySummaries);

        $this->set(compact('salesDailySummaries'));
        $this->set('_serialize', ['salesDailySummaries']);
    }

    /**
     * View method
     *
     * @param string|null $id Sales Daily Summary id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {


        $salesDailySummary = $this->SalesDailySummaries->find();


        $this->set('salesDailySummary', $salesDailySummary);
        $this->set('_serialize', ['salesDailySummary']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesDailySummary = $this->SalesDailySummaries->newEntity();
        if ($this->request->is('post')) {
            $salesDailySummary = $this->SalesDailySummaries->patchEntity($salesDailySummary, $this->request->getData());
            if ($this->SalesDailySummaries->save($salesDailySummary)) {
                $this->Flash->success(__('The sales daily summary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales daily summary could not be saved. Please, try again.'));
        }
        $this->set(compact('salesDailySummary'));
        $this->set('_serialize', ['salesDailySummary']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Daily Summary id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesDailySummary = $this->SalesDailySummaries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesDailySummary = $this->SalesDailySummaries->patchEntity($salesDailySummary, $this->request->getData());
            if ($this->SalesDailySummaries->save($salesDailySummary)) {
                $this->Flash->success(__('The sales daily summary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales daily summary could not be saved. Please, try again.'));
        }
        $this->set(compact('salesDailySummary'));
        $this->set('_serialize', ['salesDailySummary']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Daily Summary id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesDailySummary = $this->SalesDailySummaries->get($id);
        if ($this->SalesDailySummaries->delete($salesDailySummary)) {
            $this->Flash->success(__('The sales daily summary has been deleted.'));
        } else {
            $this->Flash->error(__('The sales daily summary could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
