<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pacientes Controller
 *
 * @property \App\Model\Table\PacientesTable $Pacientes
 *
 * @method \App\Model\Entity\Paciente[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PacientesController extends AppController
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
                $pacientes = $this->Pacientes->find('all');
                $json = [
                    'error' => 0,
                    'message' => '',
                    'data' => $pacientes
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
     * @param string|null $id Paciente id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paciente = $this->Pacientes->get($id, [
            'contain' => ['Pruebas']
        ]);

        $this->set('paciente', $paciente);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');
        $json = [];
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $this->loadModel('Usuarios');
            $user = $this->Usuarios->find('all', [
                // 'fields' => ['id'],
                'conditions' => [
                    'user' => $data['user'],
                    'token' => $data['token']
                ]
            ])->first();

            if (!empty($user)) {
                $data['created_by'] = $user->id;
                $paciente = $this->Pacientes->newEntity();
                $paciente = $this->Pacientes->patchEntity($paciente, $data);
                $saved = $this->Pacientes->save($paciente);
                if ($saved) {
                    $json = [
                        'error' => 0,
                        'save' => 1,
                        'message' => 'Paciente registrado correctamente',
                        'data' => $saved->id
                    ];
                } else {
                    $json = [
                        'error' => 1,
                        'save' => 0,
                        'message' => 'El paciente no pudo ser registrado'
                    ];
                }
            } else {
                $json = [
                    'error' => 1,
                    'message' => 'Token incorrecto: El usuario ya accedió desde otro dispositivo.',
                ];
            }
        }
        $body = $this->response->getBody();
        $body->write(json_encode($json));
        return $this->response->withBody($body);
    }

    /**
     * Edit method
     *
     * @param string|null $id Paciente id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paciente = $this->Pacientes->get($id, [
            'contain' => []
        ]);
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');
        $json = [];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $this->loadModel('Usuarios');
            $user = $this->Usuarios->find('all', [
                'fields' => ['id'],
                'conditions' => [
                    'user' => $data['user'],
                    'token' => $data['token']
                ]
            ])->first();
            if (!empty($user)) {
                $data['modified_by'] = $user->id;
                $paciente = $this->Pacientes->patchEntity($paciente, $data);
                $saved = $this->Pacientes->save($paciente);
                if ($saved) {
                    $json = [
                        'error' => 0,
                        'save' => 1,
                        'message' => 'Prueba editada correctamente',
                        'data' => $saved->id
                    ];
                } else {
                    $json = [
                        'error' => 1,
                        'save' => 0,
                        'message' => 'La prueba no pudo ser editada'
                    ];
                }
            } else {
                $json = [
                    'error' => 1,
                    'message' => 'Token incorrecto: El usuario ya accedió desde otro dispositivo.',
                ];
            }
        }
        $body = $this->response->getBody();
        $body->write(json_encode($json));
        return $this->response->withBody($body);
    }

    /**
     * Delete method
     *
     * @param string|null $id Paciente id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paciente = $this->Pacientes->get($id);
        if ($this->Pacientes->delete($paciente)) {
            $this->Flash->success(__('The paciente has been deleted.'));
        } else {
            $this->Flash->error(__('The paciente could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
