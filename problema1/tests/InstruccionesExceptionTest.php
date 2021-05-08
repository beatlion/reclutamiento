<?php
declare (strict_types = 1);

use App\File\Processor;
use PHPUnit\Framework\TestCase;

class InstruccionesExceptionTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function test_instrucciones_genera_un_exception_si_la_cadena_recibida_no_genera_un_array_de_tamaño_tres($arr)
    {
        $this->expectException(Exception::class);

        $processor = new Processor;
        $processor->instrucciones($arr);
    }

    public function additionProvider()
    {
        return [
            [["10"]],
            [["10 5"]],
            [["10 5 10 15"]],
        ];
    }
}
