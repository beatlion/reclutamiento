<?php
require './Helpers/helpers_import.php';

$complete = process_file();

require './template/header.php';

$title = '<h1 class="text-xl text-' . ($complete ? 'blue-900' : 'red-500') . ' font-bold uppercase text-center">
            ' . ($complete ? 'Proceso completado' : 'Datos erróneos') . '
          </h1>';

$btnHome = '<div class="mt-10 text-center">
        <a href="/" class="rounded-xl px-5 py-2 bg-' . ($complete ? 'green' : 'red') . '-400 text-white font-semibold">
          Subir otro archivo
        </a>
      </div>';

echo $title;

if ($complete) {
    echo '<a id="download_success" href="./messages/success.txt" download class="hidden"></a>';
    echo '<script>
      const DS= document.querySelector(\'#download_success\');
      DS.click();
 </script>';
}
echo $btnHome;

require './template/footer.php';
