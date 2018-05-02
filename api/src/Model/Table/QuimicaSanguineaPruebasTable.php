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
            ->requirePresence('glucemia', 'create')
            ->notEmpty('glucemia');

        $validator
            ->scalar('urea')
            ->maxLength('urea', 20)
            ->requirePresence('urea', 'create')
            ->notEmpty('urea');

        $validator
            ->scalar('creatinina')
            ->maxLength('creatinina', 20)
            ->requirePresence('creatinina', 'create')
            ->notEmpty('creatinina');

        $validator
            ->scalar('acido_urico')
            ->maxLength('acido_urico', 20)
            ->requirePresence('acido_urico', 'create')
            ->notEmpty('acido_urico');

        $validator
            ->scalar('colesterol_total')
            ->maxLength('colesterol_total', 20)
            ->requirePresence('colesterol_total', 'create')
            ->notEmpty('colesterol_total');

        $validator
            ->scalar('hdl_colesterol')
            ->maxLength('hdl_colesterol', 20)
            ->requirePresence('hdl_colesterol', 'create')
            ->notEmpty('hdl_colesterol');

        $validator
            ->scalar('ldl_colesterol')
            ->maxLength('ldl_colesterol', 20)
            ->requirePresence('ldl_colesterol', 'create')
            ->notEmpty('ldl_colesterol');

        $validator
            ->scalar('trigliceridos')
            ->maxLength('trigliceridos', 20)
            ->requirePresence('trigliceridos', 'create')
            ->notEmpty('trigliceridos');

        $validator
            ->scalar('f_alcalina')
            ->maxLength('f_alcalina', 20)
            ->requirePresence('f_alcalina', 'create')
            ->notEmpty('f_alcalina');

        $validator
            ->scalar('transaminasa_got')
            ->maxLength('transaminasa_got', 20)
            ->requirePresence('transaminasa_got', 'create')
            ->notEmpty('transaminasa_got');

        $validator
            ->scalar('transaminasa_gpt')
            ->maxLength('transaminasa_gpt', 20)
            ->requirePresence('transaminasa_gpt', 'create')
            ->notEmpty('transaminasa_gpt');

        $validator
            ->scalar('bilirrubina_total')
            ->maxLength('bilirrubina_total', 20)
            ->requirePresence('bilirrubina_total', 'create')
            ->notEmpty('bilirrubina_total');

        $validator
            ->scalar('bilirrubina_directa')
            ->maxLength('bilirrubina_directa', 20)
            ->requirePresence('bilirrubina_directa', 'create')
            ->notEmpty('bilirrubina_directa');

        $validator
            ->scalar('bilirrubina_indirecta')
            ->maxLength('bilirrubina_indirecta', 20)
            ->requirePresence('bilirrubina_indirecta', 'create')
            ->notEmpty('bilirrubina_indirecta');

        $validator
            ->scalar('amilasa')
            ->maxLength('amilasa', 20)
            ->requirePresence('amilasa', 'create')
            ->notEmpty('amilasa');

        $validator
            ->scalar('proteinas_totales')
            ->maxLength('proteinas_totales', 20)
            ->requirePresence('proteinas_totales', 'create')
            ->notEmpty('proteinas_totales');

        $validator
            ->scalar('albumina')
            ->maxLength('albumina', 20)
            ->requirePresence('albumina', 'create')
            ->notEmpty('albumina');

        $validator
            ->scalar('calcio')
            ->maxLength('calcio', 20)
            ->requirePresence('calcio', 'create')
            ->notEmpty('calcio');

        $validator
            ->scalar('cpk')
            ->maxLength('cpk', 20)
            ->requirePresence('cpk', 'create')
            ->notEmpty('cpk');

        $validator
            ->scalar('cpk_mb')
            ->maxLength('cpk_mb', 20)
            ->requirePresence('cpk_mb', 'create')
            ->notEmpty('cpk_mb');

        $validator
            ->scalar('gamaglutamil_transpeptidasa')
            ->maxLength('gamaglutamil_transpeptidasa', 20)
            ->requirePresence('gamaglutamil_transpeptidasa', 'create')
            ->notEmpty('gamaglutamil_transpeptidasa');

        $validator
            ->scalar('prueba_inmunologica_embarazo')
            ->maxLength('prueba_inmunologica_embarazo', 150)
            ->requirePresence('prueba_inmunologica_embarazo', 'create')
            ->notEmpty('prueba_inmunologica_embarazo');

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
