<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuimicaSanguineaPruebasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuimicaSanguineaPruebasTable Test Case
 */
class QuimicaSanguineaPruebasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuimicaSanguineaPruebasTable
     */
    public $QuimicaSanguineaPruebas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.quimica_sanguinea_pruebas',
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
        $config = TableRegistry::exists('QuimicaSanguineaPruebas') ? [] : ['className' => QuimicaSanguineaPruebasTable::class];
        $this->QuimicaSanguineaPruebas = TableRegistry::get('QuimicaSanguineaPruebas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QuimicaSanguineaPruebas);

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
