<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SerologiaPruebas Controller
 *
 * @property \App\Model\Table\SerologiaPruebasTable $SerologiaPruebas
 *
 * @method \App\Model\Entity\SerologiaPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SerologiaPruebasController extends AppController
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
        $serologiaPruebas = $this->paginate($this->SerologiaPruebas);

        $this->set(compact('serologiaPruebas'));
    }

    /**
     * View method
     *
     * @param string|null $id Serologia Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $serologiaPrueba = $this->SerologiaPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('serologiaPrueba', $serologiaPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $serologiaPrueba = $this->SerologiaPruebas->newEntity();
        if ($this->request->is('post')) {
            $serologiaPrueba = $this->SerologiaPruebas->patchEntity($serologiaPrueba, $this->request->getData());
            if ($this->SerologiaPruebas->save($serologiaPrueba)) {
                $this->Flash->success(__('The serologia prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The serologia prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->SerologiaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('serologiaPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Serologia Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $serologiaPrueba = $this->SerologiaPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $serologiaPrueba = $this->SerologiaPruebas->patchEntity($serologiaPrueba, $this->request->getData());
            if ($this->SerologiaPruebas->save($serologiaPrueba)) {
                $this->Flash->success(__('The serologia prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The serologia prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->SerologiaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('serologiaPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Serologia Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $serologiaPrueba = $this->SerologiaPruebas->get($id);
        if ($this->SerologiaPruebas->delete($serologiaPrueba)) {
            $this->Flash->success(__('The serologia prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The serologia prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
