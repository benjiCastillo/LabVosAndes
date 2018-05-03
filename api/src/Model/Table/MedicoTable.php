<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Medico Model
 *
 * @method \App\Model\Entity\Medico get($primaryKey, $options = [])
 * @method \App\Model\Entity\Medico newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Medico[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Medico|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Medico patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Medico[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Medico findOrCreate($search, callable $callback = null, $options = [])
 */
class MedicoTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('medico');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 55)
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->scalar('apellidos')
            ->maxLength('apellidos', 75)
            ->requirePresence('apellidos', 'create')
            ->notEmpty('apellidos');

        return $validator;
    }
}
