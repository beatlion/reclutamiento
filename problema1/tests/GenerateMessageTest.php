<?php
declare (strict_types = 1);

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class GenerateMessageTest extends TestCase
{

    /**
     * @dataProvider additionProvider
     */
    public function test_generateMessage_genera_un_mensaje_con_el_array_recibido($arr)
    {
        $processor = new Processor;
        $clean     = $processor->generateMessage($arr["data"]);

        $this->assertSame($arr["respuesta"], $clean);

    }

    public function additionProvider()
    {
        return [
            [["respuesta" => "Si\nNo", "data" => [
                "11 14 38",
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN",
            ]]],

            [["respuesta" => "No\nSi", "data" => [
                "13 15 40",
                "CorranACubierto",
                "CeseAlFuegoYa",
                "XXcaaamakkCCessseAAllFueeegooYaaaDLLKmmNNN",
            ]]],

            [["respuesta" => "No\nNo", "data" => [
                "13 15 38",
                "CeseAlFuegoYa",
                "CorranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN",
            ]]],
        ];
    }
}
