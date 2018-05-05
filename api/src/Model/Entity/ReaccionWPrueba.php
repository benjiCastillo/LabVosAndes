<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReaccionWPrueba Entity
 *
 * @property int $id
 * @property string $paraA1
 * @property string $paraA2
 * @property string $paraA3
 * @property string $paraA4
 * @property string $paraA5
 * @property string $paraA6
 * @property string $paraB1
 * @property string $paraB2
 * @property string $paraB3
 * @property string $paraB4
 * @property string $paraB5
 * @property string $paraB6
 * @property string $somaticoO1
 * @property string $somaticoO2
 * @property string $somaticoO3
 * @property string $somaticoO4
 * @property string $somaticoO5
 * @property string $somaticoO6
 * @property string $flagelarH1
 * @property string $flagelarH2
 * @property string $flagelarH3
 * @property string $flagelarH4
 * @property string $flagelarH5
 * @property string $flagelarH6
 * @property string $comentario
 * @property int $prueba_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Prueba $prueba
 */
class ReaccionWPrueba extends Entity
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
        'paraA1' => true,
        'paraA2' => true,
        'paraA3' => true,
        'paraA4' => true,
        'paraA5' => true,
        'paraA6' => true,
        'paraB1' => true,
        'paraB2' => true,
        'paraB3' => true,
        'paraB4' => true,
        'paraB5' => true,
        'paraB6' => true,
        'somaticoO1' => true,
        'somaticoO2' => true,
        'somaticoO3' => true,
        'somaticoO4' => true,
        'somaticoO5' => true,
        'somaticoO6' => true,
        'flagelarH1' => true,
        'flagelarH2' => true,
        'flagelarH3' => true,
        'flagelarH4' => true,
        'flagelarH5' => true,
        'flagelarH6' => true,
        'comentario' => true,
        'prueba_id' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'prueba' => true
    ];
}
