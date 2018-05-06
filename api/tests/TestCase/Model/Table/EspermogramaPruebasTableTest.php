<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EspermogramaPruebasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EspermogramaPruebasTable Test Case
 */
class EspermogramaPruebasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EspermogramaPruebasTable
     */
    public $EspermogramaPruebas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.espermograma_pruebas',
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
        $config = TableRegistry::exists('EspermogramaPruebas') ? [] : ['className' => EspermogramaPruebasTable::class];
        $this->EspermogramaPruebas = TableRegistry::get('EspermogramaPruebas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EspermogramaPruebas);

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
