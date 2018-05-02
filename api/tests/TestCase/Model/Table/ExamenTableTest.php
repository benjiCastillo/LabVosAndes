<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExamenTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExamenTable Test Case
 */
class ExamenTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExamenTable
     */
    public $Examen;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.examen'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Examen') ? [] : ['className' => ExamenTable::class];
        $this->Examen = TableRegistry::get('Examen', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Examen);

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
