<?php
require './Helpers/helpers_import.php';

$response = process_file();

require './template/header.php';

$title = '<h1 class="text-xl text-' . ($response['status'] ? 'blue-900' : 'red-500') . ' font-bold uppercase text-center">
            ' . ($response['status'] ? 'Proceso completado' : 'Datos erróneos') . '
          </h1>';

$btnHome = '<div class="mt-10 text-center">
        <a href="/" class="rounded-xl px-5 py-2 bg-' . ($response['status'] ? 'green' : 'red') . '-400 text-white font-semibold">
          Subir otro archivo
        </a>
      </div>';
$errors = "<div class=\"" . ($response['status'] ? 'hidden' : 'bg-red-200 text-red-500 mt-5 p-4 rounded border border-red-500 ') . " \">
              {$response['errors']}
            </div>";

echo $title;
echo $errors;
echo $btnHome;

if ($response['status']) {
    echo '<a id="download_success" href="./result/winner.txt" download class="hidden"></a>';
    echo '<script>
      const DS= document.querySelector(\'#download_success\');
      DS.click();
 </script>';
}

require './template/footer.php';
