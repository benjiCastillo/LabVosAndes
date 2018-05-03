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
     * List method
     *
     * @return \Cake\Http\Response|void
     */
    public function list()
    {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $this->loadModel('Usuarios');
            $count = $this->Usuarios->find('all', [
                'conditions' => [
                    'user' => $data['user'],
                    'token' => $data['token']
                ]
            ])->count();

            if ($count) {
                $informe = $this->InformePruebas->find('all');
                $json = [
                    'error' => 0,
                    'message' => '',
                    'data' => $informe
                ];
            } else {
                $json = [
                    'error' => 1,
                    'message' => 'Token incorrecto: El usuario ya accedió desde otra máquina.',
                ];
            }

            $body = $this->response->getBody();
            $body->write(json_encode($json));
            return $this->response->withBody($body);
        }
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
