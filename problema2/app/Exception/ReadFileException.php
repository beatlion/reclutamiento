<?php
declare (strict_types = 1);

namespace App\Exception;

use Exception;

class ReadFileException extends Exception
{

    public function __construct()
    {
        $this->message = "No se pudo leer el archivo.";
    }
}
