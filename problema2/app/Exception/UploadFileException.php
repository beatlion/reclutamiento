<?php
declare (strict_types = 1);

namespace App\Exception;

use Exception;

class uploadFileException extends Exception
{

    public function errorMessage(): string
    {
        return "Error al subir archivo";
    }
}
