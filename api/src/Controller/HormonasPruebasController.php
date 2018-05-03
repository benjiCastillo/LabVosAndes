<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HormonasPruebas Controller
 *
 * @property \App\Model\Table\HormonasPruebasTable $HormonasPruebas
 *
 * @method \App\Model\Entity\HormonasPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HormonasPruebasController extends AppController
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
                $hormonas = $this->HormonasPruebas->find('all');
                $json = [
                    'error' => 0,
                    'message' => '',
                    'data' => $hormonas
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
     * @param string|null $id Hormonas Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hormonasPrueba = $this->HormonasPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('hormonasPrueba', $hormonasPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hormonasPrueba = $this->HormonasPruebas->newEntity();
        if ($this->request->is('post')) {
            $hormonasPrueba = $this->HormonasPruebas->patchEntity($hormonasPrueba, $this->request->getData());
            if ($this->HormonasPruebas->save($hormonasPrueba)) {
                $this->Flash->success(__('The hormonas prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hormonas prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->HormonasPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('hormonasPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hormonas Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hormonasPrueba = $this->HormonasPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hormonasPrueba = $this->HormonasPruebas->patchEntity($hormonasPrueba, $this->request->getData());
            if ($this->HormonasPruebas->save($hormonasPrueba)) {
                $this->Flash->success(__('The hormonas prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hormonas prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->HormonasPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('hormonasPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Hormonas Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hormonasPrueba = $this->HormonasPruebas->get($id);
        if ($this->HormonasPruebas->delete($hormonasPrueba)) {
            $this->Flash->success(__('The hormonas prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The hormonas prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
