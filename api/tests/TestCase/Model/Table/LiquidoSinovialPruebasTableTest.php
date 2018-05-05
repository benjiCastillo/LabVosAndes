<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LiquidoSinovialPruebasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LiquidoSinovialPruebasTable Test Case
 */
class LiquidoSinovialPruebasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LiquidoSinovialPruebasTable
     */
    public $LiquidoSinovialPruebas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.liquido_sinovial_pruebas',
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
        $config = TableRegistry::exists('LiquidoSinovialPruebas') ? [] : ['className' => LiquidoSinovialPruebasTable::class];
        $this->LiquidoSinovialPruebas = TableRegistry::get('LiquidoSinovialPruebas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LiquidoSinovialPruebas);

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
