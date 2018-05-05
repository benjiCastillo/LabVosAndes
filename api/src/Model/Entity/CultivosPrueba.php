<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CultivosPrueba Entity
 *
 * @property int $id
 * @property string $leucocitos
 * @property string $bacterias
 * @property string $esputo_as
 * @property string $esputo_microorganismo_identificado
 * @property string $antibioticos
 * @property string $ampicilina_sulbactam
 * @property string $eritromicina
 * @property string $clindamicina
 * @property string $tetraciclina
 * @property string $vancomicina
 * @property string $recuento_colonias
 * @property string $agar_mac_conkey
 * @property string $tincion_gram
 * @property string $pruebas_bioquimicas
 * @property string $urocultivo_microorganismo_identificado
 * @property string $amoxicilina_ac_clavulanico
 * @property string $gentamicina
 * @property string $ciprofloxacino
 * @property string $cefixima
 * @property string $cotrimoxazol
 * @property string $nitrofurantoina
 * @property int $prueba_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Prueba $prueba
 */
class CultivosPrueba extends Entity
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
        'leucocitos' => true,
        'bacterias' => true,
        'esputo_as' => true,
        'esputo_microorganismo_identificado' => true,
        'antibioticos' => true,
        'ampicilina_sulbactam' => true,
        'eritromicina' => true,
        'clindamicina' => true,
        'tetraciclina' => true,
        'vancomicina' => true,
        'recuento_colonias' => true,
        'agar_mac_conkey' => true,
        'tincion_gram' => true,
        'pruebas_bioquimicas' => true,
        'urocultivo_microorganismo_identificado' => true,
        'amoxicilina_ac_clavulanico' => true,
        'gentamicina' => true,
        'ciprofloxacino' => true,
        'cefixima' => true,
        'cotrimoxazol' => true,
        'nitrofurantoina' => true,
        'prueba_id' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'prueba' => true
    ];
}
