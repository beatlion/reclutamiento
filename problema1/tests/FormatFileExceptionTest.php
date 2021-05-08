<?php
declare (strict_types = 1);

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class FormatFileExceptionTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function test_formatFile_genera_un_exception_si_el_array_recibido_no_tiene_un_de_tamaño_cuatro($arr)
    {
        $this->expectException(Exception::class);

        $processor = new Processor;
        $processor->formatFile($arr);
    }

    public function additionProvider()
    {
        return [

            "arreglo de un tamaño de 5 cuando debe de ser 4" => [[
                [10, 14, 52],
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooCoranACubiertoDLLKmmNNN",
                "otroCampo",
            ]],

            "arreglo de un tamaño de 3 cuando debe de ser 4" => [[
                [10, 14, 52],
                "CeseAlFuego",
                "CoranACubierto",
            ]],
        ];
    }
}
