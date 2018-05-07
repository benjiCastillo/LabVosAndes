<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SerologiaPruebas Model
 *
 * @property \App\Model\Table\PruebasTable|\Cake\ORM\Association\BelongsTo $Pruebas
 *
 * @method \App\Model\Entity\SerologiaPrueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\SerologiaPrueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SerologiaPrueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SerologiaPrueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SerologiaPrueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SerologiaPrueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SerologiaPrueba findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SerologiaPruebasTable extends Table
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

        $this->setTable('serologia_pruebas');
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
            ->scalar('factor_reumatoide')
            ->maxLength('factor_reumatoide', 20)
            ->allowEmpty('factor_reumatoide');

        $validator
            ->scalar('pcr')
            ->maxLength('pcr', 20)
            ->allowEmpty('pcr');

        $validator
            ->scalar('asto')
            ->maxLength('asto', 20)
            ->allowEmpty('asto');

        $validator
            ->scalar('aso')
            ->maxLength('aso', 20)
            ->allowEmpty('aso');

        $validator
            ->scalar('k_plus')
            ->maxLength('k_plus', 20)
            ->allowEmpty('k_plus');

        $validator
            ->scalar('na_plus')
            ->maxLength('na_plus', 20)
            ->allowEmpty('na_plus');

        $validator
            ->scalar('cl_minus')
            ->maxLength('cl_minus', 20)
            ->allowEmpty('cl_minus');

        $validator
            ->scalar('ca')
            ->maxLength('ca', 20)
            ->allowEmpty('ca');

        $validator
            ->scalar('p')
            ->maxLength('p', 20)
            ->allowEmpty('p');

        $validator
            ->scalar('chagas')
            ->maxLength('chagas', 20)
            ->allowEmpty('chagas');

        $validator
            ->scalar('toxoplasmosis')
            ->maxLength('toxoplasmosis', 20)
            ->allowEmpty('toxoplasmosis');

        $validator
            ->scalar('chagas_resultado')
            ->maxLength('chagas_resultado', 20)
            ->allowEmpty('chagas_resultado');

        $validator
            ->scalar('chagas_elisa_cut_off')
            ->maxLength('chagas_elisa_cut_off', 20)
            ->allowEmpty('chagas_elisa_cut_off');

        $validator
            ->scalar('chagas_comentario')
            ->allowEmpty('chagas_comentario');

        $validator
            ->scalar('tiempo_sangria')
            ->maxLength('tiempo_sangria', 20)
            ->allowEmpty('tiempo_sangria');

        $validator
            ->scalar('tiempo_coagulacion')
            ->maxLength('tiempo_coagulacion', 20)
            ->allowEmpty('tiempo_coagulacion');

        $validator
            ->scalar('tiempo_protrombina')
            ->maxLength('tiempo_protrombina', 20)
            ->allowEmpty('tiempo_protrombina');

        $validator
            ->scalar('actividad_protrombina')
            ->maxLength('actividad_protrombina', 20)
            ->allowEmpty('actividad_protrombina');

        $validator
            ->scalar('grupo_sanguineo')
            ->maxLength('grupo_sanguineo', 20)
            ->allowEmpty('grupo_sanguineo');

        $validator
            ->scalar('factor_rh')
            ->maxLength('factor_rh', 20)
            ->allowEmpty('factor_rh');

        $validator
            ->scalar('recuento_plaquetas')
            ->maxLength('recuento_plaquetas', 50)
            ->allowEmpty('recuento_plaquetas');

        $validator
            ->scalar('agr_dis_plaquetaria')
            ->maxLength('agr_dis_plaquetaria', 50)
            ->allowEmpty('agr_dis_plaquetaria');

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
