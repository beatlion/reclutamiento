<?php
declare (strict_types = 1);

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class DataLengthExceptionTest extends TestCase
{

    /**
     * @dataProvider additionProvider
     */
    public function test_dataLength_genera_exception_cuando_las_medidas_del_array_y_las_palabras_no_coinciden($arr)
    {
        $this->expectException(Exception::class);

        $processor = new Processor;
        $processor->dataLength($arr);
    }

    public function additionProvider()
    {
        return [

            "tamaño erroneo primer parámetro resp = 11"  => [[
                [10, 14, 52],
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooCoranACubiertoDLLKmmNNN",
            ]],

            "tamaño erroneo segundo parámetro resp = 14" => [[
                [11, 30, 52],
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooCoranACubiertoDLLKmmNNN",
            ]],

            "tamaño erroneo tercer parámetro resp = 52"  => [[
                [11, 14, 2],
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooCoranACubiertoDLLKmmNNN",
            ]],

        ];
    }
}
