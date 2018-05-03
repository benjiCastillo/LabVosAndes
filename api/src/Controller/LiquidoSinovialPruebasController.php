<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LiquidoSinovialPruebas Controller
 *
 * @property \App\Model\Table\LiquidoSinovialPruebasTable $LiquidoSinovialPruebas
 *
 * @method \App\Model\Entity\LiquidoSinovialPrueba[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LiquidoSinovialPruebasController extends AppController
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
                $liquido = $this->LiquidoSinovialPruebas->find('all');
                $json = [
                    'error' => 0,
                    'message' => '',
                    'data' => $liquido
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
     * @param string|null $id Liquido Sinovial Prueba id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $liquidoSinovialPrueba = $this->LiquidoSinovialPruebas->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('liquidoSinovialPrueba', $liquidoSinovialPrueba);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $liquidoSinovialPrueba = $this->LiquidoSinovialPruebas->newEntity();
        if ($this->request->is('post')) {
            $liquidoSinovialPrueba = $this->LiquidoSinovialPruebas->patchEntity($liquidoSinovialPrueba, $this->request->getData());
            if ($this->LiquidoSinovialPruebas->save($liquidoSinovialPrueba)) {
                $this->Flash->success(__('The liquido sinovial prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The liquido sinovial prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->LiquidoSinovialPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('liquidoSinovialPrueba', 'pruebas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Liquido Sinovial Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $liquidoSinovialPrueba = $this->LiquidoSinovialPruebas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $liquidoSinovialPrueba = $this->LiquidoSinovialPruebas->patchEntity($liquidoSinovialPrueba, $this->request->getData());
            if ($this->LiquidoSinovialPruebas->save($liquidoSinovialPrueba)) {
                $this->Flash->success(__('The liquido sinovial prueba has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The liquido sinovial prueba could not be saved. Please, try again.'));
        }
        $pruebas = $this->LiquidoSinovialPruebas->Pruebas->find('list', ['limit' => 200]);
        $this->set(compact('liquidoSinovialPrueba', 'pruebas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Liquido Sinovial Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $liquidoSinovialPrueba = $this->LiquidoSinovialPruebas->get($id);
        if ($this->LiquidoSinovialPruebas->delete($liquidoSinovialPrueba)) {
            $this->Flash->success(__('The liquido sinovial prueba has been deleted.'));
        } else {
            $this->Flash->error(__('The liquido sinovial prueba could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
