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
            ->maxLength('paraA1', 15)
            ->requirePresence('paraA1', 'create')
            ->notEmpty('paraA1');

        $validator
            ->scalar('paraA2')
            ->maxLength('paraA2', 15)
            ->requirePresence('paraA2', 'create')
            ->notEmpty('paraA2');

        $validator
            ->scalar('paraA3')
            ->maxLength('paraA3', 15)
            ->requirePresence('paraA3', 'create')
            ->notEmpty('paraA3');

        $validator
            ->scalar('paraA4')
            ->maxLength('paraA4', 15)
            ->requirePresence('paraA4', 'create')
            ->notEmpty('paraA4');

        $validator
            ->scalar('paraA5')
            ->maxLength('paraA5', 15)
            ->requirePresence('paraA5', 'create')
            ->notEmpty('paraA5');

        $validator
            ->scalar('paraA6')
            ->maxLength('paraA6', 15)
            ->requirePresence('paraA6', 'create')
            ->notEmpty('paraA6');

        $validator
            ->scalar('paraB1')
            ->maxLength('paraB1', 15)
            ->requirePresence('paraB1', 'create')
            ->notEmpty('paraB1');

        $validator
            ->scalar('paraB2')
            ->maxLength('paraB2', 15)
            ->requirePresence('paraB2', 'create')
            ->notEmpty('paraB2');

        $validator
            ->scalar('paraB3')
            ->maxLength('paraB3', 15)
            ->requirePresence('paraB3', 'create')
            ->notEmpty('paraB3');

        $validator
            ->scalar('paraB4')
            ->maxLength('paraB4', 15)
            ->requirePresence('paraB4', 'create')
            ->notEmpty('paraB4');

        $validator
            ->scalar('paraB5')
            ->maxLength('paraB5', 15)
            ->requirePresence('paraB5', 'create')
            ->notEmpty('paraB5');

        $validator
            ->scalar('paraB6')
            ->maxLength('paraB6', 15)
            ->requirePresence('paraB6', 'create')
            ->notEmpty('paraB6');

        $validator
            ->scalar('somaticoO1')
            ->maxLength('somaticoO1', 15)
            ->requirePresence('somaticoO1', 'create')
            ->notEmpty('somaticoO1');

        $validator
            ->scalar('somaticoO2')
            ->maxLength('somaticoO2', 15)
            ->requirePresence('somaticoO2', 'create')
            ->notEmpty('somaticoO2');

        $validator
            ->scalar('somaticoO3')
            ->maxLength('somaticoO3', 15)
            ->requirePresence('somaticoO3', 'create')
            ->notEmpty('somaticoO3');

        $validator
            ->scalar('somaticoO4')
            ->maxLength('somaticoO4', 15)
            ->requirePresence('somaticoO4', 'create')
            ->notEmpty('somaticoO4');

        $validator
            ->scalar('somaticoO5')
            ->maxLength('somaticoO5', 15)
            ->requirePresence('somaticoO5', 'create')
            ->notEmpty('somaticoO5');

        $validator
            ->scalar('somaticoO6')
            ->maxLength('somaticoO6', 15)
            ->requirePresence('somaticoO6', 'create')
            ->notEmpty('somaticoO6');

        $validator
            ->scalar('flagelarH1')
            ->maxLength('flagelarH1', 15)
            ->requirePresence('flagelarH1', 'create')
            ->notEmpty('flagelarH1');

        $validator
            ->scalar('flagelarH2')
            ->maxLength('flagelarH2', 15)
            ->requirePresence('flagelarH2', 'create')
            ->notEmpty('flagelarH2');

        $validator
            ->scalar('flagelarH3')
            ->maxLength('flagelarH3', 15)
            ->requirePresence('flagelarH3', 'create')
            ->notEmpty('flagelarH3');

        $validator
            ->scalar('flagelarH4')
            ->maxLength('flagelarH4', 15)
            ->requirePresence('flagelarH4', 'create')
            ->notEmpty('flagelarH4');

        $validator
            ->scalar('flagelarH5')
            ->maxLength('flagelarH5', 15)
            ->requirePresence('flagelarH5', 'create')
            ->notEmpty('flagelarH5');

        $validator
            ->scalar('flagelarH6')
            ->maxLength('flagelarH6', 15)
            ->requirePresence('flagelarH6', 'create')
            ->notEmpty('flagelarH6');

        $validator
            ->scalar('comentario')
            ->requirePresence('comentario', 'create')
            ->notEmpty('comentario');

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
