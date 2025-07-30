<?php

    require 'vendor/autoload.php';
    // require 'rotas.php'; 
    use sistema\biblioteca\Upload;

    $upload = new Upload("upload");
    $upload->arquivo('imagens'); 
    r($upload);
    var_dump($upload);

    if(!empty($arquivo = $_FILES)){
        // r($arquivo);
    }

    // $arquivo = $_FILES;
    // echo '<hr>';
    // echo $arquivo['arquivo']['name'];
    // var_dump($arquivo);
    // print_r($arquivo);
?>  
<form method="post" enctype="multipart/form-data">
    <input type="file" name="arquivo">
    <button>Enviar</button>
</form>