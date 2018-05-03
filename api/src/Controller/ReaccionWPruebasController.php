<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ReaccionWPruebas Controller
 *
 * @property \App\Model\Table\ReaccionWPruebasTable $ReaccionWPruebas
 *
 * @method \App\Model\Entity\ReaccionWPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReaccionWPruebasController extends AppController
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
                $reaccion = $this->ReaccionWPruebas->find('all');
                $json = [
                    'error' => 0,
                    'message' => '',
                    'data' => $reaccion
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
     * @param string|null $id Reaccion W Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reaccionWPrueba = $this->ReaccionWPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('reaccionWPrueba', $reaccionWPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reaccionWPrueba = $this->ReaccionWPruebas->newEntity();
        if ($this->request->is('post')) {
            $reaccionWPrueba = $this->ReaccionWPruebas->patchEntity($reaccionWPrueba, $this->request->getData());
            if ($this->ReaccionWPruebas->save($reaccionWPrueba)) {
                $this->Flash->success(__('The reaccion w prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reaccion w prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->ReaccionWPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('reaccionWPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reaccion W Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reaccionWPrueba = $this->ReaccionWPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reaccionWPrueba = $this->ReaccionWPruebas->patchEntity($reaccionWPrueba, $this->request->getData());
            if ($this->ReaccionWPruebas->save($reaccionWPrueba)) {
                $this->Flash->success(__('The reaccion w prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reaccion w prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->ReaccionWPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('reaccionWPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reaccion W Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reaccionWPrueba = $this->ReaccionWPruebas->get($id);
        if ($this->ReaccionWPruebas->delete($reaccionWPrueba)) {
            $this->Flash->success(__('The reaccion w prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The reaccion w prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
