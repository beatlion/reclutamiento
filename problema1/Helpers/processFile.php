<?php

/**
 * valida el archivo subido o si este existe
 * lo guarda en el servidor (para procesarlo)
 * convierte el archivo txt a un array
 * valida la estructura del documento
 * valida si los mensaje son correctos
 *
 * @return bool
 */
function process_file(): bool
{
    $path_messages = './messages/';

    if (isset($_FILES['file']) && $_FILES['file']['type'] === 'text/plain') {

        $file_uploaded = $path_messages . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $file_uploaded)) {

            $data = txt_to_array($path_messages . $_FILES['file']['name']);

            if (validate_data($data)) {

                return validate_message($data);
            }
        }
    }

    return false;
}
