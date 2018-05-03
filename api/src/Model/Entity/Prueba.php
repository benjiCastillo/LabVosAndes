<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Prueba Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $fecha
 * @property int $medico_id
 * @property int $paciente_id
 *
 * @property \App\Model\Entity\Medico $medico
 * @property \App\Model\Entity\Paciente $paciente
 * @property \App\Model\Entity\BiometriaPrueba[] $biometria_pruebas
 * @property \App\Model\Entity\CultivosPrueba[] $cultivos_pruebas
 * @property \App\Model\Entity\EspermogramaPrueba[] $espermograma_pruebas
 * @property \App\Model\Entity\ExamenGeneralPrueba[] $examen_general_pruebas
 * @property \App\Model\Entity\HormonasPrueba[] $hormonas_pruebas
 * @property \App\Model\Entity\InformePrueba[] $informe_pruebas
 * @property \App\Model\Entity\LiquidoSinovialPrueba[] $liquido_sinovial_pruebas
 * @property \App\Model\Entity\MicrobiologiaPrueba[] $microbiologia_pruebas
 * @property \App\Model\Entity\ParasitologiaPrueba[] $parasitologia_pruebas
 * @property \App\Model\Entity\QuimicaSanguineaPrueba[] $quimica_sanguinea_pruebas
 * @property \App\Model\Entity\ReaccionWPrueba[] $reaccion_w_pruebas
 * @property \App\Model\Entity\SerologiaPrueba[] $serologia_pruebas
 */
class Prueba extends Entity
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
        'fecha' => true,
        'medico_id' => true,
        'paciente_id' => true,
        'medico' => true,
        'paciente' => true,
        'biometria_pruebas' => true,
        'cultivos_pruebas' => true,
        'espermograma_pruebas' => true,
        'examen_general_pruebas' => true,
        'hormonas_pruebas' => true,
        'informe_pruebas' => true,
        'liquido_sinovial_pruebas' => true,
        'microbiologia_pruebas' => true,
        'parasitologia_pruebas' => true,
        'quimica_sanguinea_pruebas' => true,
        'reaccion_w_pruebas' => true,
        'serologia_pruebas' => true
    ];
}
