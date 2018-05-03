<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MicrobiologiaPruebas Model
 *
 * @property \App\Model\Table\PruebasTable|\Cake\ORM\Association\BelongsTo $Pruebas
 *
 * @method \App\Model\Entity\MicrobiologiaPrueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\MicrobiologiaPrueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MicrobiologiaPrueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MicrobiologiaPrueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MicrobiologiaPrueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MicrobiologiaPrueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MicrobiologiaPrueba findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MicrobiologiaPruebasTable extends Table
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

        $this->setTable('microbiologia_pruebas');
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
            ->scalar('celulas_epitelio_vaginal')
            ->maxLength('celulas_epitelio_vaginal', 20)
            ->requirePresence('celulas_epitelio_vaginal', 'create')
            ->notEmpty('celulas_epitelio_vaginal');

        $validator
            ->scalar('leucocitos')
            ->maxLength('leucocitos', 20)
            ->requirePresence('leucocitos', 'create')
            ->notEmpty('leucocitos');

        $validator
            ->scalar('piocitos')
            ->maxLength('piocitos', 20)
            ->requirePresence('piocitos', 'create')
            ->notEmpty('piocitos');

        $validator
            ->scalar('celulas_clave')
            ->maxLength('celulas_clave', 20)
            ->requirePresence('celulas_clave', 'create')
            ->notEmpty('celulas_clave');

        $validator
            ->scalar('tricomona_vaginalis')
            ->maxLength('tricomona_vaginalis', 20)
            ->requirePresence('tricomona_vaginalis', 'create')
            ->notEmpty('tricomona_vaginalis');

        $validator
            ->scalar('flora_bacteriana')
            ->maxLength('flora_bacteriana', 20)
            ->requirePresence('flora_bacteriana', 'create')
            ->notEmpty('flora_bacteriana');

        $validator
            ->scalar('hifas_micoticas')
            ->maxLength('hifas_micoticas', 20)
            ->requirePresence('hifas_micoticas', 'create')
            ->notEmpty('hifas_micoticas');

        $validator
            ->scalar('prueba_koh')
            ->maxLength('prueba_koh', 20)
            ->requirePresence('prueba_koh', 'create')
            ->notEmpty('prueba_koh');

        $validator
            ->scalar('coco_bacilos_gram_positivos')
            ->maxLength('coco_bacilos_gram_positivos', 20)
            ->requirePresence('coco_bacilos_gram_positivos', 'create')
            ->notEmpty('coco_bacilos_gram_positivos');

        $validator
            ->scalar('cocos_gram_positivos')
            ->maxLength('cocos_gram_positivos', 20)
            ->requirePresence('cocos_gram_positivos', 'create')
            ->notEmpty('cocos_gram_positivos');

        $validator
            ->scalar('bacilos_gram_positivos')
            ->maxLength('bacilos_gram_positivos', 20)
            ->requirePresence('bacilos_gram_positivos', 'create')
            ->notEmpty('bacilos_gram_positivos');

        $validator
            ->scalar('bacilos_gram_negativos')
            ->maxLength('bacilos_gram_negativos', 20)
            ->requirePresence('bacilos_gram_negativos', 'create')
            ->notEmpty('bacilos_gram_negativos');

        $validator
            ->scalar('hifas_esporas_micoticas')
            ->maxLength('hifas_esporas_micoticas', 20)
            ->requirePresence('hifas_esporas_micoticas', 'create')
            ->notEmpty('hifas_esporas_micoticas');

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
