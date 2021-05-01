<?php

/**
 * valida que se halla recibido el archivo
 * procesa el archivo
 * valida los datos
 * y manda a crear los resultados
 *
 * @return array [string $status, string $message]
 */
function process_file(): array
{
    $path_messages = './';
    $response      = generate_response("No se pudo leer el archivo.");

    if (isset($_FILES['file']) && $_FILES['file']['type'] === 'text/plain') {

        $file_uploaded = $path_messages . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $file_uploaded)) {

            $file     = $path_messages . $_FILES['file']['name'];
            $data     = txt_to_array($file);
            $response = validate_data($data);

            if ($response["status"]) {

                return winner($data);
            }

            unlink($file); //eliminamos el archivo creado
        }
    }

    return $response;
}
