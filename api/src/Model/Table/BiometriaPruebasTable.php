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
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
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

        $this->addBehavior('Timestamp');

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
            ->maxLength('hematies', 40)
            ->allowEmpty('hematies');

        $validator
            ->scalar('hematocrito')
            ->maxLength('hematocrito', 40)
            ->allowEmpty('hematocrito');

        $validator
            ->scalar('hemoglobina')
            ->maxLength('hemoglobina', 40)
            ->allowEmpty('hemoglobina');

        $validator
            ->scalar('leucocitos')
            ->maxLength('leucocitos', 40)
            ->allowEmpty('leucocitos');

        $validator
            ->scalar('vsg')
            ->maxLength('vsg', 40)
            ->allowEmpty('vsg');

        $validator
            ->scalar('vcm')
            ->maxLength('vcm', 40)
            ->allowEmpty('vcm');

        $validator
            ->scalar('hbcm')
            ->maxLength('hbcm', 40)
            ->allowEmpty('hbcm');

        $validator
            ->scalar('chbcm')
            ->maxLength('chbcm', 40)
            ->allowEmpty('chbcm');

        $validator
            ->scalar('comentario_hema')
            ->allowEmpty('comentario_hema');

        $validator
            ->scalar('cayados')
            ->maxLength('cayados', 40)
            ->allowEmpty('cayados');

        $validator
            ->scalar('neutrofilos')
            ->maxLength('neutrofilos', 40)
            ->allowEmpty('neutrofilos');

        $validator
            ->scalar('basofilo')
            ->maxLength('basofilo', 40)
            ->allowEmpty('basofilo');

        $validator
            ->scalar('eosinofilo')
            ->maxLength('eosinofilo', 40)
            ->allowEmpty('eosinofilo');

        $validator
            ->scalar('linfocito')
            ->maxLength('linfocito', 40)
            ->allowEmpty('linfocito');

        $validator
            ->scalar('monocito')
            ->maxLength('monocito', 40)
            ->allowEmpty('monocito');

        $validator
            ->scalar('prolinfocito')
            ->maxLength('prolinfocito', 40)
            ->allowEmpty('prolinfocito');

        $validator
            ->scalar('cel_inmaduras')
            ->maxLength('cel_inmaduras', 40)
            ->allowEmpty('cel_inmaduras');

        $validator
            ->scalar('comentario_leuco')
            ->allowEmpty('comentario_leuco');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

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
