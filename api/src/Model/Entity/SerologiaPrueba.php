<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SerologiaPrueba Entity
 *
 * @property int $id
 * @property string $factor_reumatoide
 * @property string $pcr
 * @property string $asto
 * @property string $aso
 * @property string $k_plus
 * @property string $na_plus
 * @property string $cl_minus
 * @property string $ca
 * @property string $p
 * @property string $chagas
 * @property string $toxoplasmosis
 * @property string $chagas_resultado
 * @property string $chagas_elisa_cut_off
 * @property string $chagas_comentario
 * @property string $tiempo_sangria
 * @property string $tiempo_coagulacion
 * @property string $tiempo_protrombina
 * @property string $actividad_protrombina
 * @property string $grupo_sanguineo
 * @property string $factor_rh
 * @property string $recuento_plaquetas
 * @property string $agr_dis_plaquetaria
 * @property int $prueba_id
 *
 * @property \App\Model\Entity\Prueba $prueba
 */
class SerologiaPrueba extends Entity
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
        'factor_reumatoide' => true,
        'pcr' => true,
        'asto' => true,
        'aso' => true,
        'k_plus' => true,
        'na_plus' => true,
        'cl_minus' => true,
        'ca' => true,
        'p' => true,
        'chagas' => true,
        'toxoplasmosis' => true,
        'chagas_resultado' => true,
        'chagas_elisa_cut_off' => true,
        'chagas_comentario' => true,
        'tiempo_sangria' => true,
        'tiempo_coagulacion' => true,
        'tiempo_protrombina' => true,
        'actividad_protrombina' => true,
        'grupo_sanguineo' => true,
        'factor_rh' => true,
        'recuento_plaquetas' => true,
        'agr_dis_plaquetaria' => true,
        'prueba_id' => true,
        'prueba' => true
    ];
}
