<?php

/**
 * valida el archivo subido o si este existe
 * lo guarda en el servidor (para procesarlo)
 * convierte el archivo txt a un array
 * valida la estructura del documento
 * valida si los mensaje son correctos
 *
 * @return array
 */
function process_file(): array
{
    $path_messages = './';
    $response      = ["status" => false, "errors" => "Error al procesar el archivo"];

    if (isset($_FILES['file']) && $_FILES['file']['type'] === 'text/plain') {

        $file_uploaded = $path_messages . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $file_uploaded)) {

            $file = $path_messages . $_FILES['file']['name'];

            $data = txt_to_array($file);
            unlink($file);

            // return validate_data($data);
            $response = validate_data($data);

            if ($response["status"]) {

                return winner($data);
            }
        }
    }

    return $response;
}
