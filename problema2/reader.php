<?php
require './Helpers/helpers_import.php';
$response = process_file();

require './template/header.php';

?>
  <h1 class="text-xl text-<?php echo ($response['status'] ? 'blue-900' : 'red-500'); ?> font-bold uppercase text-center">
    <?php echo ($response['status'] ? 'Proceso completado' : 'Datos erróneos'); ?>
  </h1>

  <div class="mt-5 p-4 rounded shadow border <?php echo ($response['status'] ? 'bg-green-200 text-green-600 border-green-500' : 'bg-red-200 text-red-500 border-red-500'); ?>">
    <?php echo $response['message']; ?>
  </div>

  <div class="mt-10 text-center">
        <a href="/" class="rounded-xl px-5 py-2 bg-<?php echo ($response['status'] ? 'green' : 'red'); ?>-400 text-white font-semibold">
          Subir otro archivo
        </a>
      </div>

<?php

/*
se crea un link de descarga del resultado, si no se produjo algún error
se genera un script, para ejecutar un click en el link de descarga
esto para evitar un re-direccionamiento o un click de parte del usuario
 */
if ($response['status']) {
    echo '<a id="download_success" href="./result/winner.txt" download class="hidden"></a>';
    echo '<script>
      const DS= document.querySelector(\'#download_success\');
      DS.click();
 </script>';
}

require './template/footer.php';
