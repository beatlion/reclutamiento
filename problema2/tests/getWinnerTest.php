<?php

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class getWinnerTest extends TestCase
{

    /**
     * @dataProvider additionProvider
     */
    public function test_getWinner_debe_generar_respuestas_correctas($arr)
    {
        // $this->expectException(Exception::class);

        $processor = new Processor;
        $winner    = $processor->getWinner($arr["data"]);

        $this->assertSame($arr["respuesta"], $winner);

    }

    public function additionProvider()
    {
        return [
            [[
                "respuesta" => "1 58",
                "data"      => [
                    [5],
                    [140, 82],
                    [89, 134],
                    [90, 110],
                    [112, 106],
                    [88, 90],
                ],
            ]],
            [[
                "respuesta" => "1 58",
                "data"      => [
                    [5],
                    [140, 82],
                    [229, 216],
                    [319, 326],
                    [431, 432],
                    [519, 522],
                ],
            ]],
            [[
                "respuesta" => "2 138",
                "data"      => [
                    [3],
                    [150, 48],
                    [301, 224],
                    [22, 160],
                ],
            ]],
            [[
                "respuesta" => "2 138",
                "data"      => [
                    [4],
                    [150, 48],
                    [301, 224],
                    [22, 160],
                    [160, 22],
                ],
            ]],

        ];
    }

}
