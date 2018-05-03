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
            ->requirePresence('hora_recoleccion', 'create')
            ->notEmpty('hora_recoleccion');

        $validator
            ->dateTime('hora_recepcion')
            ->requirePresence('hora_recepcion', 'create')
            ->notEmpty('hora_recepcion');

        $validator
            ->scalar('duracion_abstinencia')
            ->maxLength('duracion_abstinencia', 20)
            ->requirePresence('duracion_abstinencia', 'create')
            ->notEmpty('duracion_abstinencia');

        $validator
            ->scalar('aspecto')
            ->maxLength('aspecto', 20)
            ->requirePresence('aspecto', 'create')
            ->notEmpty('aspecto');

        $validator
            ->scalar('color')
            ->maxLength('color', 20)
            ->requirePresence('color', 'create')
            ->notEmpty('color');

        $validator
            ->scalar('volumen')
            ->maxLength('volumen', 20)
            ->requirePresence('volumen', 'create')
            ->notEmpty('volumen');

        $validator
            ->scalar('viscosidad')
            ->maxLength('viscosidad', 20)
            ->requirePresence('viscosidad', 'create')
            ->notEmpty('viscosidad');

        $validator
            ->scalar('ph')
            ->maxLength('ph', 20)
            ->requirePresence('ph', 'create')
            ->notEmpty('ph');

        $validator
            ->scalar('concentracion_espermatica')
            ->maxLength('concentracion_espermatica', 20)
            ->requirePresence('concentracion_espermatica', 'create')
            ->notEmpty('concentracion_espermatica');

        $validator
            ->scalar('caracteristicas_morfologicas')
            ->maxLength('caracteristicas_morfologicas', 20)
            ->requirePresence('caracteristicas_morfologicas', 'create')
            ->notEmpty('caracteristicas_morfologicas');

        $validator
            ->scalar('espermatozoides_normales')
            ->maxLength('espermatozoides_normales', 20)
            ->requirePresence('espermatozoides_normales', 'create')
            ->notEmpty('espermatozoides_normales');

        $validator
            ->scalar('cabeza')
            ->maxLength('cabeza', 20)
            ->requirePresence('cabeza', 'create')
            ->notEmpty('cabeza');

        $validator
            ->scalar('pieza_intermedia')
            ->maxLength('pieza_intermedia', 20)
            ->requirePresence('pieza_intermedia', 'create')
            ->notEmpty('pieza_intermedia');

        $validator
            ->scalar('cola')
            ->maxLength('cola', 20)
            ->requirePresence('cola', 'create')
            ->notEmpty('cola');

        $validator
            ->scalar('leucocitos')
            ->maxLength('leucocitos', 20)
            ->requirePresence('leucocitos', 'create')
            ->notEmpty('leucocitos');

        $validator
            ->scalar('celulas_germinales')
            ->maxLength('celulas_germinales', 20)
            ->requirePresence('celulas_germinales', 'create')
            ->notEmpty('celulas_germinales');

        $validator
            ->scalar('aglutinacion')
            ->maxLength('aglutinacion', 20)
            ->requirePresence('aglutinacion', 'create')
            ->notEmpty('aglutinacion');

        $validator
            ->scalar('progresion_lineal_rapida')
            ->maxLength('progresion_lineal_rapida', 20)
            ->requirePresence('progresion_lineal_rapida', 'create')
            ->notEmpty('progresion_lineal_rapida');

        $validator
            ->scalar('progresion_lineal_lenta')
            ->maxLength('progresion_lineal_lenta', 20)
            ->requirePresence('progresion_lineal_lenta', 'create')
            ->notEmpty('progresion_lineal_lenta');

        $validator
            ->scalar('motilidad_no_progresiva')
            ->maxLength('motilidad_no_progresiva', 20)
            ->requirePresence('motilidad_no_progresiva', 'create')
            ->notEmpty('motilidad_no_progresiva');

        $validator
            ->scalar('inmoviles')
            ->maxLength('inmoviles', 20)
            ->requirePresence('inmoviles', 'create')
            ->notEmpty('inmoviles');

        $validator
            ->scalar('primera_hora')
            ->maxLength('primera_hora', 20)
            ->requirePresence('primera_hora', 'create')
            ->notEmpty('primera_hora');

        $validator
            ->scalar('segunda_hora')
            ->maxLength('segunda_hora', 20)
            ->requirePresence('segunda_hora', 'create')
            ->notEmpty('segunda_hora');

        $validator
            ->scalar('tercera_hora')
            ->maxLength('tercera_hora', 20)
            ->requirePresence('tercera_hora', 'create')
            ->notEmpty('tercera_hora');

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
