<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ReaccionWPruebas Controller
 *
 * @property \App\Model\Table\ReaccionWPruebasTable $ReaccionWPruebas
 *
 * @method \App\Model\Entity\ReaccionWPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReaccionWPruebasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Pruebas']
        ];
        $reaccionWPruebas = $this->paginate($this->ReaccionWPruebas);

        $this->set(compact('reaccionWPruebas'));
    }

    /**
     * View method
     *
     * @param string|null $id Reaccion W Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reaccionWPrueba = $this->ReaccionWPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('reaccionWPrueba', $reaccionWPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reaccionWPrueba = $this->ReaccionWPruebas->newEntity();
        if ($this->request->is('post')) {
            $reaccionWPrueba = $this->ReaccionWPruebas->patchEntity($reaccionWPrueba, $this->request->getData());
            if ($this->ReaccionWPruebas->save($reaccionWPrueba)) {
                $this->Flash->success(__('The reaccion w prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reaccion w prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->ReaccionWPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('reaccionWPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reaccion W Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reaccionWPrueba = $this->ReaccionWPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reaccionWPrueba = $this->ReaccionWPruebas->patchEntity($reaccionWPrueba, $this->request->getData());
            if ($this->ReaccionWPruebas->save($reaccionWPrueba)) {
                $this->Flash->success(__('The reaccion w prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reaccion w prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->ReaccionWPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('reaccionWPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reaccion W Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reaccionWPrueba = $this->ReaccionWPruebas->get($id);
        if ($this->ReaccionWPruebas->delete($reaccionWPrueba)) {
            $this->Flash->success(__('The reaccion w prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The reaccion w prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
