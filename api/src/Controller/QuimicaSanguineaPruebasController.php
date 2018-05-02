<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * QuimicaSanguineaPruebas Controller
 *
 * @property \App\Model\Table\QuimicaSanguineaPruebasTable $QuimicaSanguineaPruebas
 *
 * @method \App\Model\Entity\QuimicaSanguineaPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuimicaSanguineaPruebasController extends AppController
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
        $quimicaSanguineaPruebas = $this->paginate($this->QuimicaSanguineaPruebas);

        $this->set(compact('quimicaSanguineaPruebas'));
    }

    /**
     * View method
     *
     * @param string|null $id Quimica Sanguinea Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $quimicaSanguineaPrueba = $this->QuimicaSanguineaPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('quimicaSanguineaPrueba', $quimicaSanguineaPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $quimicaSanguineaPrueba = $this->QuimicaSanguineaPruebas->newEntity();
        if ($this->request->is('post')) {
            $quimicaSanguineaPrueba = $this->QuimicaSanguineaPruebas->patchEntity($quimicaSanguineaPrueba, $this->request->getData());
            if ($this->QuimicaSanguineaPruebas->save($quimicaSanguineaPrueba)) {
                $this->Flash->success(__('The quimica sanguinea prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The quimica sanguinea prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->QuimicaSanguineaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('quimicaSanguineaPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Quimica Sanguinea Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $quimicaSanguineaPrueba = $this->QuimicaSanguineaPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $quimicaSanguineaPrueba = $this->QuimicaSanguineaPruebas->patchEntity($quimicaSanguineaPrueba, $this->request->getData());
            if ($this->QuimicaSanguineaPruebas->save($quimicaSanguineaPrueba)) {
                $this->Flash->success(__('The quimica sanguinea prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The quimica sanguinea prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->QuimicaSanguineaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('quimicaSanguineaPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Quimica Sanguinea Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $quimicaSanguineaPrueba = $this->QuimicaSanguineaPruebas->get($id);
        if ($this->QuimicaSanguineaPruebas->delete($quimicaSanguineaPrueba)) {
            $this->Flash->success(__('The quimica sanguinea prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The quimica sanguinea prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
