<?php

/**
 * validación de datos, que los números correspondan a las cadenas
 * de instrucciones con los mensajes
 *
 * @param array $data
 * @return array [string $status, string $message]
 */
function validate_data(array &$data): array
{
    if (count($data) == 4) {

        $response = validar_instrucciones($data);

        if ($response["status"]) {
            if ($data[0][0] != strlen($data[1])) {
                $response = generate_response("Error en linea 2, la longitud no coincide");
            }

            if ($data[0][1] != strlen($data[2])) {
                $response = generate_response("Error en linea 3, la longitud no coincide");
            }

            if ($data[0][2] != strlen($data[3])) {
                $response = generate_response("Error en linea 4, la longitud no coincide");
            }
        }

        return $response;

    } else {

        return generate_response("Inconsistencia en los datos");
    }

}

/**
 * valida que las instrucciones sean 3, separadas po un espacio
 * comprueba que las instrucciones sean numéricas
 * valida que las instrucciones estén en el rango establecido
 * valida que el mensaje solo contenga letras y/o números
 *
 * @param array $data
 * @return array [string $status, string $message]
 */
function validar_instrucciones(array &$data): array
{
    $error  = "";
    $insArr = explode(" ", $data[0]);

    if (count($insArr) != 3) {
        $error = "Error en datos: linea 1, cantidad de parámetros es errónea";

    } else {
        foreach ($insArr as $key => $num) {

            if (is_numeric($num)) {
                $insArr[$key] = (int) $num;
            } else {
                $error = "Error en datos: linea 1, parametros no numéricos";
                break;
            }
        }

        if ($error == "") {
            $M1 = $insArr[0];
            $M2 = $insArr[1];
            $N  = $insArr[2];

            if ($M1 < 2) {
                $error = 'Error en datos: linea 1, la longitud de la instrucción 1 debe ser mayor a 2';

            } else if ($M1 > 50) {
                $error = 'Error en datos: linea 1, la longitud de la instrucción 1 debe ser menor a 50';

            } else if ($M2 < 2) {
                $error = 'Error en datos: linea 1, la longitud de la instrucción 2 debe ser mayor a 2';

            } else if ($M2 > 50) {
                $error = 'Error en datos: linea 1, la longitud de la instrucción 2 debe ser menor a 50';

            } else if ($N < 3) {
                $error = 'Error en datos: linea 1, la longitud del mensaje debe ser mayor a 3';

            } else if ($N > 5000) {
                $error = 'Error en datos: linea 1, la longitud de la instrucción 2 debe ser menor a 5000';

            } else {
                $error = preg_match("/^[\w\d]+$/i", $data[3])
                ? ""
                : "Error en datos: linea 4, formato de mensaje, solo debe contener letras y números";
            }

            $data[0] = $insArr;
        }

    }

    return generate_response($error);

}
