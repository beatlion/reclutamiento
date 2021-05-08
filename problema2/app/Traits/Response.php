<?php
declare (strict_types = 1);

namespace App\Traits;

trait Response
{
    /**
     * genera un array para manejar las respuestas con un mismo estándar
     *
     * @param string $errors
     * @return array [string $status, string $message]
     */

    public function getResponse(string $errors): array
    {
        $status = ($errors === "");
        $message = $errors === "" ? "Archivo procesado correctamente" : $errors;

        return ["status" => $status, "message" => $message];
    }

    /**
     * agrega saltos de linea a los errores recibidos
     *
     *@param string $errors
     *@param int $line
     *@param string $error
     */
    public function add_error(string $errors, int $line, string $error): string
    {
        return (($errors === "") ? '' : '<br>') . 'linea ' . ($line + 1) . " ($error)";
    }

}
