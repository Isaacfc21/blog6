<?php

namespace sistema\Controlador\Admin;
use sistema\Modelo\CategoriaModelo;
use sistema\Modelo\PostModelo;
use sistema\Nucleo\Helpers_c;

/**
 * Class AdminCategorias
 * 
 * @author Isaac Caraça <isaaccaracayahoo@gmail.com>
 */

class AdminCategorias extends AdminControlador
{
    public function listar():void
    {
        $categoria = new categoriaModelo();
        $categoriaAtiva = new CategoriaModelo();
        $categoriaInativa = new CategoriaModelo();

        echo $this->template->renderizar('posts/categoria.html', [
            'categorias' => $categoria->busca()->ordem('titulo ASC')->resultado(true),
            'total' => [
                'total' => $categoria->total(), 
                'ativo' => $categoriaAtiva->busca('status = 1')->total(), 
                'inativo' => $categoriaInativa->busca('status = 0')->total()
            ]
        ]);
    }
    public function cadastrar():void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(isset($dados)){
            if($this->validarDados($dados)){
                $categoria  = new CategoriaModelo();

                $categoria->titulo = $dados['titulo'];
                $categoria->slug = Helpers_c::slug($dados['titulo']);
                $categoria->texto = $dados['texto'];
                $categoria->status = $dados['status'];
                $categoria->cadastrado_em = date('Y-m-d H:i:s');

                if($categoria->salvar()){
                    $this->mensagem->sucesso('Categoria cadastrada com sucesso!')->flash();
                    Helpers_c::redirecionar('blog/admin/categorias/listar');
                }else{
                    $this->mensagem->alerta('Falha ao cadastrar a categoria!')->flash();
                    // $this->mensagem->alerta($categoria->erro())->flash();
                    Helpers_c::redirecionar('blog/admin/categorias/listar');
                }
            }
        }
        
        echo $this->template->renderizar('posts/formulario_c.html', [
            'categoria' => $dados
        ]);
    }
    public function editar(int $id): void
    {

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $categoria = (new CategoriaModelo())->buscaPorId($id);

        if (!empty($dados)) {
            if($this->validarDados($dados)){

                $categoria->titulo = $dados['titulo'];
                $categoria->texto = $dados['texto'];
                $categoria->status = $dados['status'];
                $categoria->atualizado_em = date('Y-m-d H:i:s');

                if ($categoria->salvar()) {
                    $this->mensagem->sucesso('Categoria atualizada com sucesso!')->flash();
                    Helpers_c::redirecionar('blog/admin/categorias/listar');
                    exit;
                } else {
                    $this->mensagem->alerta('Falha ao atualizar a categoria!')->flash();
                    Helpers_c::redirecionar('blog/admin/categorias/listar');
                    exit;
                }
            }
        }

        echo $this->template->renderizar('posts/formulario_c.html', [
            'categoria' => $categoria,
            'categorias' => (new CategoriaModelo())->busca()->resultado(true),
        ]);
    }

    private function validarDados(array $dados):bool
    {
        if(empty($dados['titulo'])){
            $this->mensagem->alerta('O campo título é obrigatório!')->flash();
            return false;
        }
        return true;
    }

    public function deletar(int $id): void
    {
        if (is_int($id)) {
            $categoria = (new CategoriaModelo())->buscaPorId($id);
            $posts = (new \sistema\Modelo\PostModelo())->busca("categoria_id = ($categoria->id)")->resultado(true);

            if (!$categoria) {
                $this->mensagem->alerta('Categoria não encontrada!')->flash();
                Helpers_c::redirecionar('blog/admin/categorias/listar');
                return;
            }
            elseif($posts){
                $this->mensagem->alerta("a categoria {$categoria->titulo} tem posts cadastrados, delete ou altere os posts antes de deletar essa categoria")->flash();
                Helpers_c::redirecionar("blog/admin/categorias/listar");
            }
            // elseif($categoria->posts1()){
            //     $this->mensagem->alerta("a categoria {$categoria->titulo} tem posts cadastrados, delete ou altere os posts antes de deletar essa categoria")->flash();
            //     Helpers_c::redirecionar("blog/admin/categorias/listar");
            // }

            if ($categoria->apagar("id = {$id}")) {
                $this->mensagem->sucesso('Categoria deletada com sucesso!')->flash();
            } else {
                $this->mensagem->erro($categoria->erro())->flash();
            }

            Helpers_c::redirecionar('blog/admin/categorias/listar');
        }
    }

}


?>