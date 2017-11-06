<?php
namespace App\Controller\Sales;

use App\Controller\AppController;

/**
 * SalesItemTransactions Controller
 *
 * @property \App\Model\Table\SalesItemTransactionsTable $SalesItemTransactions
 *
 * @method \App\Model\Entity\SalesItemTransaction[] paginate($object = null, array $settings = [])
 */
class SalesItemTransactionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['SalesTransactions', 'SalesItems']
        ];
        $salesItemTransactions = $this->paginate($this->SalesItemTransactions);

        $this->set(compact('salesItemTransactions'));
        $this->set('_serialize', ['salesItemTransactions']);
    }

    /**
     * View method
     *
     * @param string|null $id Sales Item Transaction id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesItemTransaction = $this->SalesItemTransactions->get($id, [
            'contain' => ['SalesTransactions', 'SalesItems']
        ]);

        $this->set('salesItemTransaction', $salesItemTransaction);
        $this->set('_serialize', ['salesItemTransaction']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesItemTransaction = $this->SalesItemTransactions->newEntity();
        if ($this->request->is('post')) {
            $salesItemTransaction = $this->SalesItemTransactions->patchEntity($salesItemTransaction, $this->request->getData());
            if ($this->SalesItemTransactions->save($salesItemTransaction)) {
                $this->Flash->success(__('The sales item transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales item transaction could not be saved. Please, try again.'));
        }
        $salesTransactions = $this->SalesItemTransactions->SalesTransactions->find('list', ['limit' => 200]);
        $salesItems = $this->SalesItemTransactions->SalesItems->find('list', ['limit' => 200]);
        $this->set(compact('salesItemTransaction', 'salesTransactions', 'salesItems'));
        $this->set('_serialize', ['salesItemTransaction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Item Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesItemTransaction = $this->SalesItemTransactions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesItemTransaction = $this->SalesItemTransactions->patchEntity($salesItemTransaction, $this->request->getData());
            if ($this->SalesItemTransactions->save($salesItemTransaction)) {
                $this->Flash->success(__('The sales item transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales item transaction could not be saved. Please, try again.'));
        }
        $salesTransactions = $this->SalesItemTransactions->SalesTransactions->find('list', ['limit' => 200]);
        $salesItems = $this->SalesItemTransactions->SalesItems->find('list', ['limit' => 200]);
        $this->set(compact('salesItemTransaction', 'salesTransactions', 'salesItems'));
        $this->set('_serialize', ['salesItemTransaction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Item Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesItemTransaction = $this->SalesItemTransactions->get($id);
        if ($this->SalesItemTransactions->delete($salesItemTransaction)) {
            $this->Flash->success(__('The sales item transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The sales item transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
