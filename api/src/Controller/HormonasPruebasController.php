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
                $hormonas = $this->HormonasPruebas->find('all', [
                    'conditions' => [
                        'prueba_id' => $data['prueba_id']
                    ]
                ])->first();
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
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');
        $json = [];
        if ($this->request->is('post')) {
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
                $data['created_by'] = $user->id;
                $hormonas = $this->HormonasPruebas->newEntity();
                $hormonas = $this->HormonasPruebas->patchEntity($hormonas, $data);
                $saved = $this->HormonasPruebas->save($hormonas);
                if ($saved) {
                    $json = [
                        'error' => 0,
                        'save' => 1,
                        'message' => 'Prueba registrada correctamente',
                        'data' => $saved->id
                    ];
                } else {
                    $json = [
                        'error' => 1,
                        'save' => 0,
                        'message' => 'La prueba no pudo ser registrada'
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
     * @param string|null $id Hormonas Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hormonas = $this->HormonasPruebas->get($id, [
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
                $hormonas = $this->HormonasPruebas->patchEntity($hormonas, $data);
                $saved = $this->HormonasPruebas->save($hormonas);
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
     * @param string|null $id Hormonas Prueba id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json');
        $this->request->allowMethod(['post', 'delete']);
        $json = [];

        $data = $this->request->getData();

        $this->loadModel('Usuarios');
        $user = $this->Usuarios->find('all', [
            'fields' => ['id'],
            'conditions' => [
                'user' => $data['user'],
                'token' => $data['token']
            ]
        ])->first();

        if(!empty($user)) {
            $registry = $this->HormonasPruebas->get($id);
            if ($this->HormonasPruebas->delete($registry)) {
                $json = [
                    'error' => 0,
                    'message' => 'El registro se eliminó correctamente'
                ];
            } else {
                $json = [
                    'error' => 1,
                    'message' => 'El registro no pudo eliminarse correctamente'
                ];
            }

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

    public function printHormonasPruebas($id = null) {
        $this->loadModel('Pruebas');
        $prueba = $this->Pruebas->find()
                        ->contain(['Pacientes', 'Medicos', 'HormonasPruebas'])
                        ->where(['Pruebas.id' => $id])
                        ->first();
        // debug($prueba);
        $this->viewBuilder()->setLayout('ajax');
        $this->response = $this->response->withType('pdf');
        $this->set('prueba', $prueba);
        $this->render('/Reports/hormonas');
    }
}
