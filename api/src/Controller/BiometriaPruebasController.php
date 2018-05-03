<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BiometriaPruebas Controller
 *
 * @property \App\Model\Table\BiometriaPruebasTable $BiometriaPruebas
 *
 * @method \App\Model\Entity\BiometriaPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BiometriaPruebasController extends AppController
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
        $biometriaPruebas = $this->paginate($this->BiometriaPruebas);

        $this->set(compact('biometriaPruebas'));
    }

    /**
     * View method
     *
     * @param string|null $id Biometria Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $biometriaPrueba = $this->BiometriaPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('biometriaPrueba', $biometriaPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $biometriaPrueba = $this->BiometriaPruebas->newEntity();
        if ($this->request->is('post')) {
            $biometriaPrueba = $this->BiometriaPruebas->patchEntity($biometriaPrueba, $this->request->getData());
            if ($this->BiometriaPruebas->save($biometriaPrueba)) {
                $this->Flash->success(__('The biometria prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The biometria prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->BiometriaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('biometriaPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Biometria Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $biometriaPrueba = $this->BiometriaPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $biometriaPrueba = $this->BiometriaPruebas->patchEntity($biometriaPrueba, $this->request->getData());
            if ($this->BiometriaPruebas->save($biometriaPrueba)) {
                $this->Flash->success(__('The biometria prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The biometria prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->BiometriaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('biometriaPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Biometria Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $biometriaPrueba = $this->BiometriaPruebas->get($id);
        if ($this->BiometriaPruebas->delete($biometriaPrueba)) {
            $this->Flash->success(__('The biometria prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The biometria prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
