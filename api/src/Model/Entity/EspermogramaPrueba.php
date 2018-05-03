<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EspermogramaPrueba Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $hora_recoleccion
 * @property \Cake\I18n\FrozenTime $hora_recepcion
 * @property string $duracion_abstinencia
 * @property string $aspecto
 * @property string $color
 * @property string $volumen
 * @property string $viscosidad
 * @property string $ph
 * @property string $concentracion_espermatica
 * @property string $caracteristicas_morfologicas
 * @property string $espermatozoides_normales
 * @property string $cabeza
 * @property string $pieza_intermedia
 * @property string $cola
 * @property string $leucocitos
 * @property string $celulas_germinales
 * @property string $aglutinacion
 * @property string $progresion_lineal_rapida
 * @property string $progresion_lineal_lenta
 * @property string $motilidad_no_progresiva
 * @property string $inmoviles
 * @property string $primera_hora
 * @property string $segunda_hora
 * @property string $tercera_hora
 * @property int $prueba_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Prueba $prueba
 */
class EspermogramaPrueba extends Entity
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
        'hora_recoleccion' => true,
        'hora_recepcion' => true,
        'duracion_abstinencia' => true,
        'aspecto' => true,
        'color' => true,
        'volumen' => true,
        'viscosidad' => true,
        'ph' => true,
        'concentracion_espermatica' => true,
        'caracteristicas_morfologicas' => true,
        'espermatozoides_normales' => true,
        'cabeza' => true,
        'pieza_intermedia' => true,
        'cola' => true,
        'leucocitos' => true,
        'celulas_germinales' => true,
        'aglutinacion' => true,
        'progresion_lineal_rapida' => true,
        'progresion_lineal_lenta' => true,
        'motilidad_no_progresiva' => true,
        'inmoviles' => true,
        'primera_hora' => true,
        'segunda_hora' => true,
        'tercera_hora' => true,
        'prueba_id' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'prueba' => true
    ];
}
