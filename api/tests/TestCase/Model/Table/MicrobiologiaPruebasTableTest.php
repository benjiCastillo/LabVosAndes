<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MicrobiologiaPruebasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MicrobiologiaPruebasTable Test Case
 */
class MicrobiologiaPruebasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MicrobiologiaPruebasTable
     */
    public $MicrobiologiaPruebas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.microbiologia_pruebas',
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
        $config = TableRegistry::exists('MicrobiologiaPruebas') ? [] : ['className' => MicrobiologiaPruebasTable::class];
        $this->MicrobiologiaPruebas = TableRegistry::get('MicrobiologiaPruebas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MicrobiologiaPruebas);

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
