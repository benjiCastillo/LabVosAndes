<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExamenGeneralPrueba Entity
 *
 * @property int $id
 * @property string $color
 * @property string $cantidad
 * @property string $olor
 * @property string $aspecto
 * @property string $espuma
 * @property string $sedimento
 * @property string $densidad
 * @property string $reaccion
 * @property string $proteinas
 * @property string $glucosa
 * @property string $cetona
 * @property string $bilirrubina
 * @property string $sangre
 * @property string $nitritos
 * @property string $urubilinogeno
 * @property string $eritrocitos
 * @property string $piocitos
 * @property string $leucocitos
 * @property string $cilindros
 * @property string $celulas
 * @property string $cristales
 * @property string $otros
 * @property string $exa_bac_sed
 * @property int $prueba_id
 *
 * @property \App\Model\Entity\Prueba $prueba
 */
class ExamenGeneralPrueba extends Entity
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
        'color' => true,
        'cantidad' => true,
        'olor' => true,
        'aspecto' => true,
        'espuma' => true,
        'sedimento' => true,
        'densidad' => true,
        'reaccion' => true,
        'proteinas' => true,
        'glucosa' => true,
        'cetona' => true,
        'bilirrubina' => true,
        'sangre' => true,
        'nitritos' => true,
        'urubilinogeno' => true,
        'eritrocitos' => true,
        'piocitos' => true,
        'leucocitos' => true,
        'cilindros' => true,
        'celulas' => true,
        'cristales' => true,
        'otros' => true,
        'exa_bac_sed' => true,
        'prueba_id' => true,
        'prueba' => true
    ];
}
