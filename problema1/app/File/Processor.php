<?php
declare (strict_types = 1);

namespace App\File;

use App\Exception\ReadFileException;
use Exception;

class Processor extends FileOptions
{

    protected $data = [];
    /**
     * y se inicializan las variables de la clase FileOptions
     *
     * @param array $file
     */
    public function __construct()
    {
        $name           = time();
        $this->nameFile = "./$name.txt";
    }

    /**
     * Recibimos un array $_FILES
     *
     * @return array  [bool "status", string "message"]
     */
    public function process(array $file): array
    {
        $error = "";
        try {
            $this->file = $file; //se asigna el array recibido al la propiedad $file
            if ($this->existFile()) {
                $this->uploadFile();

                //pasamos el archivo subido a un array
                $this->data = $this->fileToArray();
                $this->deleteFile();

                $this->formatFile($this->data);

                $result = $this->generateMessage($this->data);

                $this->create_txt($result);

            } else {
                throw new ReadFileException;
            }
        } catch (\Exception $err) {
            $error = $err->getMessage();
        }

        return $this->getResponse($error);
    }

    /**
     * inicia las validaciones, tamaño de array =4
     * validaciones de instrucciones
     * verifica que el tamaños de los mensajes correspondan con las instrucciones
     * validaciones del archivo
     */
    public function formatFile(array $data): void
    {
        $tamañoArrayData = count($data);

        if ($tamañoArrayData === 4) {

            $this->instrucciones($data);
            $this->dataLength($this->data);

        } else {
            throw new Exception("El archivo debe de contener 4 lineas de datos");
        }

    }

    /**
     * verifica que los parametros sean correctos
     * fila1: que sean número y que sean 3 separados por espacio
     *
     * @param array $data
     */
    public function instrucciones(array $data): void
    {
        $instruccionesArray = explode(" ", $data[0]);

        if (count($instruccionesArray) != 3) {

            throw new Exception("Error en datos: linea 1, cantidad de parámetros es errónea");

        } else {

            $this->sonNumeros($instruccionesArray);
            $this->data[0] = $instruccionesArray;

            $this->getErrorsFormatFile($this->data);

        }
    }

    /**
     * valida los parámetros del archivo
     * fila2: no deben contener caracteres iguales consecutivos
     * fila3: no deben contener caracteres iguales consecutivos
     * fila4: debe ser conformado solo con números y letras a-zA-Z0-9
     *
     */
    public function getErrorsFormatFile(array $data): void
    {
        $error = "";
        $M1    = $data[0][0];
        $M2    = $data[0][1];
        $N     = $data[0][2];

        $instruccion1 = $data[1];
        $instruccion2 = $data[2];
        $message      = $data[3];

        if ($M1 < 2) {
            $error = 'Error en datos: linea 1, la longitud de la instrucción 1 debe ser mayor a 2';

        } else if ($M1 > 50) {
            $error = 'Error en datos: linea 1, la longitud de la instrucción 1 debe ser menor a 50';

        } else if ($M2 < 2) {
            $error = 'Error en datos: linea 1, la longitud de la instrucción 2 debe ser mayor a 2';

        } else if ($M2 > 50) {
            $error = 'Error en datos: linea 1, la longitud de la instrucción 2 debe ser menor a 50';

        } else if ($N < 3) {
            $error = 'Error en datos: linea 1, la longitud del mensaje debe ser mayor a 3';

        } else if ($N > 5000) {
            $error = 'Error en datos: linea 1, la longitud de la instrucción 2 debe ser menor a 5000';

        } else if ($this->letterRepeat($instruccion1)) {
            $error = 'Error en datos: linea 2, la instrucción contiene caracteres repetidos.';

        } else if ($this->letterRepeat($instruccion2)) {
            $error = 'Error en datos: linea 3, la instrucción contiene caracteres repetidos.';

        } else {
            $error = preg_match("/^[\w\d]+$/i", $message)
            ? ""
            : "Error en datos: linea 4, formato de mensaje, solo debe contener letras y números";
        }

        if ($error !== "") {
            throw new Exception($error);
        }
    }

    /**
     * recorre el array recibido y valida que los registros contenidos sean números
     * @param array $instruccionesArray
     */
    public function sonNumeros(array &$instruccionesArray): void
    {
        foreach ($instruccionesArray as $key => $num) {
            if (is_numeric($num)) {

                $instruccionesArray[$key] = (int) $num;

            } else {
                throw new Exception("Error en datos: linea 1, parámetros no numéricos");
            }
        }

    }

    /**
     * verifica si en un texto recibido existen caracteres consecutivos
     *
     * @param string $word
     * @return bool
     */
    public function letterRepeat(string $word): bool
    {
        $arrWord      = str_split($word);
        $repeatLetter = false;
        $prevLetter   = "";

        foreach ($arrWord as $letter) {
            $letterLower = strtolower($letter);
            if ($letterLower === $prevLetter) {
                $repeatLetter = true;
                break;
            }
            $prevLetter = $letterLower;
        }

        return $repeatLetter;
    }

    /**
     * valida que los parámetros recibidos (primer linea txt)
     * correspondan el tamaño de las palabras
     *
     * @param array $data
     */
    public function dataLength(array $data): void
    {
        $M1 = $data[0][0];
        $M2 = $data[0][1];
        $N  = $data[0][2];

        if ($M1 !== strlen($data[1])) {

            throw new Exception("Error en linea 2, la longitud no coincide");

        } else if ($M2 !== strlen($data[2])) {

            throw new Exception("Error en linea 3, la longitud no coincide");

        } else if ($N !== strlen($data[3])) {

            throw new Exception("Error en linea 4, la longitud no coincide");
        }

    }

    /**
     * manda a limpiar el mensaje
     * compara los posibles mensajes con el mensaje limpio
     * retorna un string con las respuestas
     *
     *@param array $data
     * @return string
     */
    public function generateMessage(array $data): string
    {
        $result     = "";
        $newM1      = $data[1];
        $newM2      = $data[2];
        $newMessage = $this->cleanString($data[3]);

        // busca los mensajes
        $M1 = (strpos($newMessage, $newM1) !== false) ? "Si" : "No";
        $M2 = (strpos($newMessage, $newM2) !== false) ? "Si" : "No";

        if ($M1 == 'Si' && $M2 == 'Si') {

            throw new Exception("Se obtuvieron dos posibles mensajes, por lo cual no se pudo obtener el mensaje.");

        } else {
            $result = "$M1\n$M2";
        }

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
    public function cleanString(string $message): string
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

}
