<?php

/***
 * funciones que puedes ser usadas en otros archivos
 */

/**
 * genera un array para manejar las respuestas con un mismo estándar
 *
 * @param string $errors
 * @return array [string $status, string $message]
 */

function generate_response(string $errors): array
{
    return ["status" => ($errors === ""), "message" => $errors == "" ? "Archivo procesado correctamente" : $errors];

}
