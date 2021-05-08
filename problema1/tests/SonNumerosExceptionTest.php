<?php
declare (strict_types = 1);

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class SonNumerosExceptionTest extends TestCase
{

    /**
     * @dataProvider additionProvider
     */
    public function test_sonNumeros_se_genera_un_exception_si_el_arrey_recibido_contiene_caracteres_no_numericos($arr)
    {
        $this->expectException(Exception::class);

        $processor = new Processor;
        $processor->sonNumeros($arr);
    }

    public function additionProvider()
    {
        return [
            [[1, 2, 3, 4, 5, "k"]],
            [["1", "54", "8", "2", "6", "98as"]],
            [["1", "54", "8c", "2", "6", "98"]],
            [["k", "54", "8", "2", "6", "98"]],
        ];
    }
}
