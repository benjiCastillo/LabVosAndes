<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CultivosPruebasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CultivosPruebasTable Test Case
 */
class CultivosPruebasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CultivosPruebasTable
     */
    public $CultivosPruebas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cultivos_pruebas',
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
        $config = TableRegistry::exists('CultivosPruebas') ? [] : ['className' => CultivosPruebasTable::class];
        $this->CultivosPruebas = TableRegistry::get('CultivosPruebas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CultivosPruebas);

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
