<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReaccionWPruebasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReaccionWPruebasTable Test Case
 */
class ReaccionWPruebasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReaccionWPruebasTable
     */
    public $ReaccionWPruebas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reaccion_w_pruebas',
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
        $config = TableRegistry::exists('ReaccionWPruebas') ? [] : ['className' => ReaccionWPruebasTable::class];
        $this->ReaccionWPruebas = TableRegistry::get('ReaccionWPruebas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReaccionWPruebas);

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
