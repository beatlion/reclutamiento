<?php
declare (strict_types = 1);

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class CleanStringTest extends TestCase
{

    /**
     * @dataProvider additionProvider
     */
    public function test_cleanString_valida_que_limpie_una_string_con_caracteres_repetidos($arr)
    {
        $processor = new Processor;
        $clean     = $processor->cleanString($arr["palabra"]);

        $this->assertSame($arr["respuesta"], $clean);

    }

    public function additionProvider()
    {
        return [
            [["respuesta" => "kijsadbjqwnsadw", "palabra" => "kijsadbjqwnsssadw"]],
            [["respuesta" => "EstaPalabraEsValida", "palabra" => "EstaaPPalabrrraEsValidaaa"]],
            [["respuesta" => "OtraPrueba", "palabra" => "OttrraaPruuuuebbbba"]],
        ];
    }
}
