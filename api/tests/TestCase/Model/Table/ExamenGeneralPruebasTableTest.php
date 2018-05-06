<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExamenGeneralPruebasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExamenGeneralPruebasTable Test Case
 */
class ExamenGeneralPruebasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExamenGeneralPruebasTable
     */
    public $ExamenGeneralPruebas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.examen_general_pruebas',
        'app.pruebas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExamenGeneralPruebas') ? [] : ['className' => ExamenGeneralPruebasTable::class];
        $this->ExamenGeneralPruebas = TableRegistry::get('ExamenGeneralPruebas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExamenGeneralPruebas);

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
