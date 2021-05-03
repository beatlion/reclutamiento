<?php

/**
 * se obtiene al ganador y se genera un txt con el resultado
 *
 * @param array $data
 * @return [string $status, string $message]
 */
function winner(array $data): array
{
    $errors       = "";
    $tablaVentaja = generate_tabla_ventajas($data);
    $winner       = get_winner($tablaVentaja);

    generate_file($winner);

    return generate_response($errors);

}

/**
 * recorre el array recibido comparando las diferencias de cada round
 * llena un nuevo arreglo con la información de cada round
 * cada index del array se conforma con ganador del round - diferencia del round
 * y como value la diferencia del round
 *
 * @param array $data
 * @return array
 */
function generate_tabla_ventajas(array $data): array
{
    $tablaVentaja = array();

    foreach ($data as $line => $arrRound) {
        if ($line != 0) {

            if ($arrRound[0] > $arrRound[1]) {
                $ganadorRound    = 1;
                $diferenciaRound = $arrRound[0] - $arrRound[1];

            } else {
                $ganadorRound    = 2;
                $diferenciaRound = $arrRound[1] - $arrRound[0];
            }

            $tablaVentaja["$ganadorRound-$diferenciaRound"] = $diferenciaRound;
        }
    }

    return $tablaVentaja;

}

/**
 * ordena el array de mayor a menor
 * se obtiene el primer registro del array (asumiendo que es el mas alto)
 * se retorna un string con el valor del jugador y la ventaja
 *
 * @param array $tablaVentaja
 * @return string
 */
function get_winner(array $tablaVentaja): string
{

    $resp    = "No se pudo obtener un ganador";
    $arrTemp = quitarEmpates($tablaVentaja);
    arsort($arrTemp);

    foreach ($arrTemp as $key => $value) {
        $resp = str_replace("-", " ", $key);
        break;
    }

    return $resp;
}

function quitarEmpates($arr): array
{
    $arrEmpates = [];
    //identificando los empates
    foreach ($arr as $key => $value) {
        foreach ($arr as $key2 => $value2) {
            if ($key != $key2 && $value == $value2) {
                $arrEmpates[] = $value;
            }
        }
    }

    //elimina los repetidos en los empates
    $arrEmpates = array_unique($arrEmpates);

    if (count($arrEmpates) > 0) {
        $arraySinEmpates = [];

        //genera un nuevo array sin los empates
        foreach ($arrEmpates as $value) {
            foreach ($arr as $key => $value2) {
                if ($value != $value2) {
                    $arraySinEmpates[$key] = $value2;
                }
            }
        }

        return $arraySinEmpates;

    } else {
        return $arr;
    }

}

/**
 * crea el txt con la informacion recibida
 *
 * @param string $winner
 */
function generate_file(string $winner): void
{
    $file_respuesta = "./result/winner.txt";
    $fp             = fopen($file_respuesta, "w");

    fputs($fp, $winner);
    fclose($fp);

}
