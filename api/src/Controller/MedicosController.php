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
     * all method
     *
     * @return \Cake\Http\Response|void
     */
    public function all()
    {
        $this->autoRender = false;
        $nombre = $this->request->getQuery('nombre', null);
        $limit = $this->request->getQuery('rows', 20);
        $page = $this->request->getQuery('page', 1);
        $sord = $this->request->getQuery('sord', 'DESC');
        $sidx = $this->request->getQuery('sidx', 'created');

        $conditions = [];
        if ($nombre) {
            $conditions[] = "nombre LIKE " . ' \'%' .  trim($nombre) . '%\'';
        }

        $query = $this->Medicos->find('all')
            ->where($conditions);

        try {
            $rows = $this->paginate($query, [
                'limit' => $limit,
                'page' => $page,
                'order' => ['Medicos.' . $sidx => $sord]
            ]);
        } catch (\Exception $e) {
            $rows = [];
        }

        $total = $query->count();
        $res = [
            'total' => $query->count(),
            'pages' => (int) ($total / $limit) <= 1 ? 1 : round(($total / $limit)),
            'current_page' => $page,
            'limit' => $limit,
            'data' => $rows,
            'show_pag' => 10
        ];

        $body = $this->response->getBody();
        $body->write(json_encode($res));
        return $this->response
            ->withType("application/json")
            ->withBody($body);
    }

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
                $medico = $this->Medicos->newEntity();
                $medico = $this->Medicos->patchEntity($medico, $data);
                $saved = $this->Medicos->save($medico);
                if ($saved) {
                    $json = [
                        'error' => 0,
                        'save' => 1,
                        'message' => 'Médico registrado correctamente',
                        'data' => $saved->id
                    ];
                } else {
                    $json = [
                        'error' => 1,
                        'save' => 0,
                        'message' => 'El médico no pudo ser registrado'
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
     * @param string|null $id Medico id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $medico = $this->Medicos->get($id, [
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
                $medico = $this->Medicos->patchEntity($medico, $data);
                $saved = $this->Medicos->save($medico);
                if ($saved) {
                    $json = [
                        'error' => 0,
                        'save' => 1,
                        'message' => 'Médico editado correctamente',
                        'data' => $saved->id
                    ];
                } else {
                    $json = [
                        'error' => 1,
                        'save' => 0,
                        'message' => 'El médico no pudo ser editado'
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
     * @param string|null $id Medico id.
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

        if (!empty($user)) {
            $registry = $this->Medicos->get($id);
            if ($this->Medicos->delete($registry)) {
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
