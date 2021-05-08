<?php

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class ArrayAllNumberTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function test_validateMaxSize_valida_que_el_primer_parametro_sea_mayor_0_menor_10000_mismo_tamaño_array_sin_contarse_debe_generar_Exeption($arr)
    {
        $this->expectException(Exception::class);

        $processor = new Processor;
        $processor->validateMaxSize($arr);

    }

    public function additionProvider()
    {
        return [
            "el cero no debe ser valido, correcto > 0"            => [
                [
                    [0],
                ],
            ],

            "10001 no debe ser correcto, valido menor a 10001"    => [
                [
                    [10001],
                    [140, 82],
                ],
            ],

            "tamaño de array diferente al parametro 6 debe ser 5" => [
                [
                    [6],
                    [140, 82],
                    [89, 134],
                    [90, 110],
                    [112, 106],
                    [88, 90],
                ],
            ],

        ];
    }

}
