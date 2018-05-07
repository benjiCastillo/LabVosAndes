<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CultivosPruebas Model
 *
 * @property \App\Model\Table\PruebasTable|\Cake\ORM\Association\BelongsTo $Pruebas
 *
 * @method \App\Model\Entity\CultivosPrueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\CultivosPrueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CultivosPrueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CultivosPrueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CultivosPrueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CultivosPrueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CultivosPrueba findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CultivosPruebasTable extends Table
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

        $this->setTable('cultivos_pruebas');
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
            ->scalar('leucocitos')
            ->maxLength('leucocitos', 20)
            ->allowEmpty('leucocitos');

        $validator
            ->scalar('bacterias')
            ->allowEmpty('bacterias');

        $validator
            ->scalar('esputo_as')
            ->maxLength('esputo_as', 35)
            ->allowEmpty('esputo_as');

        $validator
            ->scalar('esputo_microorganismo_identificado')
            ->maxLength('esputo_microorganismo_identificado', 35)
            ->allowEmpty('esputo_microorganismo_identificado');

        $validator
            ->scalar('ampicilina_sulbactam')
            ->maxLength('ampicilina_sulbactam', 20)
            ->allowEmpty('ampicilina_sulbactam');

        $validator
            ->scalar('eritromicina')
            ->maxLength('eritromicina', 20)
            ->allowEmpty('eritromicina');

        $validator
            ->scalar('clindamicina')
            ->maxLength('clindamicina', 20)
            ->allowEmpty('clindamicina');

        $validator
            ->scalar('tetraciclina')
            ->maxLength('tetraciclina', 20)
            ->allowEmpty('tetraciclina');

        $validator
            ->scalar('vancomicina')
            ->maxLength('vancomicina', 20)
            ->allowEmpty('vancomicina');

        $validator
            ->scalar('recuento_colonias')
            ->maxLength('recuento_colonias', 35)
            ->allowEmpty('recuento_colonias');

        $validator
            ->scalar('agar_mac_conkey')
            ->maxLength('agar_mac_conkey', 50)
            ->allowEmpty('agar_mac_conkey');

        $validator
            ->scalar('tincion_gram')
            ->maxLength('tincion_gram', 35)
            ->allowEmpty('tincion_gram');

        $validator
            ->scalar('pruebas_bioquimicas')
            ->maxLength('pruebas_bioquimicas', 50)
            ->allowEmpty('pruebas_bioquimicas');

        $validator
            ->scalar('urocultivo_microorganismo_identificado')
            ->maxLength('urocultivo_microorganismo_identificado', 35)
            ->allowEmpty('urocultivo_microorganismo_identificado');

        $validator
            ->scalar('amoxicilina_ac_clavulanico')
            ->maxLength('amoxicilina_ac_clavulanico', 20)
            ->allowEmpty('amoxicilina_ac_clavulanico');

        $validator
            ->scalar('gentamicina')
            ->maxLength('gentamicina', 20)
            ->allowEmpty('gentamicina');

        $validator
            ->scalar('ciprofloxacino')
            ->maxLength('ciprofloxacino', 20)
            ->allowEmpty('ciprofloxacino');

        $validator
            ->scalar('cefixima')
            ->maxLength('cefixima', 20)
            ->allowEmpty('cefixima');

        $validator
            ->scalar('cotrimoxazol')
            ->maxLength('cotrimoxazol', 20)
            ->allowEmpty('cotrimoxazol');

        $validator
            ->scalar('nitrofurantoina')
            ->maxLength('nitrofurantoina', 20)
            ->allowEmpty('nitrofurantoina');

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
