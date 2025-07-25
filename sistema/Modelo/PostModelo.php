<?php

namespace sistema\Modelo;

use sistema\Nucleo\Conexao;
use sistema\Nucleo\Modelo;
/**
 * Class PostModelo
 * 
 * @author Isaac Caraça <isaaccaracayahoo@gmail.com>
 */

class PostModelo extends Modelo
{
    public function __construct()
    {
        parent::__construct('posts');
    }
    public function categoria(): ?CategoriaModelo
    {
        if($this->categoria_id){
            return (new CategoriaModelo())->buscaporID($this->categoria_id);
        }

        return null;
    }
    public function usuario(): ?UsuarioModelo
    {
        if($this->usuario_id){
            return (new UsuarioModelo())->buscaporID($this->usuario_id);
        }

        return null;
    }
    public function salvar(): bool
    {
        $this->slug();
        return parent::salvar();
    }
    // public function busca(?string $termo = null, ?string $ordem = null):array
    // {
    //     $termo =  ($termo ? "WHERE {$termo}" : '');
    //     $ordem =  ($ordem ? "ORDER BY {$ordem}" : '');
    //     // $query = "SELECT * FROM posts WHERE status = 1 ORDER BY id DESC";
    //     $query = "SELECT * FROM posts {$termo} {$ordem}";
    //     $stmt = Conexao::getInstancia()->query($query);
        
    //     $resultado = $stmt->fetchAll();
        
        
    //     return $resultado;
    // }
    // public function buscaporID(int $id):bool|object
    // {
    //     $query = "SELECT * FROM posts WHERE id = {$id}";
    //     $stmt = Conexao::getInstancia()->query($query);
        
    //     $resultado = $stmt->fetch();
        
    //     return $resultado;
    // }
    // public function pesquisa(string $busca):array
    // {
    //     // $query = "SELECT * FROM posts WHERE status = 1 ORDER BY id DESC";
    //     $query = "SELECT * FROM posts WHERE status = 1  AND titulo LIKE '%{$busca}%'";
    //     $stmt = Conexao::getInstancia()->query($query);
        
    //     $resultado = $stmt->fetchAll();
        
        
    //     return $resultado;
    // }
    // public function armazenar(array $dados):void
    // {
    //     $query = "INSERT INTO `posts` (`categoria_id`, `titulo`, `texto`, `status`) VALUES (:categoria_id, :titulo, :texto, :status);";
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute($dados);
    // }

    // public function atualizar(array $dados, int $id):void
    // {
    //     $query = "UPDATE posts SET categoria_id = :categoria_id, titulo = :titulo, texto = :texto, status = :status WHERE id = {$id}";
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute($dados);
    // }
    // public function deletar(int $id):void
    // {
    //     $query = "DELETE FROM `posts` WHERE id = {$id}";
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute();
    // }
    // public function total(?string $termo = null):int
    // {
    //     $termo =  ($termo ? "WHERE {$termo}" : '');
    //     $query = "SELECT * FROM posts {$termo}";
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute();
    //     return $stmt->rowCount();
    // }
}

// $query = "SELECT * FROM posts WHERE id = 3 AND status = 1 OR status = 0";
// $query = "SELECT * FROM posts LIMIT 2 OFFSET 2";
// $query = "SELECT * FROM posts WHERE titulo = 'titulo do post' ";
// var_dump($resultado);
?>