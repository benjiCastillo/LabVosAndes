<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BiometriaPruebas Model
 *
 * @property \App\Model\Table\PruebasTable|\Cake\ORM\Association\BelongsTo $Pruebas
 *
 * @method \App\Model\Entity\BiometriaPrueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\BiometriaPrueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BiometriaPrueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BiometriaPrueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BiometriaPrueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BiometriaPrueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BiometriaPrueba findOrCreate($search, callable $callback = null, $options = [])
 */
class BiometriaPruebasTable extends Table
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

        $this->setTable('biometria_pruebas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Pruebas', [
            'foreignKey' => 'prueba_id',
            'joinType' => 'INNER'
        ]);
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
            ->scalar('hematies')
            ->maxLength('hematies', 15)
            ->requirePresence('hematies', 'create')
            ->notEmpty('hematies');

        $validator
            ->scalar('hematocrito')
            ->maxLength('hematocrito', 15)
            ->requirePresence('hematocrito', 'create')
            ->notEmpty('hematocrito');

        $validator
            ->scalar('hemoglobina')
            ->maxLength('hemoglobina', 15)
            ->requirePresence('hemoglobina', 'create')
            ->notEmpty('hemoglobina');

        $validator
            ->scalar('leucocitos')
            ->maxLength('leucocitos', 15)
            ->requirePresence('leucocitos', 'create')
            ->notEmpty('leucocitos');

        $validator
            ->scalar('vsg')
            ->maxLength('vsg', 15)
            ->requirePresence('vsg', 'create')
            ->notEmpty('vsg');

        $validator
            ->scalar('vcm')
            ->maxLength('vcm', 15)
            ->requirePresence('vcm', 'create')
            ->notEmpty('vcm');

        $validator
            ->scalar('hbcm')
            ->maxLength('hbcm', 15)
            ->requirePresence('hbcm', 'create')
            ->notEmpty('hbcm');

        $validator
            ->scalar('chbcm')
            ->maxLength('chbcm', 15)
            ->requirePresence('chbcm', 'create')
            ->notEmpty('chbcm');

        $validator
            ->scalar('comentario_hema')
            ->requirePresence('comentario_hema', 'create')
            ->notEmpty('comentario_hema');

        $validator
            ->scalar('cayados')
            ->maxLength('cayados', 15)
            ->requirePresence('cayados', 'create')
            ->notEmpty('cayados');

        $validator
            ->scalar('neutrofilos')
            ->maxLength('neutrofilos', 15)
            ->requirePresence('neutrofilos', 'create')
            ->notEmpty('neutrofilos');

        $validator
            ->scalar('basofilo')
            ->maxLength('basofilo', 15)
            ->requirePresence('basofilo', 'create')
            ->notEmpty('basofilo');

        $validator
            ->scalar('eosinofilo')
            ->maxLength('eosinofilo', 15)
            ->requirePresence('eosinofilo', 'create')
            ->notEmpty('eosinofilo');

        $validator
            ->scalar('linfocito')
            ->maxLength('linfocito', 15)
            ->requirePresence('linfocito', 'create')
            ->notEmpty('linfocito');

        $validator
            ->scalar('monocito')
            ->maxLength('monocito', 15)
            ->requirePresence('monocito', 'create')
            ->notEmpty('monocito');

        $validator
            ->scalar('prolinfocito')
            ->maxLength('prolinfocito', 15)
            ->requirePresence('prolinfocito', 'create')
            ->notEmpty('prolinfocito');

        $validator
            ->scalar('cel_inmaduras')
            ->maxLength('cel_inmaduras', 15)
            ->requirePresence('cel_inmaduras', 'create')
            ->notEmpty('cel_inmaduras');

        $validator
            ->scalar('comentario_leuco')
            ->requirePresence('comentario_leuco', 'create')
            ->notEmpty('comentario_leuco');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['prueba_id'], 'Pruebas'));

        return $rules;
    }
}
