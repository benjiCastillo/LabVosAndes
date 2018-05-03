<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ExamenFixture
 *
 */
class ExamenFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'examen';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'fecha' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP(6)', 'comment' => '', 'precision' => null],
        'id_medico' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_paciente' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'id_medico' => ['type' => 'index', 'columns' => ['id_medico'], 'length' => []],
            'id_paciente' => ['type' => 'index', 'columns' => ['id_paciente'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'examen_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_medico'], 'references' => ['medico', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'examen_ibfk_2' => ['type' => 'foreign', 'columns' => ['id_paciente'], 'references' => ['paciente', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_spanish2_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'fecha' => 1525236121,
                'id_medico' => 1,
                'id_paciente' => 1
            ],
        ];
        parent::init();
    }
}
