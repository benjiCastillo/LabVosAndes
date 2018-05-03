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
            ->maxLength('color', 15)
            ->requirePresence('color', 'create')
            ->notEmpty('color');

        $validator
            ->scalar('cantidad')
            ->maxLength('cantidad', 15)
            ->requirePresence('cantidad', 'create')
            ->notEmpty('cantidad');

        $validator
            ->scalar('olor')
            ->maxLength('olor', 15)
            ->requirePresence('olor', 'create')
            ->notEmpty('olor');

        $validator
            ->scalar('aspecto')
            ->maxLength('aspecto', 15)
            ->requirePresence('aspecto', 'create')
            ->notEmpty('aspecto');

        $validator
            ->scalar('espuma')
            ->maxLength('espuma', 15)
            ->requirePresence('espuma', 'create')
            ->notEmpty('espuma');

        $validator
            ->scalar('sedimento')
            ->maxLength('sedimento', 15)
            ->requirePresence('sedimento', 'create')
            ->notEmpty('sedimento');

        $validator
            ->scalar('densidad')
            ->maxLength('densidad', 15)
            ->requirePresence('densidad', 'create')
            ->notEmpty('densidad');

        $validator
            ->scalar('reaccion')
            ->maxLength('reaccion', 15)
            ->requirePresence('reaccion', 'create')
            ->notEmpty('reaccion');

        $validator
            ->scalar('proteinas')
            ->maxLength('proteinas', 15)
            ->requirePresence('proteinas', 'create')
            ->notEmpty('proteinas');

        $validator
            ->scalar('glucosa')
            ->maxLength('glucosa', 15)
            ->requirePresence('glucosa', 'create')
            ->notEmpty('glucosa');

        $validator
            ->scalar('cetona')
            ->maxLength('cetona', 15)
            ->requirePresence('cetona', 'create')
            ->notEmpty('cetona');

        $validator
            ->scalar('bilirrubina')
            ->maxLength('bilirrubina', 15)
            ->requirePresence('bilirrubina', 'create')
            ->notEmpty('bilirrubina');

        $validator
            ->scalar('sangre')
            ->maxLength('sangre', 15)
            ->requirePresence('sangre', 'create')
            ->notEmpty('sangre');

        $validator
            ->scalar('nitritos')
            ->maxLength('nitritos', 15)
            ->requirePresence('nitritos', 'create')
            ->notEmpty('nitritos');

        $validator
            ->scalar('urubilinogeno')
            ->maxLength('urubilinogeno', 15)
            ->requirePresence('urubilinogeno', 'create')
            ->notEmpty('urubilinogeno');

        $validator
            ->scalar('eritrocitos')
            ->maxLength('eritrocitos', 15)
            ->requirePresence('eritrocitos', 'create')
            ->notEmpty('eritrocitos');

        $validator
            ->scalar('piocitos')
            ->maxLength('piocitos', 15)
            ->requirePresence('piocitos', 'create')
            ->notEmpty('piocitos');

        $validator
            ->scalar('leucocitos')
            ->maxLength('leucocitos', 15)
            ->requirePresence('leucocitos', 'create')
            ->notEmpty('leucocitos');

        $validator
            ->scalar('cilindros')
            ->maxLength('cilindros', 15)
            ->requirePresence('cilindros', 'create')
            ->notEmpty('cilindros');

        $validator
            ->scalar('celulas')
            ->maxLength('celulas', 15)
            ->requirePresence('celulas', 'create')
            ->notEmpty('celulas');

        $validator
            ->scalar('cristales')
            ->maxLength('cristales', 15)
            ->requirePresence('cristales', 'create')
            ->notEmpty('cristales');

        $validator
            ->scalar('otros')
            ->requirePresence('otros', 'create')
            ->notEmpty('otros');

        $validator
            ->scalar('exa_bac_sed')
            ->requirePresence('exa_bac_sed', 'create')
            ->notEmpty('exa_bac_sed');

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
