<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * QuimicaSanguineaPrueba Entity
 *
 * @property int $id
 * @property string $glucemia
 * @property string $urea
 * @property string $creatinina
 * @property string $acido_urico
 * @property string $colesterol_total
 * @property string $hdl_colesterol
 * @property string $ldl_colesterol
 * @property string $trigliceridos
 * @property string $f_alcalina
 * @property string $transaminasa_got
 * @property string $transaminasa_gpt
 * @property string $bilirrubina_total
 * @property string $bilirrubina_directa
 * @property string $bilirrubina_indirecta
 * @property string $amilasa
 * @property string $proteinas_totales
 * @property string $albumina
 * @property string $calcio
 * @property string $cpk
 * @property string $cpk_mb
 * @property string $gamaglutamil_transpeptidasa
 * @property string $prueba_inmunologica_embarazo
 * @property int $prueba_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Prueba $prueba
 */
class QuimicaSanguineaPrueba extends Entity
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
        'glucemia' => true,
        'urea' => true,
        'creatinina' => true,
        'acido_urico' => true,
        'colesterol_total' => true,
        'hdl_colesterol' => true,
        'ldl_colesterol' => true,
        'trigliceridos' => true,
        'f_alcalina' => true,
        'transaminasa_got' => true,
        'transaminasa_gpt' => true,
        'bilirrubina_total' => true,
        'bilirrubina_directa' => true,
        'bilirrubina_indirecta' => true,
        'amilasa' => true,
        'proteinas_totales' => true,
        'albumina' => true,
        'calcio' => true,
        'cpk' => true,
        'cpk_mb' => true,
        'gamaglutamil_transpeptidasa' => true,
        'prueba_inmunologica_embarazo' => true,
        'prueba_id' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'prueba' => true
    ];
}
