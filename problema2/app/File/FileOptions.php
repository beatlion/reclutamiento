<?php
declare (strict_types = 1);

namespace App\File;

use App\Exception\uploadFileException;
use App\Traits\Response;

class FileOptions
{
    use Response;
    protected $file     = array();
    protected $nameFile = "";

    /**
     * sube el archivo inivializado en el constructor
     * @return array [bool "status", string "message"]
     */
    protected function uploadFile(): void
    {
        $upFile = move_uploaded_file($this->file['file']['tmp_name'], $this->nameFile);
        if (!$upFile) {
            throw new uploadFileException;
        }

    }

    /**
     * procesa el archivo subido6
     * @return array [bool "status", string "message"]
     */
    protected function fileToArray(): array
    {
        $result = array();
        $fp     = fopen($this->nameFile, "r");

        while (!feof($fp)) { //recorre linea por linea del txt
            $linea = fgets($fp);
            $linea = trim($linea);

            if ($linea != "") { //ignora lineas vaciás
                $result[] = $linea;
            }
        }

        fclose($fp);

        return $result;
    }

    /**
     * verifica que se halla recibido el archivo
     * y que el archivo sea un .txt
     *
     * @return bool
     */
    protected function existFile(): bool
    {
        $response = (isset($this->file['file']) && $this->file['file']['type'] === 'text/plain');

        return $response;
    }

    /**
     * elimina el archivo
     */
    protected function deleteFile(): void
    {
        if ($this->nameFile !== "") {
            unlink($this->nameFile);
        }

    }

    /**
     * crea un archivo txt con el contenido que recibe
     *
     * @param string
     */
    public function create_txt(string $contenido): void
    {
        $file_respuesta = "./result.txt";

        $fp = fopen($file_respuesta, "w");

        fputs($fp, $contenido);
        fclose($fp);
    }

}
