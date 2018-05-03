<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PacienteTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PacienteTable Test Case
 */
class PacienteTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PacienteTable
     */
    public $Paciente;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.paciente'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Paciente') ? [] : ['className' => PacienteTable::class];
        $this->Paciente = TableRegistry::get('Paciente', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Paciente);

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
