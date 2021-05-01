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
    $result = result_message($data);
    create_txt($result);

    return generate_response("");
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
    $newMessage = clean_string($data[3]);
    $M1         = (strpos($newMessage, $data[1]) !== false) ? "Si\n" : "No\n";
    $M2         = (strpos($newMessage, $data[2]) !== false) ? "Si" : "No";

    return $M1 . $M2;
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
