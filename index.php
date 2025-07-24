<?php

    require 'vendor/autoload.php';
    // require 'rotas.php'; 

    $arquivo = $_FILES;
    r($arquivo);
    echo '<hr>';
    echo $arquivo['arquivo']['name'];
    // var_dump($arquivo);
    // print_r($arquivo);
?>  
<form method="post" enctype="multipart/form-data">
    <input type="file" name="arquivo">
    <button>Enviar</button>
</form>