<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParasitologiaPruebas Model
 *
 * @property \App\Model\Table\PruebasTable|\Cake\ORM\Association\BelongsTo $Pruebas
 *
 * @method \App\Model\Entity\ParasitologiaPrueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\ParasitologiaPrueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ParasitologiaPrueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ParasitologiaPrueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParasitologiaPrueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ParasitologiaPrueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ParasitologiaPrueba findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ParasitologiaPruebasTable extends Table
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

        $this->setTable('parasitologia_pruebas');
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
            ->scalar('subtitulo')
            ->maxLength('subtitulo', 100)
            ->allowEmpty('subtitulo');

        $validator
            ->scalar('consistencia')
            ->maxLength('consistencia', 40)
            ->allowEmpty('consistencia');

        $validator
            ->scalar('color')
            ->maxLength('color', 40)
            ->allowEmpty('color');

        $validator
            ->scalar('restos_alimenticios')
            ->maxLength('restos_alimenticios', 40)
            ->allowEmpty('restos_alimenticios');

        $validator
            ->scalar('leucocitos')
            ->maxLength('leucocitos', 40)
            ->allowEmpty('leucocitos');

        $validator
            ->scalar('comentario')
            ->allowEmpty('comentario');

        $validator
            ->scalar('sangre_oculta')
            ->maxLength('sangre_oculta', 40)
            ->allowEmpty('sangre_oculta');

        $validator
            ->scalar('muestra1')
            ->maxLength('muestra1', 100)
            ->allowEmpty('muestra1');

        $validator
            ->scalar('muestra2')
            ->maxLength('muestra2', 100)
            ->requirePresence('muestra2', 'create')
            ->notEmpty('muestra2');

        $validator
            ->scalar('muestra3')
            ->maxLength('muestra3', 100)
            ->requirePresence('muestra3', 'create')
            ->notEmpty('muestra3');

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
