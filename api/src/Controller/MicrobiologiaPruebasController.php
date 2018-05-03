<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MicrobiologiaPruebas Controller
 *
 * @property \App\Model\Table\MicrobiologiaPruebasTable $MicrobiologiaPruebas
 *
 * @method \App\Model\Entity\MicrobiologiaPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MicrobiologiaPruebasController extends AppController
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
                $micro = $this->Microbiologia->find('all');
                $json = [
                    'error' => 0,
                    'message' => '',
                    'data' => $micro
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
     * @param string|null $id Microbiologia Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $microbiologiaPrueba = $this->MicrobiologiaPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('microbiologiaPrueba', $microbiologiaPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $microbiologiaPrueba = $this->MicrobiologiaPruebas->newEntity();
        if ($this->request->is('post')) {
            $microbiologiaPrueba = $this->MicrobiologiaPruebas->patchEntity($microbiologiaPrueba, $this->request->getData());
            if ($this->MicrobiologiaPruebas->save($microbiologiaPrueba)) {
                $this->Flash->success(__('The microbiologia prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The microbiologia prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->MicrobiologiaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('microbiologiaPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Microbiologia Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $microbiologiaPrueba = $this->MicrobiologiaPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $microbiologiaPrueba = $this->MicrobiologiaPruebas->patchEntity($microbiologiaPrueba, $this->request->getData());
            if ($this->MicrobiologiaPruebas->save($microbiologiaPrueba)) {
                $this->Flash->success(__('The microbiologia prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The microbiologia prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->MicrobiologiaPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('microbiologiaPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Microbiologia Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $microbiologiaPrueba = $this->MicrobiologiaPruebas->get($id);
        if ($this->MicrobiologiaPruebas->delete($microbiologiaPrueba)) {
            $this->Flash->success(__('The microbiologia prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The microbiologia prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
