<?php

namespace sistema\Modelo;

use sistema\Nucleo\Conexao;
use sistema\Nucleo\Modelo;

/**
 * Class CategoriaModelo
 * 
 * @author Isaac Caraça <isaaccaracayahoo@gmail.com>
 */

class CategoriaModelo extends Modelo
{
    public function __construct()
    {
        parent::__construct('categorias');
    }

    // public function posts1(): ?array
    // {
    //     $busca = (new PostModelo())->busca("categoria_id = {$this->id}");
    //     return $busca->resultado(true);
    // }
    // public function busca(?string $termo = null):array
    // {
    //     $termo =  ($termo ? "WHERE {$termo}" : '');
    //     // $query = "SELECT * FROM posts WHERE status = 1 ORDER BY id DESC";
    //     $query = "SELECT * FROM categorias {$termo}";
    //     $stmt = Conexao::getInstancia()->query($query);
        
    //     $resultado = $stmt->fetchAll();
        
        
    //     return $resultado;
    // }
    // public function buscaporID(int $id):bool|object
    // {
    //     $query = "SELECT * FROM categorias WHERE id = {$id}";
    //     $stmt = Conexao::getInstancia()->query($query);
        
    //     $resultado = $stmt->fetch();
        
        
    //     return $resultado;
    // }
    public function posts(int $id):array
    {
        // $query = "SELECT * FROM posts WHERE status = 1 ORDER BY id DESC";
        $query = "SELECT * FROM posts WHERE categoria_id = {$id} AND status = 1 ORDER BY id DESC";
        $stmt = Conexao::getInstancia()->query($query);
        
        $resultado = $stmt->fetchAll();
        
        
        return $resultado;
    }
    // public function armazenar(array $dados):void
    // {
    //     // $query = "SELECT * FROM posts WHERE status = 1 ORDER BY id DESC";
    //     $query = "INSERT INTO `categorias` (`titulo`, `texto`, `status`) VALUES (?, ?, ?);";
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute([
    //         $dados['titulo'],
    //         $dados['texto'],
    //         $dados['status']
    //     ]);
    // }
    // public function atualizar(array $dados, int $id):void
    // {
    //     $query = "UPDATE categorias SET titulo = ?, texto = ?, status = ? WHERE id = ?";
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute([
    //         $dados['titulo'],
    //         $dados['texto'],
    //         $dados['status'],
    //         $id
    //     ]);
    // }
    // public function deletar(int $id):void
    // {
    //     $query = "DELETE FROM `categorias` WHERE id = {$id}";
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute();
    // }
    // public function total(?string $termo = null):int
    // {
    //     $termo =  ($termo ? "WHERE {$termo}" : '');
    //     $query = "SELECT * FROM categorias {$termo}";
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute();
    //     return $stmt->rowCount();
    // }
}


?>