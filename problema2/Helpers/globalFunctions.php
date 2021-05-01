<?php

/***
 * funciones que puedes ser usadas en otros archivos
 */

/**
 * agrega saltos de linea a los errores recibidos
 *
 *@param string $errors
 *@param int $line
 *@param string $error
 */
function add_error(string $errors, int $line, string $error): string
{
    return (($errors === "") ? '' : '<br>') . 'linea ' . ($line + 1) . " ($error)";
}

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
