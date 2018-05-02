<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExamenGeneralPruebas Controller
 *
 * @property \App\Model\Table\ExamenGeneralPruebasTable $ExamenGeneralPruebas
 *
 * @method \App\Model\Entity\ExamenGeneralPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExamenGeneralPruebasController extends AppController
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
        $examenGeneralPruebas = $this->paginate($this->ExamenGeneralPruebas);

        $this->set(compact('examenGeneralPruebas'));
    }

    /**
     * View method
     *
     * @param string|null $id Examen General Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $examenGeneralPrueba = $this->ExamenGeneralPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('examenGeneralPrueba', $examenGeneralPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $examenGeneralPrueba = $this->ExamenGeneralPruebas->newEntity();
        if ($this->request->is('post')) {
            $examenGeneralPrueba = $this->ExamenGeneralPruebas->patchEntity($examenGeneralPrueba, $this->request->getData());
            if ($this->ExamenGeneralPruebas->save($examenGeneralPrueba)) {
                $this->Flash->success(__('The examen general prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The examen general prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->ExamenGeneralPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('examenGeneralPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Examen General Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $examenGeneralPrueba = $this->ExamenGeneralPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $examenGeneralPrueba = $this->ExamenGeneralPruebas->patchEntity($examenGeneralPrueba, $this->request->getData());
            if ($this->ExamenGeneralPruebas->save($examenGeneralPrueba)) {
                $this->Flash->success(__('The examen general prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The examen general prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->ExamenGeneralPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('examenGeneralPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Examen General Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $examenGeneralPrueba = $this->ExamenGeneralPruebas->get($id);
        if ($this->ExamenGeneralPruebas->delete($examenGeneralPrueba)) {
            $this->Flash->success(__('The examen general prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The examen general prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
