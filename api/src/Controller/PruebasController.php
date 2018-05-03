<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pruebas Controller
 *
 * @property \App\Model\Table\PruebasTable $Pruebas
 *
 * @method \App\Model\Entity\Prueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PruebasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Medicos', 'Pacientes']
        ];
        $pruebas = $this->paginate($this->Pruebas);

        $this->set(compact('pruebas'));
    }

    /**
     * View method
     *
     * @param string|null $id Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $prueba = $this->Pruebas->get($id, [
            'contain' => ['Medicos', 'Pacientes', 'BiometriaPruebas', 'CultivosPruebas', 'EspermogramaPruebas', 'ExamenGeneralPruebas', 'HormonasPruebas', 'InformePruebas', 'LiquidoSinovialPruebas', 'MicrobiologiaPruebas', 'ParasitologiaPruebas', 'QuimicaSanguineaPruebas', 'ReaccionWPruebas', 'SerologiaPruebas']
        ]);

        $this->set('prueba', $prueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $prueba = $this->Pruebas->newEntity();
        if ($this->request->is('post')) {
            $prueba = $this->Pruebas->patchEntity($prueba, $this->request->getData());
            if ($this->Pruebas->save($prueba)) {
                $this->Flash->success(__('The prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prueba could not be saved. Please, try again.'));
        }
        $medicos = $this->Pruebas->Medicos->find('list', ['limit' => 200]);
        $pacientes = $this->Pruebas->Pacientes->find('list', ['limit' => 200]);
        $this->set(compact('prueba', 'medicos', 'pacientes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $prueba = $this->Pruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prueba = $this->Pruebas->patchEntity($prueba, $this->request->getData());
            if ($this->Pruebas->save($prueba)) {
                $this->Flash->success(__('The prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prueba could not be saved. Please, try again.'));
        }
        $medicos = $this->Pruebas->Medicos->find('list', ['limit' => 200]);
        $pacientes = $this->Pruebas->Pacientes->find('list', ['limit' => 200]);
        $this->set(compact('prueba', 'medicos', 'pacientes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prueba = $this->Pruebas->get($id);
        if ($this->Pruebas->delete($prueba)) {
            $this->Flash->success(__('The prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
