<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EspermogramaPruebas Model
 *
 * @property \App\Model\Table\PruebasTable|\Cake\ORM\Association\BelongsTo $Pruebas
 *
 * @method \App\Model\Entity\EspermogramaPrueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\EspermogramaPrueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EspermogramaPrueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EspermogramaPrueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EspermogramaPrueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EspermogramaPrueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EspermogramaPrueba findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EspermogramaPruebasTable extends Table
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

        $this->setTable('espermograma_pruebas');
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
            ->dateTime('hora_recoleccion')
            ->allowEmpty('hora_recoleccion');

        $validator
            ->dateTime('hora_recepcion')
            ->allowEmpty('hora_recepcion');

        $validator
            ->scalar('duracion_abstinencia')
            ->maxLength('duracion_abstinencia', 40)
            ->allowEmpty('duracion_abstinencia');

        $validator
            ->scalar('aspecto')
            ->maxLength('aspecto', 40)
            ->allowEmpty('aspecto');

        $validator
            ->scalar('color')
            ->maxLength('color', 40)
            ->allowEmpty('color');

        $validator
            ->scalar('volumen')
            ->maxLength('volumen', 40)
            ->allowEmpty('volumen');

        $validator
            ->scalar('viscosidad')
            ->maxLength('viscosidad', 40)
            ->allowEmpty('viscosidad');

        $validator
            ->scalar('ph')
            ->maxLength('ph', 40)
            ->allowEmpty('ph');

        $validator
            ->scalar('concentracion_espermatica')
            ->maxLength('concentracion_espermatica', 40)
            ->allowEmpty('concentracion_espermatica');

        $validator
            ->scalar('caracteristicas_morfologicas')
            ->maxLength('caracteristicas_morfologicas', 40)
            ->allowEmpty('caracteristicas_morfologicas');

        $validator
            ->scalar('espermatozoides_normales')
            ->maxLength('espermatozoides_normales', 40)
            ->allowEmpty('espermatozoides_normales');

        $validator
            ->scalar('cabeza')
            ->maxLength('cabeza', 40)
            ->allowEmpty('cabeza');

        $validator
            ->scalar('pieza_intermedia')
            ->maxLength('pieza_intermedia', 40)
            ->allowEmpty('pieza_intermedia');

        $validator
            ->scalar('cola')
            ->maxLength('cola', 40)
            ->allowEmpty('cola');

        $validator
            ->scalar('otras_celulas')
            ->allowEmpty('otras_celulas');

        $validator
            ->scalar('aglutinacion')
            ->maxLength('aglutinacion', 40)
            ->allowEmpty('aglutinacion');

        $validator
            ->scalar('progresion_lineal_rapida')
            ->maxLength('progresion_lineal_rapida', 40)
            ->allowEmpty('progresion_lineal_rapida');

        $validator
            ->scalar('progresion_lineal_lenta')
            ->maxLength('progresion_lineal_lenta', 40)
            ->allowEmpty('progresion_lineal_lenta');

        $validator
            ->scalar('motilidad_no_progresiva')
            ->maxLength('motilidad_no_progresiva', 40)
            ->allowEmpty('motilidad_no_progresiva');

        $validator
            ->scalar('inmoviles')
            ->maxLength('inmoviles', 40)
            ->allowEmpty('inmoviles');

        $validator
            ->scalar('primera_hora_moviles')
            ->maxLength('primera_hora_moviles', 40)
            ->allowEmpty('primera_hora_moviles');

        $validator
            ->scalar('primera_hora_inmoviles')
            ->maxLength('primera_hora_inmoviles', 40)
            ->allowEmpty('primera_hora_inmoviles');

        $validator
            ->scalar('segunda_hora_moviles')
            ->maxLength('segunda_hora_moviles', 40)
            ->allowEmpty('segunda_hora_moviles');

        $validator
            ->scalar('segunda_hora_inmoviles')
            ->maxLength('segunda_hora_inmoviles', 40)
            ->allowEmpty('segunda_hora_inmoviles');

        $validator
            ->scalar('tercera_hora_moviles')
            ->maxLength('tercera_hora_moviles', 40)
            ->allowEmpty('tercera_hora_moviles');

        $validator
            ->scalar('tercera_hora_inmoviles')
            ->maxLength('tercera_hora_inmoviles', 40)
            ->allowEmpty('tercera_hora_inmoviles');

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
