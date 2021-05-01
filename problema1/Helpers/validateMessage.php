<?php

function validate_message(array $data): bool
{
    $file_respuesta = "./messages/success.txt";
    $message        = clean_string($data[3]);

    $fp = fopen($file_respuesta, "w");

    fputs($fp, search_word_text($data[1], $message));
    fputs($fp, "\n" . search_word_text($data[2], $message));

    fclose($fp);

    return true;
}

function clean_string(string $message): string
{
    $arr_mess = str_split($message);

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

function search_word_text(string $word, string $text): string
{
    $pos = strpos($text, $word);

    return ($pos !== false) ? "Si" : "No";
}
