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
            ->requirePresence('factor_reumatoide', 'create')
            ->notEmpty('factor_reumatoide');

        $validator
            ->scalar('pcr')
            ->maxLength('pcr', 20)
            ->requirePresence('pcr', 'create')
            ->notEmpty('pcr');

        $validator
            ->scalar('asto')
            ->maxLength('asto', 20)
            ->requirePresence('asto', 'create')
            ->notEmpty('asto');

        $validator
            ->scalar('aso')
            ->maxLength('aso', 20)
            ->requirePresence('aso', 'create')
            ->notEmpty('aso');

        $validator
            ->scalar('k_plus')
            ->maxLength('k_plus', 20)
            ->requirePresence('k_plus', 'create')
            ->notEmpty('k_plus');

        $validator
            ->scalar('na_plus')
            ->maxLength('na_plus', 20)
            ->requirePresence('na_plus', 'create')
            ->notEmpty('na_plus');

        $validator
            ->scalar('cl_minus')
            ->maxLength('cl_minus', 20)
            ->requirePresence('cl_minus', 'create')
            ->notEmpty('cl_minus');

        $validator
            ->scalar('ca')
            ->maxLength('ca', 20)
            ->requirePresence('ca', 'create')
            ->notEmpty('ca');

        $validator
            ->scalar('p')
            ->maxLength('p', 20)
            ->requirePresence('p', 'create')
            ->notEmpty('p');

        $validator
            ->scalar('chagas')
            ->maxLength('chagas', 20)
            ->requirePresence('chagas', 'create')
            ->notEmpty('chagas');

        $validator
            ->scalar('toxoplasmosis')
            ->maxLength('toxoplasmosis', 20)
            ->requirePresence('toxoplasmosis', 'create')
            ->notEmpty('toxoplasmosis');

        $validator
            ->scalar('chagas_resultado')
            ->maxLength('chagas_resultado', 20)
            ->requirePresence('chagas_resultado', 'create')
            ->notEmpty('chagas_resultado');

        $validator
            ->scalar('chagas_elisa_cut_off')
            ->maxLength('chagas_elisa_cut_off', 20)
            ->requirePresence('chagas_elisa_cut_off', 'create')
            ->notEmpty('chagas_elisa_cut_off');

        $validator
            ->scalar('chagas_comentario')
            ->requirePresence('chagas_comentario', 'create')
            ->notEmpty('chagas_comentario');

        $validator
            ->scalar('tiempo_sangria')
            ->maxLength('tiempo_sangria', 20)
            ->requirePresence('tiempo_sangria', 'create')
            ->notEmpty('tiempo_sangria');

        $validator
            ->scalar('tiempo_coagulacion')
            ->maxLength('tiempo_coagulacion', 20)
            ->requirePresence('tiempo_coagulacion', 'create')
            ->notEmpty('tiempo_coagulacion');

        $validator
            ->scalar('tiempo_protrombina')
            ->maxLength('tiempo_protrombina', 20)
            ->requirePresence('tiempo_protrombina', 'create')
            ->notEmpty('tiempo_protrombina');

        $validator
            ->scalar('actividad_protrombina')
            ->maxLength('actividad_protrombina', 20)
            ->requirePresence('actividad_protrombina', 'create')
            ->notEmpty('actividad_protrombina');

        $validator
            ->scalar('grupo_sanguineo')
            ->maxLength('grupo_sanguineo', 20)
            ->requirePresence('grupo_sanguineo', 'create')
            ->notEmpty('grupo_sanguineo');

        $validator
            ->scalar('factor_rh')
            ->maxLength('factor_rh', 20)
            ->requirePresence('factor_rh', 'create')
            ->notEmpty('factor_rh');

        $validator
            ->scalar('recuento_plaquetas')
            ->maxLength('recuento_plaquetas', 50)
            ->requirePresence('recuento_plaquetas', 'create')
            ->notEmpty('recuento_plaquetas');

        $validator
            ->scalar('agr_dis_plaquetaria')
            ->maxLength('agr_dis_plaquetaria', 50)
            ->requirePresence('agr_dis_plaquetaria', 'create')
            ->notEmpty('agr_dis_plaquetaria');

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
