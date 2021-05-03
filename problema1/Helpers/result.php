<?php

/**
 * valida los mensajes
 * escribe un txt con las respuestas de las comparaciones
 *
 * @param array $data
 * @return array [string $status, string $message]
 */
function result(array $data): array
{
    $errors = "";
    $result = result_message($data);

    if ($result != "") {
        create_txt($result);

    } else {
        $errors = "Se recibieron dos posibles mensajes, por lo cual no se pudo identificar el mensaje correcto";
    }

    return generate_response($errors);
}

/**
 * manda a limpiar el mensaje
 * compara los posibles mensajes con el mensaje limpio
 * retorna un string con las respuestas
 *
 *@param array $data
 * @return string
 */
function result_message(array $data): string
{
    $newM1      = clean_string($data[1]);
    $newM2      = clean_string($data[2]);
    $newMessage = clean_string($data[3]);

    $M1 = (strpos($newMessage, $newM1) !== false) ? "Si" : "No";
    $M2 = (strpos($newMessage, $newM2) !== false) ? "Si" : "No";

    $result = ($M1 == 'Si' && $M2 == 'Si') ? "" : "$M1\n$M2";

    return $result;
}

/**
 * limpia el texto recorriendo letra por letra
 * genera un nuevo string sin letras repetidas consecutivas
 * retorna el nuevo mensaje
 *
 * @param string
 * @return string
 */
function clean_string(string $message): string
{
    $arr_mess   = str_split($message);
    $anterior   = "";
    $newMessage = "";

    foreach ($arr_mess as $letra) {
        $letra_min = strtolower($letra);

        if ($letra_min != $anterior) {
            $newMessage .= $letra;
        }

        $anterior = $letra_min;
    }

    return $newMessage;

}

/**
 * crea un archivo txt con los resudados que recibe
 *
 * @param string
 */
function create_txt(string $results): void
{
    $file_respuesta = "./result.txt";

    $fp = fopen($file_respuesta, "w");

    fputs($fp, $results);
    fclose($fp);

}
