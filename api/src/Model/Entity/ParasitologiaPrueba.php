<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ParasitologiaPrueba Entity
 *
 * @property int $id
 * @property string $consistencia
 * @property string $color
 * @property string $restos_alimenticios
 * @property string $leucocitos
 * @property string $comentario
 * @property string $sangre_oculta
 * @property string $muestras
 * @property int $prueba_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Prueba $prueba
 */
class ParasitologiaPrueba extends Entity
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
        'consistencia' => true,
        'color' => true,
        'restos_alimenticios' => true,
        'leucocitos' => true,
        'comentario' => true,
        'sangre_oculta' => true,
        'muestras' => true,
        'prueba_id' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'prueba' => true
    ];
}
