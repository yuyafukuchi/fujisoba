<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PermitPcs Controller
 *
 * @property \App\Model\Table\PermitPcsTable $PermitPcs
 */
class PermitPcsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $permitPcs = $this->paginate($this->PermitPcs);

        $this->set(compact('permitPcs'));
        $this->set('_serialize', ['permitPcs']);
    }

    /**
     * View method
     *
     * @param string|null $id Permit Pc id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $permitPc = $this->PermitPcs->get($id, [
            'contain' => []
        ]);

        $this->set('permitPc', $permitPc);
        $this->set('_serialize', ['permitPc']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $permitPc = $this->PermitPcs->newEntity();
        if ($this->request->is('post')) {
            $permitPc = $this->PermitPcs->patchEntity($permitPc, $this->request->data);
            if ($this->PermitPcs->save($permitPc)) {
                $this->Flash->success(__('The permit pc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The permit pc could not be saved. Please, try again.'));
        }
        $this->set(compact('permitPc'));
        $this->set('_serialize', ['permitPc']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Permit Pc id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $permitPc = $this->PermitPcs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $permitPc = $this->PermitPcs->patchEntity($permitPc, $this->request->data);
            if ($this->PermitPcs->save($permitPc)) {
                $this->Flash->success(__('The permit pc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The permit pc could not be saved. Please, try again.'));
        }
        $this->set(compact('permitPc'));
        $this->set('_serialize', ['permitPc']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Permit Pc id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $permitPc = $this->PermitPcs->get($id);
        if ($this->PermitPcs->delete($permitPc)) {
            $this->Flash->success(__('The permit pc has been deleted.'));
        } else {
            $this->Flash->error(__('The permit pc could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
