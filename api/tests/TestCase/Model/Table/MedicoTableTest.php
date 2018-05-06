<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MedicoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MedicoTable Test Case
 */
class MedicoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MedicoTable
     */
    public $Medico;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.medico'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Medico') ? [] : ['className' => MedicoTable::class];
        $this->Medico = TableRegistry::get('Medico', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Medico);

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
}
