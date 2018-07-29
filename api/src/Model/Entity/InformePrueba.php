<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InformePrueba Entity
 *
 * @property int $id
 * @property string $grupo_sanguineo
 * @property string $factor_rh
 * @property string $prueba_inmunologica_embarazo
 * @property string $other
 * @property int $prueba_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Prueba $prueba
 */
class InformePrueba extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'grupo_sanguineo' => true,
        'factor_rh' => true,
        'prueba_inmunologica_embarazo' => true,
        'other' => true,
        'prueba_id' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'prueba' => true
    ];
}
