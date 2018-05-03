<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HormonasPrueba Entity
 *
 * @property int $id
 * @property string $tsh
 * @property string $t4_libre
 * @property string $t4_total
 * @property string $t3
 * @property string $cisticercosis_resultado
 * @property string $cisticercosis_cut_off
 * @property string $comentario_cisticercosis
 * @property string $antigeno_carcino
 * @property string $psa_total
 * @property string $psa_libre
 * @property string $relacion_psa_libre_total
 * @property string $estradiol
 * @property string $progesterona
 * @property string $fsh
 * @property string $lh
 * @property string $prolactina
 * @property string $testosterona
 * @property string $ana
 * @property string $testosterona_control_positivo
 * @property string $testosterona_control_negativo
 * @property string $celulas_le
 * @property string $celulas_le_control_positivo
 * @property string $celulas_le_control_negativo
 * @property string $anticuerpos_resultado
 * @property string $anticuerpos_cut_off
 * @property string $comentario_anticuerpos
 * @property string $toxoplasmosis_lgm
 * @property string $toxoplasmosis_lgg
 * @property string $b_hcg_cuantitativo
 * @property string $anti_nucleares
 * @property string $anticuerpos_control_positivo
 * @property string $anticuerpos_control_negativo
 * @property string $celulas_hep
 * @property string $control_positivo
 * @property string $control_negativo
 * @property string $conclusión
 * @property string $comentario_general
 * @property int $prueba_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Prueba $prueba
 */
class HormonasPrueba extends Entity
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
        'tsh' => true,
        't4_libre' => true,
        't4_total' => true,
        't3' => true,
        'cisticercosis_resultado' => true,
        'cisticercosis_cut_off' => true,
        'comentario_cisticercosis' => true,
        'antigeno_carcino' => true,
        'psa_total' => true,
        'psa_libre' => true,
        'relacion_psa_libre_total' => true,
        'estradiol' => true,
        'progesterona' => true,
        'fsh' => true,
        'lh' => true,
        'prolactina' => true,
        'testosterona' => true,
        'ana' => true,
        'testosterona_control_positivo' => true,
        'testosterona_control_negativo' => true,
        'celulas_le' => true,
        'celulas_le_control_positivo' => true,
        'celulas_le_control_negativo' => true,
        'anticuerpos_resultado' => true,
        'anticuerpos_cut_off' => true,
        'comentario_anticuerpos' => true,
        'toxoplasmosis_lgm' => true,
        'toxoplasmosis_lgg' => true,
        'b_hcg_cuantitativo' => true,
        'anti_nucleares' => true,
        'anticuerpos_control_positivo' => true,
        'anticuerpos_control_negativo' => true,
        'celulas_hep' => true,
        'control_positivo' => true,
        'control_negativo' => true,
        'conclusión' => true,
        'comentario_general' => true,
        'prueba_id' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'prueba' => true
    ];
}
