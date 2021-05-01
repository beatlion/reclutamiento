<?php

/**
 * valida la información del array recibido
 * comprueba que todos los campos contengan números
 *
 * @param array $data
 * @return array [string $status, string $message]
 */
function validate_data(array &$data): array
{
    $response = validate_array_number($data);

    if ($response['status']) {
        $response = validate_max_size($data);
    }

    return $response;
}

/**
 * valida que cada linea del archivo(index del array)
 * contengan 2 registros por linea, a excepción del primer registro
 * convierte cada linea de texto en un array de números
 *
 * @param array $data
 * @return array
 */
function validate_array_number(array &$data): array
{
    $errors = "";
    foreach ($data as $line => $text) {

        $numbers = explode(" ", $text);

        if (count($numbers) == 2) {
            foreach ($numbers as $key => $num) {
                if (is_numeric($num)) {
                    $numbers[$key] = (int) $num;
                } else {
                    $errors .= add_error($errors, $line, "no es un número");
                }
            }
        } else if ($line != 0) {
            $errors .= add_error($errors, $line, "numero de parámetros");
        }

        $data[$line] = $numbers;

    }

    return generate_response($errors);
}

/**
 * hace las validaciones correspondientes
 * valida que la información sea consistente
 * que el numero de registros este en el rango establecido (entre 1 y 10000)
 *
 * @param array $data
 * @return array [string $status, string $message]
 */
function validate_max_size(array $data): array
{
    $errors  = "";
    $arrSize = count($data) - 1;

    if ($arrSize != $data[0][0] || $data[0][0] <= 0 || $data[0][0] > 10000) {

        $errors = "El numero de registro proporcionado no es congruente con los datos, linea 1.";
    }

    return generate_response($errors);

}
