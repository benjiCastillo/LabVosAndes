<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InformePruebas Controller
 *
 * @property \App\Model\Table\InformePruebasTable $InformePruebas
 *
 * @method \App\Model\Entity\InformePrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InformePruebasController extends AppController
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
        $informePruebas = $this->paginate($this->InformePruebas);

        $this->set(compact('informePruebas'));
    }

    /**
     * View method
     *
     * @param string|null $id Informe Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $informePrueba = $this->InformePruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('informePrueba', $informePrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $informePrueba = $this->InformePruebas->newEntity();
        if ($this->request->is('post')) {
            $informePrueba = $this->InformePruebas->patchEntity($informePrueba, $this->request->getData());
            if ($this->InformePruebas->save($informePrueba)) {
                $this->Flash->success(__('The informe prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The informe prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->InformePruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('informePrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Informe Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $informePrueba = $this->InformePruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $informePrueba = $this->InformePruebas->patchEntity($informePrueba, $this->request->getData());
            if ($this->InformePruebas->save($informePrueba)) {
                $this->Flash->success(__('The informe prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The informe prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->InformePruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('informePrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Informe Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $informePrueba = $this->InformePruebas->get($id);
        if ($this->InformePruebas->delete($informePrueba)) {
            $this->Flash->success(__('The informe prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The informe prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
