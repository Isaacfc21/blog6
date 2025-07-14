<?php
    //Aula 076

    // require 'vendor/autoload.php';

    // $dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

    // if(isset($dados)){
    //     echo $dados['nome']."<hr>";
    //     echo $dados['senha']."<hr>";
    // }
    // echo $_GET['nome']."<hr>";
    // echo $_GET['senha'];

    // echo $_POST['nome']."<hr>";
    // echo $_POST['senha'];

    //Conteúdo
?>

<!-- <form action="" method="get">
    <input type="text" name="nome"><br><br>
    <input type="text" name="senha"><br><br>
    <input type="submit">
</form> -->

<?php
    //Aula 077-079

    // require 'vendor/autoload.php';
    // require 'rotas.php';

    //Conteúdo
?>
<?php
    //Aula 080-089

    // require 'vendor/autoload.php';
    // require 'rotas.php';
    //Conteúdo
?>
<?php
    //Aula 090

    // require 'vendor/autoload.php';
    // // require 'rotas.php';

    // session_start();
    // echo session_id();
    // echo '<hr>';

    // $_SESSION['nome'] = 'Isaac Caraça';
    // // $_SESSION['visitas'] = 0;

    // if (isset($_SESSION['visitas'])) {
    //     $_SESSION['visitas']++;
    // } else {
    //     $_SESSION['visitas'] = 1;
    // }
    // // unset($_SESSION['visitas']);
    // session_destroy();

    
    // echo ($_SESSION['visitas'] == 1 ? 
    //     "{$_SESSION['nome']} visitou {$_SESSION['visitas']} vez esta página.<br>" : 
    //     "{$_SESSION['nome']} visitou {$_SESSION['visitas']} vezes esta página.<br>");

    //Conteúdo
?>
<?php
    //Aula 091

    // require 'vendor/autoload.php';
    // // require 'rotas.php';
    // $sessao = new sistema\Nucleo\Sessao();

    // // $sessao->criar('usuario', [
    // //     'id' => 10,
    // //     'nome' => 'Isaac Caraça'
    // // ]);

    // // $sessao->criar('nome', 'Isaac Caraça');

    // var_dump($sessao->carregar());
    // echo '<hr>';
    // // var_dump($sessao->carregar()->usuario->id);
    // // echo '<hr>';
    // // var_dump($sessao->carregar()->usuario->nome);
    // // echo '<hr>';
    // var_dump($sessao->checar('nome'));
    // // echo '<hr>';
    // // $sessao->limpar('usuario');
    // echo '<hr>';
    // $sessao->deletar();
    // var_dump($sessao->checar('usuario'));
    
    //Conteúdo
?>
<?php
    //Aula 092-094

    // require 'vendor/autoload.php';
    // require 'rotas.php';

    //Conteúdo
?>


<?php
    //Aula 095

    // require 'vendor/autoload.php';
    // // require 'rotas.php';

    // $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // var_dump($dados);
    // echo '<hr>';

    // $colunas = implode(', ', array_keys($dados));
    // var_dump($colunas);
    // echo '<hr>';

    // $valores = ':'.implode(', :', array_keys($dados));
    // var_dump($valores);
    // echo '<hr>';

    // $query  = 'INSERT INTO `posts` ('.$colunas.') VALUES ('.$valores.');';
    // var_dump($query);
    // echo '<hr>';

    //Conteúdo
?>
<!-- INSERT INTO `categorias` (`id`, `titulo`, `texto`, `status`) VALUES (NULL, 'teste', 'teste', '1'); -->
<?php
    //Aula 096

    // require 'vendor/autoload.php';
    // // require 'rotas.php';

    // $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // var_dump($dados);
    // echo '<hr>';

    // // $colunas = implode(', ', array_keys($dados));
    // // var_dump($colunas);
    // // echo '<hr>';

    // // $valores = ':'.implode(', :', array_keys($dados));
    // // var_dump($valores);
    // // echo '<hr>';

    // $set = [];

    // foreach($dados as $chave => $valor){
    //     $set[] = "{$chave} = :{$valor}";
    //     var_dump($set);
    //     echo '<hr>';
    // }

    // $set = implode(", ", $set);
    // var_dump($set);
    // echo '<hr>';
    // $query  = "UPDATE `categorias` SET ($set) WHERE id = 7;";
    // var_dump($query); 

    // $query  = 'INSERT INTO `posts` ('.$colunas.') VALUES ('.$valores.');';
    // var_dump($query);
    // echo '<hr>';

    //Conteúdo
?>
<?php
    //Aula 097-099

    // require 'vendor/autoload.php';
    // require 'rotas.php';

    //Conteúdo
?>