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
                $cultivos = $this->CultivosPruebas->find('all');
                $json = [
                    'error' => 0,
                    'message' => '',
                    'data' => $cultivos
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
