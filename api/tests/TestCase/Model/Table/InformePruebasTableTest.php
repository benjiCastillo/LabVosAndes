<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InformePruebasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InformePruebasTable Test Case
 */
class InformePruebasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InformePruebasTable
     */
    public $InformePruebas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.informe_pruebas',
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
        $config = TableRegistry::exists('InformePruebas') ? [] : ['className' => InformePruebasTable::class];
        $this->InformePruebas = TableRegistry::get('InformePruebas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InformePruebas);

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
