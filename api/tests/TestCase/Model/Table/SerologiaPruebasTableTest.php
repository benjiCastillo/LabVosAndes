<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SerologiaPruebasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SerologiaPruebasTable Test Case
 */
class SerologiaPruebasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SerologiaPruebasTable
     */
    public $SerologiaPruebas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.serologia_pruebas',
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
        $config = TableRegistry::exists('SerologiaPruebas') ? [] : ['className' => SerologiaPruebasTable::class];
        $this->SerologiaPruebas = TableRegistry::get('SerologiaPruebas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SerologiaPruebas);

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
