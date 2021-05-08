<?php
declare (strict_types = 1);

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class GetErrorsFormatFileExceptionTest extends TestCase
{

    /**
     * @dataProvider additionProvider
     */
    public function test_getErrorsFormatFile_se_genera_un_exception_cuando_no_se_cumple_una_validacion($arr)
    {
        $this->expectException(Exception::class);

        $processor = new Processor;
        $processor->getErrorsFormatFile($arr);
    }

    public function additionProvider()
    {
        return [
            "linea 1, error indice 0 numero menor a 2"         => [[
                [1, 14, 38],
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN",
            ]],
            "linea 1, error indice 0 numero mayor a 50"        => [[
                [55, 14, 38],
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN",
            ]],

            "linea 1, error indice 1 numero menor a 2"         => [[
                [11, 1, 38],
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN",
            ]],
            "linea 1, error indice 1 numero mayor a 50"        => [[
                [11, 52, 38],
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN",
            ]],

            "linea 1, error indice 2 numero menor a 3"         => [[
                [11, 14, 2],
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN",
            ]],
            "linea 1, error indice 2 numero mayor a 5000"      => [[
                [11, 14, 5001],
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN",
            ]],

            "linea 2, error caracteres consecutivos repetidos" => [[
                [11, 14, 38],
                "CesseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN",
            ]],
            "linea 3, error caracteres consecutivos repetidos" => [[
                [11, 15, 38],
                "CeseAlFuego",
                "CorranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN",
            ]],

            "linea 4, error caracteres diferentes a a-zA-Z0-9" => [[
                [11, 15, 38],
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN#",
            ]],

        ];
    }
}
