<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HormonasPruebasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HormonasPruebasTable Test Case
 */
class HormonasPruebasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HormonasPruebasTable
     */
    public $HormonasPruebas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hormonas_pruebas',
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
        $config = TableRegistry::exists('HormonasPruebas') ? [] : ['className' => HormonasPruebasTable::class];
        $this->HormonasPruebas = TableRegistry::get('HormonasPruebas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HormonasPruebas);

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
