<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CultivosPruebas Controller
 *
 * @property \App\Model\Table\CultivosPruebasTable $CultivosPruebas
 *
 * @method \App\Model\Entity\CultivosPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CultivosPruebasController extends AppController
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
        $cultivosPruebas = $this->paginate($this->CultivosPruebas);

        $this->set(compact('cultivosPruebas'));
    }

    /**
     * View method
     *
     * @param string|null $id Cultivos Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cultivosPrueba = $this->CultivosPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('cultivosPrueba', $cultivosPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cultivosPrueba = $this->CultivosPruebas->newEntity();
        if ($this->request->is('post')) {
            $cultivosPrueba = $this->CultivosPruebas->patchEntity($cultivosPrueba, $this->request->getData());
            if ($this->CultivosPruebas->save($cultivosPrueba)) {
                $this->Flash->success(__('The cultivos prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cultivos prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->CultivosPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('cultivosPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cultivos Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cultivosPrueba = $this->CultivosPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cultivosPrueba = $this->CultivosPruebas->patchEntity($cultivosPrueba, $this->request->getData());
            if ($this->CultivosPruebas->save($cultivosPrueba)) {
                $this->Flash->success(__('The cultivos prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cultivos prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->CultivosPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('cultivosPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cultivos Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cultivosPrueba = $this->CultivosPruebas->get($id);
        if ($this->CultivosPruebas->delete($cultivosPrueba)) {
            $this->Flash->success(__('The cultivos prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The cultivos prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
