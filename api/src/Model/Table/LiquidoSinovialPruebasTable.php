<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LiquidoSinovialPruebas Model
 *
 * @property \App\Model\Table\PruebasTable|\Cake\ORM\Association\BelongsTo $Pruebas
 *
 * @method \App\Model\Entity\LiquidoSinovialPrueba get($primaryKey, $options = [])
 * @method \App\Model\Entity\LiquidoSinovialPrueba newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LiquidoSinovialPrueba[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LiquidoSinovialPrueba|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LiquidoSinovialPrueba patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LiquidoSinovialPrueba[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LiquidoSinovialPrueba findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LiquidoSinovialPruebasTable extends Table
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

        $this->setTable('liquido_sinovial_pruebas');
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
            ->scalar('volumen')
            ->maxLength('volumen', 20)
            ->allowEmpty('volumen');
            
        $validator
            ->scalar('proteinas_totales')
            ->maxLength('proteinas_totales', 20)
            ->allowEmpty('proteinas_totales');

        $validator
            ->scalar('glucosa')
            ->maxLength('glucosa', 20)
            ->allowEmpty('glucosa');

        $validator
            ->scalar('celulas')
            ->maxLength('celulas', 20)
            ->allowEmpty('celulas');

        $validator
            ->scalar('coagulo_fibrina')
            ->maxLength('coagulo_fibrina', 20)
            ->allowEmpty('coagulo_fibrina');

        $validator
            ->scalar('glicemia')
            ->maxLength('glicemia', 20)
            ->allowEmpty('glicemia');

        $validator
            ->scalar('urea')
            ->maxLength('urea', 20)
            ->allowEmpty('urea');

        $validator
            ->scalar('creatinina')
            ->maxLength('creatinina', 20)
            ->allowEmpty('creatinina');

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
