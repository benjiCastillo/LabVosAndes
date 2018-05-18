<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * QuimicaSanguineaPruebas Model
 *
 * @property \App\Model\Table\PruebasTable|\Cake\ORM\Association\BelongsTo $Pruebas
 *
 * @method \App\Model\Entity\QuimicaSanguineaPrueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\QuimicaSanguineaPrueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\QuimicaSanguineaPrueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\QuimicaSanguineaPrueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\QuimicaSanguineaPrueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\QuimicaSanguineaPrueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\QuimicaSanguineaPrueba findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuimicaSanguineaPruebasTable extends Table
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

        $this->setTable('quimica_sanguinea_pruebas');
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
            ->scalar('glucemia')
            ->maxLength('glucemia', 20)
            ->allowEmpty('glucemia');

        $validator
            ->scalar('urea')
            ->maxLength('urea', 20)
            ->allowEmpty('urea');

        $validator
            ->scalar('creatinina')
            ->maxLength('creatinina', 20)
            ->allowEmpty('creatinina');

        $validator
            ->scalar('acido_urico')
            ->maxLength('acido_urico', 20)
            ->allowEmpty('acido_urico');

        $validator
            ->scalar('colesterol_total')
            ->maxLength('colesterol_total', 20)
            ->allowEmpty('colesterol_total');

        $validator
            ->scalar('hdl_colesterol')
            ->maxLength('hdl_colesterol', 20)
            ->allowEmpty('hdl_colesterol');

        $validator
            ->scalar('ldl_colesterol')
            ->maxLength('ldl_colesterol', 20)
            ->allowEmpty('ldl_colesterol');

        $validator
            ->scalar('trigliceridos')
            ->maxLength('trigliceridos', 20)
            ->allowEmpty('trigliceridos');

        $validator
            ->scalar('f_alcalina')
            ->maxLength('f_alcalina', 20)
            ->allowEmpty('f_alcalina');

        $validator
            ->scalar('transaminasa_got')
            ->maxLength('transaminasa_got', 20)
            ->allowEmpty('transaminasa_got');

        $validator
            ->scalar('transaminasa_gpt')
            ->maxLength('transaminasa_gpt', 20)
            ->allowEmpty('transaminasa_gpt');

        $validator
            ->scalar('bilirrubina_total')
            ->maxLength('bilirrubina_total', 20)
            ->allowEmpty('bilirrubina_total');

        $validator
            ->scalar('bilirrubina_directa')
            ->maxLength('bilirrubina_directa', 20)
            ->allowEmpty('bilirrubina_directa');

        $validator
            ->scalar('bilirrubina_indirecta')
            ->maxLength('bilirrubina_indirecta', 20)
            ->allowEmpty('bilirrubina_indirecta');

        $validator
            ->scalar('amilasa')
            ->maxLength('amilasa', 20)
            ->allowEmpty('amilasa');

        $validator
            ->scalar('proteinas_totales')
            ->maxLength('proteinas_totales', 20)
            ->allowEmpty('proteinas_totales');

        $validator
            ->scalar('albumina')
            ->maxLength('albumina', 20)
            ->allowEmpty('albumina');

        $validator
            ->scalar('calcio')
            ->maxLength('calcio', 20)
            ->allowEmpty('calcio');

        $validator
            ->scalar('cpk')
            ->maxLength('cpk', 20)
            ->allowEmpty('cpk');

        $validator
            ->scalar('cpk_mb')
            ->maxLength('cpk_mb', 20)
            ->allowEmpty('cpk_mb');

        $validator
            ->scalar('gamaglutamil_transpeptidasa')
            ->maxLength('gamaglutamil_transpeptidasa', 20)
            ->allowEmpty('gamaglutamil_transpeptidasa');

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
