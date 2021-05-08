<?php
declare (strict_types = 1);

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class GenerateMessageExceptionTest extends TestCase
{

    /**
     * @dataProvider additionProvider
     */
    public function test_generateMessage_genera_un_exception_al_recibir_dos_mensajes_en_el_mismo_texto_encriptado($arr)
    {
        $this->expectException(Exception::class);

        $processor = new Processor;
        $processor->generateMessage($arr);
    }

    public function additionProvider()
    {
        return [
            [[
                "11 14 52",
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooCoranACubiertoDLLKmmNNN",
            ]],

            [[
                "12 14 79",
                "PrimeMensaje",
                "SegundoMensaje",
                "XXcaPpprimeeeeMmmmensajjjeSeeeggguundddoMennnnsaaajeeeLKmmNNN",
            ]],

        ];
    }
}
