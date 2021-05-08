<?php
declare (strict_types = 1);

namespace App\Traits;

trait Response
{
    public function getResponse(string $errors): array
    {
        $status = ($errors === "");
        $message = $errors === "" ? "Archivo procesado correctamente" : $errors;

        return ["status" => $status, "message" => $message];
    }
}
