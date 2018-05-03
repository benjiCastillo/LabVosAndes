<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Medicos Controller
 *
 * @property \App\Model\Table\MedicosTable $Medicos
 *
 * @method \App\Model\Entity\Medico[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MedicosController extends AppController
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
                $medicos = $this->Medicos->find('all');
                $json = [
                    'error' => 0,
                    'message' => '',
                    'data' => $medicos
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
     * @param string|null $id Medico id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $medico = $this->Medicos->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('medico', $medico);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $medico = $this->Medicos->newEntity();
        if ($this->request->is('post')) {
            $medico = $this->Medicos->patchEntity($medico, $this->request->getData());
            if ($this->Medicos->save($medico)) {
                $this->Flash->success(__('The medico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The medico could not be saved. Please, try again.'));
        }
        $this->set(compact('medico'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Medico id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $medico = $this->Medicos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $medico = $this->Medicos->patchEntity($medico, $this->request->getData());
            if ($this->Medicos->save($medico)) {
                $this->Flash->success(__('The medico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The medico could not be saved. Please, try again.'));
        }
        $this->set(compact('medico'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Medico id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $medico = $this->Medicos->get($id);
        if ($this->Medicos->delete($medico)) {
            $this->Flash->success(__('The medico has been deleted.'));
        } else {
            $this->Flash->error(__('The medico could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
