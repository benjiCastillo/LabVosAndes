<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ParasitologiaPruebas Controller
 *
 * @property \App\Model\Table\ParasitologiaPruebasTable $ParasitologiaPruebas
 *
 * @method \App\Model\Entity\ParasitologiaPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ParasitologiaPruebasController extends AppController
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
        $parasitologiaPruebas = $this->paginate($this->ParasitologiaPruebas);

        $this->set(compact('parasitologiaPruebas'));
    }

    /**
     * View method
     *
     * @param string|null $id Parasitologia Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parasitologiaPrueba = $this->ParasitologiaPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('parasitologiaPrueba', $parasitologiaPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parasitologiaPrueba = $this->ParasitologiaPruebas->newEntity();
        if ($this->request->is('post')) {
            $parasitologiaPrueba = $this->ParasitologiaPruebas->patchEntity($parasitologiaPrueba, $this->request->getData());
            if ($this->ParasitologiaPruebas->save($parasitologiaPrueba)) {
                $this->Flash->success(__('The parasitologia prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The parasitologia prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->ParasitologiaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('parasitologiaPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Parasitologia Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parasitologiaPrueba = $this->ParasitologiaPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parasitologiaPrueba = $this->ParasitologiaPruebas->patchEntity($parasitologiaPrueba, $this->request->getData());
            if ($this->ParasitologiaPruebas->save($parasitologiaPrueba)) {
                $this->Flash->success(__('The parasitologia prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The parasitologia prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->ParasitologiaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('parasitologiaPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Parasitologia Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parasitologiaPrueba = $this->ParasitologiaPruebas->get($id);
        if ($this->ParasitologiaPruebas->delete($parasitologiaPrueba)) {
            $this->Flash->success(__('The parasitologia prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The parasitologia prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
