<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReaccionWPruebas Model
 *
 * @property \App\Model\Table\PruebasTable|\Cake\ORM\Association\BelongsTo $Pruebas
 *
 * @method \App\Model\Entity\ReaccionWPrueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReaccionWPrueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReaccionWPrueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReaccionWPrueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReaccionWPrueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReaccionWPrueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReaccionWPrueba findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReaccionWPruebasTable extends Table
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

        $this->setTable('reaccion_w_pruebas');
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
            ->scalar('paraA1')
            ->maxLength('paraA1', 20)
            ->allowEmpty('paraA1');

        $validator
            ->scalar('paraA2')
            ->maxLength('paraA2', 20)
            ->allowEmpty('paraA2');

        $validator
            ->scalar('paraA3')
            ->maxLength('paraA3', 20)
            ->allowEmpty('paraA3');

        $validator
            ->scalar('paraA4')
            ->maxLength('paraA4', 20)
            ->allowEmpty('paraA4');

        $validator
            ->scalar('paraA5')
            ->maxLength('paraA5', 20)
            ->allowEmpty('paraA5');

        $validator
            ->scalar('paraA6')
            ->maxLength('paraA6', 20)
            ->allowEmpty('paraA6');

        $validator
            ->scalar('paraB1')
            ->maxLength('paraB1', 20)
            ->allowEmpty('paraB1');

        $validator
            ->scalar('paraB2')
            ->maxLength('paraB2', 20)
            ->allowEmpty('paraB2');

        $validator
            ->scalar('paraB3')
            ->maxLength('paraB3', 20)
            ->allowEmpty('paraB3');

        $validator
            ->scalar('paraB4')
            ->maxLength('paraB4', 20)
            ->allowEmpty('paraB4');

        $validator
            ->scalar('paraB5')
            ->maxLength('paraB5', 20)
            ->allowEmpty('paraB5');

        $validator
            ->scalar('paraB6')
            ->maxLength('paraB6', 20)
            ->allowEmpty('paraB6');

        $validator
            ->scalar('somaticoO1')
            ->maxLength('somaticoO1', 20)
            ->allowEmpty('somaticoO1');

        $validator
            ->scalar('somaticoO2')
            ->maxLength('somaticoO2', 20)
            ->allowEmpty('somaticoO2');

        $validator
            ->scalar('somaticoO3')
            ->maxLength('somaticoO3', 20)
            ->allowEmpty('somaticoO3');

        $validator
            ->scalar('somaticoO4')
            ->maxLength('somaticoO4', 20)
            ->allowEmpty('somaticoO4');

        $validator
            ->scalar('somaticoO5')
            ->maxLength('somaticoO5', 20)
            ->allowEmpty('somaticoO5');

        $validator
            ->scalar('somaticoO6')
            ->maxLength('somaticoO6', 20)
            ->allowEmpty('somaticoO6');

        $validator
            ->scalar('flagelarH1')
            ->maxLength('flagelarH1', 20)
            ->allowEmpty('flagelarH1');

        $validator
            ->scalar('flagelarH2')
            ->maxLength('flagelarH2', 20)
            ->allowEmpty('flagelarH2');

        $validator
            ->scalar('flagelarH3')
            ->maxLength('flagelarH3', 20)
            ->allowEmpty('flagelarH3');

        $validator
            ->scalar('flagelarH4')
            ->maxLength('flagelarH4', 20)
            ->allowEmpty('flagelarH4');

        $validator
            ->scalar('flagelarH5')
            ->maxLength('flagelarH5', 20)
            ->allowEmpty('flagelarH5');

        $validator
            ->scalar('flagelarH6')
            ->maxLength('flagelarH6', 20)
            ->allowEmpty('flagelarH6');

        $validator
            ->scalar('comentario')
            ->allowEmpty('comentario');

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
