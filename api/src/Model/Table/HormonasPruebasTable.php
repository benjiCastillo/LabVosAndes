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
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
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
            ->scalar('tsh')
            ->maxLength('tsh', 40)
            ->allowEmpty('tsh');

        $validator
            ->scalar('t4_libre')
            ->maxLength('t4_libre', 40)
            ->allowEmpty('t4_libre');

        $validator
            ->scalar('t4_total')
            ->maxLength('t4_total', 40)
            ->allowEmpty('t4_total');

        $validator
            ->scalar('t3')
            ->maxLength('t3', 40)
            ->allowEmpty('t3');

        $validator
            ->scalar('cisticercosis_resultado')
            ->maxLength('cisticercosis_resultado', 40)
            ->allowEmpty('cisticercosis_resultado');

        $validator
            ->scalar('cisticercosis_cut_off')
            ->maxLength('cisticercosis_cut_off', 40)
            ->allowEmpty('cisticercosis_cut_off');

        $validator
            ->scalar('comentario_cisticercosis')
            ->allowEmpty('comentario_cisticercosis');

        $validator
            ->scalar('antigeno_carcino')
            ->maxLength('antigeno_carcino', 40)
            ->allowEmpty('antigeno_carcino');

        $validator
            ->scalar('psa_total')
            ->maxLength('psa_total', 40)
            ->allowEmpty('psa_total');

        $validator
            ->scalar('psa_libre')
            ->maxLength('psa_libre', 40)
            ->allowEmpty('psa_libre');

        $validator
            ->scalar('relacion_psa_libre_total')
            ->maxLength('relacion_psa_libre_total', 40)
            ->allowEmpty('relacion_psa_libre_total');

        $validator
            ->scalar('estradiol')
            ->maxLength('estradiol', 40)
            ->allowEmpty('estradiol');

        $validator
            ->scalar('progesterona')
            ->maxLength('progesterona', 40)
            ->allowEmpty('progesterona');

        $validator
            ->scalar('fsh')
            ->maxLength('fsh', 40)
            ->allowEmpty('fsh');

        $validator
            ->scalar('lh')
            ->maxLength('lh', 40)
            ->allowEmpty('lh');

        $validator
            ->scalar('prolactina')
            ->maxLength('prolactina', 40)
            ->allowEmpty('prolactina');

        $validator
            ->scalar('testosterona')
            ->maxLength('testosterona', 40)
            ->allowEmpty('testosterona');

        $validator
            ->scalar('ana')
            ->maxLength('ana', 40)
            ->allowEmpty('ana');

        $validator
            ->scalar('ana_control_positivo')
            ->maxLength('ana_control_positivo', 40)
            ->allowEmpty('ana_control_positivo');

        $validator
            ->scalar('ana_control_negativo')
            ->maxLength('ana_control_negativo', 40)
            ->allowEmpty('ana_control_negativo');

        $validator
            ->scalar('celulas_le')
            ->maxLength('celulas_le', 40)
            ->allowEmpty('celulas_le');

        $validator
            ->scalar('celulas_le_control_positivo')
            ->maxLength('celulas_le_control_positivo', 40)
            ->allowEmpty('celulas_le_control_positivo');

        $validator
            ->scalar('celulas_le_control_negativo')
            ->maxLength('celulas_le_control_negativo', 40)
            ->allowEmpty('celulas_le_control_negativo');

        $validator
            ->scalar('anticuerpos_resultado')
            ->maxLength('anticuerpos_resultado', 40)
            ->allowEmpty('anticuerpos_resultado');

        $validator
            ->scalar('anticuerpos_cut_off')
            ->maxLength('anticuerpos_cut_off', 40)
            ->allowEmpty('anticuerpos_cut_off');

        $validator
            ->scalar('comentario_anticuerpos')
            ->allowEmpty('comentario_anticuerpos');

        $validator
            ->scalar('toxoplasmosis_lgm')
            ->maxLength('toxoplasmosis_lgm', 40)
            ->allowEmpty('toxoplasmosis_lgm');

        $validator
            ->scalar('toxoplasmosis_lgg')
            ->maxLength('toxoplasmosis_lgg', 40)
            ->allowEmpty('toxoplasmosis_lgg');

        $validator
            ->scalar('b_hcg_cuantitativo')
            ->maxLength('b_hcg_cuantitativo', 40)
            ->allowEmpty('b_hcg_cuantitativo');

        $validator
            ->scalar('anti_nucleares')
            ->maxLength('anti_nucleares', 40)
            ->allowEmpty('anti_nucleares');

        $validator
            ->scalar('anticuerpos_control_positivo')
            ->maxLength('anticuerpos_control_positivo', 40)
            ->allowEmpty('anticuerpos_control_positivo');

        $validator
            ->scalar('anticuerpos_control_negativo')
            ->maxLength('anticuerpos_control_negativo', 40)
            ->allowEmpty('anticuerpos_control_negativo');

        $validator
            ->scalar('celulas_hep')
            ->maxLength('celulas_hep', 40)
            ->allowEmpty('celulas_hep');

        $validator
            ->scalar('control_positivo')
            ->maxLength('control_positivo', 40)
            ->allowEmpty('control_positivo');

        $validator
            ->scalar('control_negativo')
            ->maxLength('control_negativo', 40)
            ->allowEmpty('control_negativo');

        $validator
            ->scalar('conclusion')
            ->allowEmpty('conclusion');

        $validator
            ->scalar('comentario_general')
            ->allowEmpty('comentario_general');

        $validator
            ->scalar('laboratorio')
            ->maxLength('laboratorio', 80)
            ->allowEmpty('laboratorio');

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
