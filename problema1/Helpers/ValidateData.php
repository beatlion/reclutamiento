<?php

/**
 * validación de datos, que los números correspondan a las cadenas
 * de instrucciones con menajes
 *
 * @param array $data
 * @return bool
 */
function validate_data(array $data): bool
{
    if (!size_equal_array($data, 4)) {
        return false;
    }

    return validate_array_number($data);
}

/**
 * valida que el contenido de la primera posición del arreglo sean úmeros
 *
 * @param array $data
 * @return array
 */
function validate_array_number(array $data): bool
{
    $numbers = explode(" ", $data[0]);

    if (!size_equal_array($numbers, 3)) {
        return false;
    }

    foreach ($numbers as $key => $num) {
        if (!is_numeric($num)) {
            return false;
        } else {
            $numbers[$key] = (int) $num;
        }
    }

    return validate_max_size($data, $numbers);
}

/**
 * @param array $data
 * @param array $numArray
 * @return bool
 */
function validate_max_size(array $data, array $numbers)
{
    $M1 = $numbers[0] >= 2 || $numbers[0] <= 50;
    $M2 = $numbers[1] >= 2 || $numbers[1] <= 50;
    $N  = $numbers[2] >= 3 || $numbers[2] <= 5000;

    $ins1 = strlen($data[1]) == $numbers[0];
    $ins2 = strlen($data[2]) == $numbers[1];
    $msg  = strlen($data[3]) == $numbers[2];

    $validate_message = validate_string($data[3]);

    return ($M1 && $M2 && $N && $ins1 && $ins2 && $msg && $validate_message);
}

/**
 *@param string $message
 *@return bool
 */
function validate_string(string $message): bool
{
    return preg_match("/^[\w\d]+$/i", $message);
}

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
    $size = count($array);
    return $size == $equal;
}
