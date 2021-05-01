<?php

/**
 *
 */
function winner(array $data): array
{

    $errors       = "";
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

            // echo "jugador $ganadorRound $diferenciaRound";

            $tablaVentaja["$ganadorRound-$diferenciaRound"] = $diferenciaRound;

        }
    }

    $winner = get_winner($tablaVentaja);

    generate_file($winner);

    return generate_response($errors);

}

function get_winner($tablaVentaja): string
{
    arsort($tablaVentaja);
    foreach ($tablaVentaja as $key => $value) {
        return str_replace('-', ' ', $key);

    }

}

function generate_file($winner)
{
    $file_respuesta = "./result/winner.txt";

    $fp = fopen($file_respuesta, "w");

    fputs($fp, $winner);

    fclose($fp);

    return true;

}
