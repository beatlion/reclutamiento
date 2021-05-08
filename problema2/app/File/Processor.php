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

                $this->validateArrayNumber($this->data);

                $this->validateMaxSize($this->data);

                $winner = $this->getWinner($this->data);

                $this->create_txt($winner);

            } else {
                throw new ReadFileException;
            }

        } catch (Exception $err) {
            $error = $err->getMessage();

        }

        return $this->getResponse($error);

    }

    /**
     * valida que cada linea del archivo(index del array)
     * contengan 2 registros por linea, a excepción del primer registro
     * convierte cada linea de texto en un array de números
     *
     * @param array $data
     */
    public function validateArrayNumber(array $data): void
    {
        $errors  = "";
        $newData = array();

        foreach ($data as $line => $text) {

            $numbers = explode(" ", $text);

            if (count($numbers) === 2) {
                foreach ($numbers as $key => $num) {
                    if (is_numeric($num)) {
                        $numbers[$key] = (int) $num;
                    } else {
                        $errors .= $this->add_error($errors, $line, "no es un número");
                        throw new Exception("Error en la linea $line, debe de ser número");
                    }
                }
            } else if ($line === 0 && count($numbers) === 1) {
                if (is_numeric($numbers[0])) {
                    $numbers[0] = (int) $numbers[0];
                } else {
                    $errors .= $this->add_error($errors, $line, "no es un número");
                }

            } else if ($line !== 0) {
                $errors .= $this->add_error($errors, $line, "numero de parámetros");

            }

            $newData[] = $numbers;

        }

        if ($errors === "") {
            $this->data = $newData;
        } else {
            throw new Exception($errors);
        }

    }

    /**
     * hace las validaciones correspondientes
     * valida que la información sea consistente
     * que el numero de registros este en el rango establecido (entre 1 y 10000)
     *
     * @param array $data
     */
    public function validateMaxSize(array $data): void
    {
        $arrSize = count($data) - 1;

        if ($data[0][0] <= 0) {
            throw new Exception("El numero de registro proporcionado debe ser mayor a 0, linea 1.");

        } else if ($data[0][0] > 10000) {
            throw new Exception("El numero de registro proporcionado debe ser menor a 10000, linea 1.");

        } else if ($arrSize !== $data[0][0]) {
            throw new Exception("El numero de registro proporcionado no es congruente con los datos, linea 1.");
        }

    }

    /**
     * Se obtiene el ganador, siendo el que tiene mayor puntaje verificando
     * en cada round
     *
     * @param array $data
     * @return string
     */
    public function getWinner(array $data): string
    {
        $bigDif = 0;

        foreach ($data as $line => $arrRound) {

            if ($line != 0) {

                if ($arrRound[0] > $arrRound[1]) {
                    $ganadorRound    = 1;
                    $diferenciaRound = $arrRound[0] - $arrRound[1];

                } else {
                    $ganadorRound    = 2;
                    $diferenciaRound = $arrRound[1] - $arrRound[0];
                }

                if ($diferenciaRound > $bigDif) {
                    $bigDif = $diferenciaRound;
                    $winner = "$ganadorRound $diferenciaRound";
                }
            }
        }

        return $winner;
    }

}
