<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HormonasPruebas Model
 *
 * @property \App\Model\Table\PruebasTable|\Cake\ORM\Association\BelongsTo $Pruebas
 *
 * @method \App\Model\Entity\HormonasPrueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\HormonasPrueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HormonasPrueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HormonasPrueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HormonasPrueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HormonasPrueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HormonasPrueba findOrCreate($search, callable $callback = null, $options = [])
 */
class HormonasPruebasTable extends Table
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

        $this->setTable('hormonas_pruebas');
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
            ->scalar('tsh')
            ->maxLength('tsh', 20)
            ->requirePresence('tsh', 'create')
            ->notEmpty('tsh');

        $validator
            ->scalar('t4_libre')
            ->maxLength('t4_libre', 20)
            ->requirePresence('t4_libre', 'create')
            ->notEmpty('t4_libre');

        $validator
            ->scalar('t4_total')
            ->maxLength('t4_total', 20)
            ->requirePresence('t4_total', 'create')
            ->notEmpty('t4_total');

        $validator
            ->scalar('t3')
            ->maxLength('t3', 20)
            ->requirePresence('t3', 'create')
            ->notEmpty('t3');

        $validator
            ->scalar('cisticercosis_resultado')
            ->maxLength('cisticercosis_resultado', 20)
            ->requirePresence('cisticercosis_resultado', 'create')
            ->notEmpty('cisticercosis_resultado');

        $validator
            ->scalar('cisticercosis_cut_off')
            ->maxLength('cisticercosis_cut_off', 20)
            ->requirePresence('cisticercosis_cut_off', 'create')
            ->notEmpty('cisticercosis_cut_off');

        $validator
            ->scalar('comentario_cisticercosis')
            ->requirePresence('comentario_cisticercosis', 'create')
            ->notEmpty('comentario_cisticercosis');

        $validator
            ->scalar('antigeno_carcino')
            ->maxLength('antigeno_carcino', 20)
            ->requirePresence('antigeno_carcino', 'create')
            ->notEmpty('antigeno_carcino');

        $validator
            ->scalar('psa_total')
            ->maxLength('psa_total', 20)
            ->requirePresence('psa_total', 'create')
            ->notEmpty('psa_total');

        $validator
            ->scalar('psa_libre')
            ->maxLength('psa_libre', 20)
            ->requirePresence('psa_libre', 'create')
            ->notEmpty('psa_libre');

        $validator
            ->scalar('relacion_psa_libre_total')
            ->maxLength('relacion_psa_libre_total', 20)
            ->requirePresence('relacion_psa_libre_total', 'create')
            ->notEmpty('relacion_psa_libre_total');

        $validator
            ->scalar('estradiol')
            ->maxLength('estradiol', 20)
            ->requirePresence('estradiol', 'create')
            ->notEmpty('estradiol');

        $validator
            ->scalar('progesterona')
            ->maxLength('progesterona', 20)
            ->requirePresence('progesterona', 'create')
            ->notEmpty('progesterona');

        $validator
            ->scalar('fsh')
            ->maxLength('fsh', 20)
            ->requirePresence('fsh', 'create')
            ->notEmpty('fsh');

        $validator
            ->scalar('lh')
            ->maxLength('lh', 20)
            ->requirePresence('lh', 'create')
            ->notEmpty('lh');

        $validator
            ->scalar('prolactina')
            ->maxLength('prolactina', 20)
            ->requirePresence('prolactina', 'create')
            ->notEmpty('prolactina');

        $validator
            ->scalar('testosterona')
            ->maxLength('testosterona', 20)
            ->requirePresence('testosterona', 'create')
            ->notEmpty('testosterona');

        $validator
            ->scalar('ana')
            ->maxLength('ana', 20)
            ->requirePresence('ana', 'create')
            ->notEmpty('ana');

        $validator
            ->scalar('testosterona_control_positivo')
            ->maxLength('testosterona_control_positivo', 20)
            ->requirePresence('testosterona_control_positivo', 'create')
            ->notEmpty('testosterona_control_positivo');

        $validator
            ->scalar('testosterona_control_negativo')
            ->maxLength('testosterona_control_negativo', 20)
            ->requirePresence('testosterona_control_negativo', 'create')
            ->notEmpty('testosterona_control_negativo');

        $validator
            ->scalar('celulas_le')
            ->maxLength('celulas_le', 20)
            ->requirePresence('celulas_le', 'create')
            ->notEmpty('celulas_le');

        $validator
            ->scalar('celulas_le_control_positivo')
            ->maxLength('celulas_le_control_positivo', 20)
            ->requirePresence('celulas_le_control_positivo', 'create')
            ->notEmpty('celulas_le_control_positivo');

        $validator
            ->scalar('celulas_le_control_negativo')
            ->maxLength('celulas_le_control_negativo', 20)
            ->requirePresence('celulas_le_control_negativo', 'create')
            ->notEmpty('celulas_le_control_negativo');

        $validator
            ->scalar('anticuerpos_resultado')
            ->maxLength('anticuerpos_resultado', 20)
            ->requirePresence('anticuerpos_resultado', 'create')
            ->notEmpty('anticuerpos_resultado');

        $validator
            ->scalar('anticuerpos_cut_off')
            ->maxLength('anticuerpos_cut_off', 20)
            ->requirePresence('anticuerpos_cut_off', 'create')
            ->notEmpty('anticuerpos_cut_off');

        $validator
            ->scalar('comentario_anticuerpos')
            ->requirePresence('comentario_anticuerpos', 'create')
            ->notEmpty('comentario_anticuerpos');

        $validator
            ->scalar('toxoplasmosis_lgm')
            ->maxLength('toxoplasmosis_lgm', 20)
            ->requirePresence('toxoplasmosis_lgm', 'create')
            ->notEmpty('toxoplasmosis_lgm');

        $validator
            ->scalar('toxoplasmosis_lgg')
            ->maxLength('toxoplasmosis_lgg', 20)
            ->requirePresence('toxoplasmosis_lgg', 'create')
            ->notEmpty('toxoplasmosis_lgg');

        $validator
            ->scalar('b_hcg_cuantitativo')
            ->maxLength('b_hcg_cuantitativo', 20)
            ->requirePresence('b_hcg_cuantitativo', 'create')
            ->notEmpty('b_hcg_cuantitativo');

        $validator
            ->scalar('anti_nucleares')
            ->maxLength('anti_nucleares', 20)
            ->requirePresence('anti_nucleares', 'create')
            ->notEmpty('anti_nucleares');

        $validator
            ->scalar('anticuerpos_control_positivo')
            ->maxLength('anticuerpos_control_positivo', 20)
            ->requirePresence('anticuerpos_control_positivo', 'create')
            ->notEmpty('anticuerpos_control_positivo');

        $validator
            ->scalar('anticuerpos_control_negativo')
            ->maxLength('anticuerpos_control_negativo', 20)
            ->requirePresence('anticuerpos_control_negativo', 'create')
            ->notEmpty('anticuerpos_control_negativo');

        $validator
            ->scalar('celulas_hep')
            ->maxLength('celulas_hep', 20)
            ->requirePresence('celulas_hep', 'create')
            ->notEmpty('celulas_hep');

        $validator
            ->scalar('control_positivo')
            ->maxLength('control_positivo', 20)
            ->requirePresence('control_positivo', 'create')
            ->notEmpty('control_positivo');

        $validator
            ->scalar('control_negativo')
            ->maxLength('control_negativo', 20)
            ->requirePresence('control_negativo', 'create')
            ->notEmpty('control_negativo');

        $validator
            ->scalar('conclusión')
            ->requirePresence('conclusión', 'create')
            ->notEmpty('conclusión');

        $validator
            ->scalar('comentario_general')
            ->requirePresence('comentario_general', 'create')
            ->notEmpty('comentario_general');

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
