<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExamenGeneralPruebas Model
 *
 * @property \App\Model\Table\PruebasTable|\Cake\ORM\Association\BelongsTo $Pruebas
 *
 * @method \App\Model\Entity\ExamenGeneralPrueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExamenGeneralPrueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExamenGeneralPrueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExamenGeneralPrueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExamenGeneralPrueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExamenGeneralPrueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExamenGeneralPrueba findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExamenGeneralPruebasTable extends Table
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

        $this->setTable('examen_general_pruebas');
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
            ->scalar('color')
            ->maxLength('color', 40)
            ->allowEmpty('color');

        $validator
            ->scalar('cantidad')
            ->maxLength('cantidad', 40)
            ->allowEmpty('cantidad');

        $validator
            ->scalar('olor')
            ->maxLength('olor', 40)
            ->allowEmpty('olor');

        $validator
            ->scalar('aspecto')
            ->maxLength('aspecto', 40)
            ->allowEmpty('aspecto');

        $validator
            ->scalar('espuma')
            ->maxLength('espuma', 40)
            ->allowEmpty('espuma');

        $validator
            ->scalar('sedimento')
            ->maxLength('sedimento', 40)
            ->allowEmpty('sedimento');

        $validator
            ->scalar('densidad')
            ->maxLength('densidad', 40)
            ->allowEmpty('densidad');

        $validator
            ->scalar('reaccion')
            ->maxLength('reaccion', 40)
            ->allowEmpty('reaccion');

        $validator
            ->scalar('proteinas')
            ->maxLength('proteinas', 40)
            ->allowEmpty('proteinas');

        $validator
            ->scalar('glucosa')
            ->maxLength('glucosa', 40)
            ->allowEmpty('glucosa');

        $validator
            ->scalar('cetona')
            ->maxLength('cetona', 40)
            ->allowEmpty('cetona');

        $validator
            ->scalar('bilirrubina')
            ->maxLength('bilirrubina', 40)
            ->allowEmpty('bilirrubina');

        $validator
            ->scalar('sangre')
            ->maxLength('sangre', 40)
            ->allowEmpty('sangre');

        $validator
            ->scalar('nitritos')
            ->maxLength('nitritos', 40)
            ->allowEmpty('nitritos');

        $validator
            ->scalar('urubilinogeno')
            ->maxLength('urubilinogeno', 40)
            ->allowEmpty('urubilinogeno');

        $validator
            ->scalar('eritrocitos')
            ->maxLength('eritrocitos', 40)
            ->allowEmpty('eritrocitos');

        $validator
            ->scalar('piocitos')
            ->maxLength('piocitos', 40)
            ->allowEmpty('piocitos');

        $validator
            ->scalar('leucocitos')
            ->maxLength('leucocitos', 40)
            ->allowEmpty('leucocitos');

        $validator
            ->scalar('cilindros')
            ->maxLength('cilindros', 40)
            ->allowEmpty('cilindros');

        $validator
            ->scalar('celulas')
            ->maxLength('celulas', 40)
            ->allowEmpty('celulas');

        $validator
            ->scalar('cristales')
            ->maxLength('cristales', 40)
            ->allowEmpty('cristales');

        $validator
            ->scalar('otros')
            ->allowEmpty('otros');

        $validator
            ->scalar('exa_bac_sed')
            ->allowEmpty('exa_bac_sed');

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
