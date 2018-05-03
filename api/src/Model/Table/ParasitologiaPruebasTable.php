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
            ->scalar('consistencia')
            ->maxLength('consistencia', 20)
            ->requirePresence('consistencia', 'create')
            ->notEmpty('consistencia');

        $validator
            ->scalar('color')
            ->maxLength('color', 20)
            ->requirePresence('color', 'create')
            ->notEmpty('color');

        $validator
            ->scalar('restos_alimenticios')
            ->maxLength('restos_alimenticios', 20)
            ->requirePresence('restos_alimenticios', 'create')
            ->notEmpty('restos_alimenticios');

        $validator
            ->scalar('leucocitos')
            ->maxLength('leucocitos', 20)
            ->requirePresence('leucocitos', 'create')
            ->notEmpty('leucocitos');

        $validator
            ->scalar('comentario')
            ->requirePresence('comentario', 'create')
            ->notEmpty('comentario');

        $validator
            ->scalar('sangre_oculta')
            ->maxLength('sangre_oculta', 20)
            ->requirePresence('sangre_oculta', 'create')
            ->notEmpty('sangre_oculta');

        $validator
            ->scalar('muestras')
            ->requirePresence('muestras', 'create')
            ->notEmpty('muestras');

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
