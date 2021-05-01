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
    $fp  = fopen($ruta, "r");

    while (!feof($fp)) { //recorre linea por linea del txt
        $linea = fgets($fp);
        $linea = trim($linea);

        if ($linea != "") { //ignora lineas vaciás
            $res[] = $linea;
        }
    }

    fclose($fp);

    return $res;
}
