<?php
declare (strict_types = 1);

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class LetterRepeatTest extends TestCase
{

    /**
     * @dataProvider additionProvider
     */
    public function test_letterRepeat_verifica_si_encuentra_letras_repetidas_en_la_palabra_recibida($arr)
    {
        $processor = new Processor;
        $clean     = $processor->letterRepeat($arr["palabra"]);

        $this->assertSame($arr["respuesta"], $clean);

    }

    public function additionProvider()
    {
        return [
            [["respuesta" => true, "palabra" => "hoola"]],
            [["respuesta" => false, "palabra" => "hola"]],
        ];
    }
}
