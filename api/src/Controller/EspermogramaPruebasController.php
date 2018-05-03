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
                $espermo = $this->EspermogramaPruebas->find('all');
                $json = [
                    'error' => 0,
                    'message' => '',
                    'data' => $espermo
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
