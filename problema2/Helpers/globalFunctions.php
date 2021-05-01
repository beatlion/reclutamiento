<?php

/**
 * valida si el tamaño del arreglo recibido
 * es el mismo que el numero recibido
 *
 * @param array $array
 * @param int $equal
 * @return bool
 */
function size_equal_array(array $array, Int $equal)
{
    return count($array) == $equal;
}

/**
 *
 */
function add_error(string $errors, int $line, string $error): string
{
    return (($errors === "") ? '' : '<br>') . 'linea ' . ($line + 1) . " ($error)";
}

/**
 * genera un arreglo para manejar las respuestas
 * @param string $errors
 * @return array
 */
function generate_response(string $errors): array
{
    return ["status" => ($errors === ""), "errors" => $errors];

}
