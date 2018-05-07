<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MicrobiologiaPruebasFixture
 *
 */
class MicrobiologiaPruebasFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'celulas_epitelio_vaginal' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'leucocitos' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'piocitos' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'celulas_clave' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'tricomona_vaginalis' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'flora_bacteriana' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'hifas_micoticas' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'prueba_koh' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'coco_bacilos_gram_positivos' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'cocos_gram_positivos' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'bacilos_gram_positivos' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'bacilos_gram_negativos' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'hifas_esporas_micoticas' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'prueba_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'modified_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
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
                'celulas_epitelio_vaginal' => 'Lorem ipsum dolor ',
                'leucocitos' => 'Lorem ipsum dolor ',
                'piocitos' => 'Lorem ipsum dolor ',
                'celulas_clave' => 'Lorem ipsum dolor ',
                'tricomona_vaginalis' => 'Lorem ipsum dolor ',
                'flora_bacteriana' => 'Lorem ipsum dolor ',
                'hifas_micoticas' => 'Lorem ipsum dolor ',
                'prueba_koh' => 'Lorem ipsum dolor ',
                'coco_bacilos_gram_positivos' => 'Lorem ipsum dolor ',
                'cocos_gram_positivos' => 'Lorem ipsum dolor ',
                'bacilos_gram_positivos' => 'Lorem ipsum dolor ',
                'bacilos_gram_negativos' => 'Lorem ipsum dolor ',
                'hifas_esporas_micoticas' => 'Lorem ipsum dolor ',
                'prueba_id' => 1,
                'created' => '2018-05-07 00:14:17',
                'modified' => '2018-05-07 00:14:17',
                'created_by' => 1,
                'modified_by' => 1
            ],
        ];
        parent::init();
    }
}
