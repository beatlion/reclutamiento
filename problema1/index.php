<?php
require_once 'template/header.php';
?>

<form
  action="./reader.php"
  enctype="multipart/form-data"
  method="POST"
  class="w-full grid gap-3"
>
  <input type="hidden" name="MAX_FILE_SIZE" value="500" />

  <div class="font-bold text-xl mb-5 text-center text-blue-800 uppercase">
    Seleccione su archivo TXT
  </div>
  <label class="w-ful">
    <img
      src="./assets/files.svg"
      alt="file txt"
      class="w-16 h-16 mx-auto cursor-pointer filter drop-shadow-xl"
    />
    <input type="file" name="file" class="hidden" required accept="text/plain" />
  </label>
  <button
    type="submit"
    class="bg-blue-500 text-white py-2 rounded-lg mt-5 uppercase font-semibold"
  >
    enviar
  </button>
</form>

<?php
require_once 'template/footer.php';
