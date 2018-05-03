<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LiquidoSinovialPrueba Entity
 *
 * @property int $id
 * @property string $volumen
 * @property string $proteinas_totales
 * @property string $glucosa
 * @property string $celulas
 * @property string $coagulo_fibrina
 * @property string $glicemia
 * @property string $urea
 * @property string $creatinina
 * @property int $prueba_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Prueba $prueba
 */
class LiquidoSinovialPrueba extends Entity
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
        'volumen' => true,
        'proteinas_totales' => true,
        'glucosa' => true,
        'celulas' => true,
        'coagulo_fibrina' => true,
        'glicemia' => true,
        'urea' => true,
        'creatinina' => true,
        'prueba_id' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'prueba' => true
    ];
}
