<?php
namespace App\Controller\Sales;

use App\Controller\AppController;

/**
 * SalesItems Controller
 *
 * @property \App\Model\Table\SalesItemsTable $SalesItems
 *
 * @method \App\Model\Entity\SalesItem[] paginate($object = null, array $settings = [])
 */
class SalesItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $salesItems = $this->paginate($this->SalesItems);

        $this->set(compact('salesItems'));
        $this->set('_serialize', ['salesItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Sales Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesItem = $this->SalesItems->get($id, [
            'contain' => ['SalesItemAssignHistories', 'SalesItemHistories', 'SalesItemTransactions']
        ]);

        $this->set('salesItem', $salesItem);
        $this->set('_serialize', ['salesItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesItem = $this->SalesItems->newEntity();
        if ($this->request->is('post')) {
            $salesItem = $this->SalesItems->patchEntity($salesItem, $this->request->getData());
            if ($this->SalesItems->save($salesItem)) {
                $this->Flash->success(__('The sales item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales item could not be saved. Please, try again.'));
        }
        $this->set(compact('salesItem'));
        $this->set('_serialize', ['salesItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesItem = $this->SalesItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesItem = $this->SalesItems->patchEntity($salesItem, $this->request->getData());
            if ($this->SalesItems->save($salesItem)) {
                $this->Flash->success(__('The sales item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales item could not be saved. Please, try again.'));
        }
        $this->set(compact('salesItem'));
        $this->set('_serialize', ['salesItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesItem = $this->SalesItems->get($id);
        if ($this->SalesItems->delete($salesItem)) {
            $this->Flash->success(__('The sales item has been deleted.'));
        } else {
            $this->Flash->error(__('The sales item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
