<?php

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class validateArrayNumberTest extends TestCase
{

    /**
     * @dataProvider additionProvider
     */
    public function test_validateArrayNumber_valida_que_el_array_se_componga_de_numeros_debe_generar_Exeption($arr)
    {
        $this->expectException(Exception::class);

        $processor = new Processor;
        $processor->validateArrayNumber($arr);

    }

    public function additionProvider()
    {
        return [
            [
                [
                    "5v",
                    "140 82",
                    "89 134",
                    "90 110",
                    "112 106",
                    "88 90",
                ],
            ],
            [

                [
                    "5",
                    "89 134s",
                    "140 82",
                    "90 110",
                    "88 90",
                    "112 106",
                ],
            ],

            [

                [
                    "5",
                    "89 134",
                    "140 82s",
                    "90 110",
                    "88 90",
                    "112 106",
                ],
            ],

            [

                [
                    "5",
                    "89 134",
                    "140 82",
                    "90 110a",
                    "88 90",
                    "112 106",
                ],
            ],

            [

                [
                    "5",
                    "89 134",
                    "140 82",
                    "90 110",
                    "b88 90",
                    "112 106",
                ],
            ],

            [

                [
                    "5",
                    "89 134",
                    "140 82",
                    "90 110",
                    "88 90",
                    "z112 106",
                ],
            ],
        ];
    }

}
