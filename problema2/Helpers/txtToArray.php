<?php

/**
 * obtiene los valores del archivo txt subido
 * y los retorna en un array
 *
 * @return array
 */
function txt_to_array(string $ruta): array
{
    $res = array();

    $fp = fopen($ruta, "r");

    while (!feof($fp)) {
        $linea = fgets($fp);
        $linea = trim($linea);

        if ($linea != "") {
            $res[] = $linea;
        }
    }

    fclose($fp);

    return $res;
}
