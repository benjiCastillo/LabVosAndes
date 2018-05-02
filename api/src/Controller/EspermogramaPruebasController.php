<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EspermogramaPruebas Controller
 *
 * @property \App\Model\Table\EspermogramaPruebasTable $EspermogramaPruebas
 *
 * @method \App\Model\Entity\EspermogramaPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EspermogramaPruebasController extends AppController
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
        $espermogramaPruebas = $this->paginate($this->EspermogramaPruebas);

        $this->set(compact('espermogramaPruebas'));
    }

    /**
     * View method
     *
     * @param string|null $id Espermograma Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $espermogramaPrueba = $this->EspermogramaPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('espermogramaPrueba', $espermogramaPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $espermogramaPrueba = $this->EspermogramaPruebas->newEntity();
        if ($this->request->is('post')) {
            $espermogramaPrueba = $this->EspermogramaPruebas->patchEntity($espermogramaPrueba, $this->request->getData());
            if ($this->EspermogramaPruebas->save($espermogramaPrueba)) {
                $this->Flash->success(__('The espermograma prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The espermograma prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->EspermogramaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('espermogramaPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Espermograma Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $espermogramaPrueba = $this->EspermogramaPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $espermogramaPrueba = $this->EspermogramaPruebas->patchEntity($espermogramaPrueba, $this->request->getData());
            if ($this->EspermogramaPruebas->save($espermogramaPrueba)) {
                $this->Flash->success(__('The espermograma prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The espermograma prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->EspermogramaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('espermogramaPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Espermograma Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $espermogramaPrueba = $this->EspermogramaPruebas->get($id);
        if ($this->EspermogramaPruebas->delete($espermogramaPrueba)) {
            $this->Flash->success(__('The espermograma prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The espermograma prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
