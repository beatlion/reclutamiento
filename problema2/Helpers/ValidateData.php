<?php

/**
 * validación de datos, que los números correspondan a las cadenas
 * de instrucciones con menajes
 *
 * @param array $data
 * @return bool
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
 *
 *
 * @param array $data
 * @return array
 */
function validate_array_number(array &$data): array
{
    $errors = "";
    foreach ($data as $line => $text) {

        $numbers = explode(" ", $text);

        if (size_equal_array($numbers, 2)) {
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
 * @param array $data
 * @return array
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

/**
 *@param string $message
 *@return bool
 */
function validate_string(string $message): bool
{
    return preg_match("/^[\w\d]+$/i", $message);
}
