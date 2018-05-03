<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BiometriaPrueba Entity
 *
 * @property int $id
 * @property string $hematies
 * @property string $hematocrito
 * @property string $hemoglobina
 * @property string $leucocitos
 * @property string $vsg
 * @property string $vcm
 * @property string $hbcm
 * @property string $chbcm
 * @property string $comentario_hema
 * @property string $cayados
 * @property string $neutrofilos
 * @property string $basofilo
 * @property string $eosinofilo
 * @property string $linfocito
 * @property string $monocito
 * @property string $prolinfocito
 * @property string $cel_inmaduras
 * @property string $comentario_leuco
 * @property int $prueba_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Prueba $prueba
 */
class BiometriaPrueba extends Entity
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
        'hematies' => true,
        'hematocrito' => true,
        'hemoglobina' => true,
        'leucocitos' => true,
        'vsg' => true,
        'vcm' => true,
        'hbcm' => true,
        'chbcm' => true,
        'comentario_hema' => true,
        'cayados' => true,
        'neutrofilos' => true,
        'basofilo' => true,
        'eosinofilo' => true,
        'linfocito' => true,
        'monocito' => true,
        'prolinfocito' => true,
        'cel_inmaduras' => true,
        'comentario_leuco' => true,
        'prueba_id' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'prueba' => true
    ];
}
