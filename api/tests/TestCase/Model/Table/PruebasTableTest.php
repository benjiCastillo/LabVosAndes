<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PruebasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PruebasTable Test Case
 */
class PruebasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PruebasTable
     */
    public $Pruebas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pruebas',
        'app.medicos',
        'app.pacientes',
        'app.biometria_pruebas',
        'app.cultivos_pruebas',
        'app.espermograma_pruebas',
        'app.examen_general_pruebas',
        'app.hormonas_pruebas',
        'app.informe_pruebas',
        'app.liquido_sinovial_pruebas',
        'app.microbiologia_pruebas',
        'app.parasitologia_pruebas',
        'app.quimica_sanguinea_pruebas',
        'app.reaccion_w_pruebas',
        'app.serologia_pruebas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Pruebas') ? [] : ['className' => PruebasTable::class];
        $this->Pruebas = TableRegistry::get('Pruebas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pruebas);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
