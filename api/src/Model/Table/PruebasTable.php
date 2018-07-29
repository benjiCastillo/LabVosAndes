<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pruebas Model
 *
 * @property \App\Model\Table\MedicosTable|\Cake\ORM\Association\BelongsTo $Medicos
 * @property \App\Model\Table\PacientesTable|\Cake\ORM\Association\BelongsTo $Pacientes
 * @property \App\Model\Table\BiometriaPruebasTable|\Cake\ORM\Association\HasMany $BiometriaPruebas
 * @property \App\Model\Table\CultivosPruebasTable|\Cake\ORM\Association\HasMany $CultivosPruebas
 * @property \App\Model\Table\EspermogramaPruebasTable|\Cake\ORM\Association\HasMany $EspermogramaPruebas
 * @property \App\Model\Table\ExamenGeneralPruebasTable|\Cake\ORM\Association\HasMany $ExamenGeneralPruebas
 * @property \App\Model\Table\HormonasPruebasTable|\Cake\ORM\Association\HasMany $HormonasPruebas
 * @property \App\Model\Table\InformePruebasTable|\Cake\ORM\Association\HasMany $InformePruebas
 * @property \App\Model\Table\LiquidoSinovialPruebasTable|\Cake\ORM\Association\HasMany $LiquidoSinovialPruebas
 * @property \App\Model\Table\MicrobiologiaPruebasTable|\Cake\ORM\Association\HasMany $MicrobiologiaPruebas
 * @property \App\Model\Table\ParasitologiaPruebasTable|\Cake\ORM\Association\HasMany $ParasitologiaPruebas
 * @property \App\Model\Table\QuimicaSanguineaPruebasTable|\Cake\ORM\Association\HasMany $QuimicaSanguineaPruebas
 * @property \App\Model\Table\ReaccionWPruebasTable|\Cake\ORM\Association\HasMany $ReaccionWPruebas
 * @property \App\Model\Table\SerologiaPruebasTable|\Cake\ORM\Association\HasMany $SerologiaPruebas
 *
 * @method \App\Model\Entity\Prueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\Prueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Prueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prueba|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Prueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prueba findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PruebasTable extends Table
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

        $this->setTable('pruebas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Medicos', [
            'foreignKey' => 'medico_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Pacientes', [
            'foreignKey' => 'paciente_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('BiometriaPruebas', [
            'foreignKey' => 'prueba_id'
        ]);
        $this->hasMany('CultivosPruebas', [
            'foreignKey' => 'prueba_id'
        ]);
        $this->hasMany('EspermogramaPruebas', [
            'foreignKey' => 'prueba_id'
        ]);
        $this->hasMany('ExamenGeneralPruebas', [
            'foreignKey' => 'prueba_id'
        ]);
        $this->hasMany('HormonasPruebas', [
            'foreignKey' => 'prueba_id'
        ]);
        $this->hasMany('InformePruebas', [
            'foreignKey' => 'prueba_id'
        ]);
        $this->hasMany('LiquidoSinovialPruebas', [
            'foreignKey' => 'prueba_id'
        ]);
        $this->hasMany('MicrobiologiaPruebas', [
            'foreignKey' => 'prueba_id'
        ]);
        $this->hasMany('ParasitologiaPruebas', [
            'foreignKey' => 'prueba_id'
        ]);
        $this->hasMany('QuimicaSanguineaPruebas', [
            'foreignKey' => 'prueba_id'
        ]);
        $this->hasMany('ReaccionWPruebas', [
            'foreignKey' => 'prueba_id'
        ]);
        $this->hasMany('SerologiaPruebas', [
            'foreignKey' => 'prueba_id'
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
            ->dateTime('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmpty('fecha');

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
        $rules->add($rules->existsIn(['medico_id'], 'Medicos'));
        $rules->add($rules->existsIn(['paciente_id'], 'Pacientes'));

        return $rules;
    }
}
