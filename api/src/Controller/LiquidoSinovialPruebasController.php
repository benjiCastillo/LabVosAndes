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
                $liquido = $this->LiquidoSinovialPruebas->find('all', [
                    'conditions' => [
                        'prueba_id' => $data['prueba_id']
                    ]
                ])->first();
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
                $liquido_sin = $this->LiquidoSinovialPruebas->newEntity();
                $liquido_sin = $this->LiquidoSinovialPruebas->patchEntity($liquido_sin, $data);
                $saved = $this->LiquidoSinovialPruebas->save($liquido_sin);
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
     * @param string|null $id Liquido Sinovial Prueba id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $liquido = $this->LiquidoSinovialPruebas->get($id, [
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
                $liquido = $this->LiquidoSinovialPruebas->newEntity();
                $liquido = $this->LiquidoSinovialPruebas->patchEntity($liquido, $data);
                $saved = $this->LiquidoSinovialPruebas->save($liquido);
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
     * @param string|null $id Liquido Sinovial Prueba id.
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
            $registry = $this->LiquidoSinovialPruebas->get($id);
            if ($this->LiquidiSinovialPruebas->delete($registry)) {
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
}
