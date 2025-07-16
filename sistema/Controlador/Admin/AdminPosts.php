<?php

namespace sistema\Controlador\Admin;
use sistema\Modelo\PostModelo;
use sistema\Modelo\CategoriaModelo;
use sistema\Nucleo\Helpers_c;

/**
 * Class AdminPosts
 * 
 * @author Isaac Caraça <isaaccaracayahoo@gmail.com>
 */

class AdminPosts extends AdminControlador
{
    public function listar():void
    {
        $post = new PostModelo();
        $postAtivo = new PostModelo();
        $postInativo = new PostModelo();

        echo $this->template->renderizar('posts/listar.html', [
            'posts' => $post->busca()->ordem('status DESC, id DESC')->resultado(true),
            'total' => [
                'total' => $post->total(),
                'ativo' => $postAtivo->busca('status = 1')->total(), 
                'inativo' => $postInativo->busca('status = 0')->total()
            ]
        ]);
    }

    public function cadastrar():void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(isset($dados)){
            if($this->validarDados($dados)){
                $post  = new PostModelo();

                $post->titulo = $dados['titulo'];
                $post->categoria_id = $dados['categoria_id'];
                $post->slug = Helpers_c::slug($dados['titulo']);
                $post->texto = $dados['texto'];
                $post->status = $dados['status'];
                $post->cadastrado_em = date('Y-m-d H:i:s');

                if($post->salvar()){
                    $this->mensagem->sucesso('Post cadastrado com sucesso!')->flash();
                    Helpers_c::redirecionar('blog/admin/posts/listar');
                } else {
                    $this->mensagem->alerta('Falha ao cadastrar o post!')->flash();
                    Helpers_c::redirecionar('blog/admin/posts/listar');
                }
            }
        }

        echo $this->template->renderizar('posts/formulario_p.html', [
            'categorias' => (new CategoriaModelo())->busca()->resultado(true),
        ]);
    }
    public function editar( int $id):void
    {
        $post = (new PostModelo())->buscaPorId($id);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(isset($dados)){
            if($this->validarDados($dados)){
                $post  = (new PostModelo())->buscaPorId($id);

                $post->titulo = $dados['titulo'];
                $post->categoria_id = $dados['categoria_id'];
                $post->texto = $dados['texto'];
                $post->status = $dados['status'];
                $post->atualizado_em = date('Y-m-d H:i:s');

                if($post->salvar()){
                    $this->mensagem->sucesso('Post atualizado com sucesso!')->flash();
                    Helpers_c::redirecionar('blog/admin/posts/listar');
                }else{
                    $this->mensagem->alerta('Falha ao atualizar o post!')->flash();
                    // $this->mensagem->alerta($categoria->erro())->flash();
                    Helpers_c::redirecionar('blog/admin/posts/listar');
                }
            }
        }

        if(!$post){
            Helpers_c::redirecionar('Aula92-103.php/404');
        }
        echo $this->template->renderizar('posts/formulario_p.html', [
            'post' => $post,
            'categorias' => (new CategoriaModelo())->busca()->resultado(true),
        ]);
    }

    private function validarDados(array $dados):bool
    {
        if(empty($dados['titulo'])){
            $this->mensagem->alerta('O campo título é obrigatório!')->flash();
            return false;
        }
        if(empty($dados['texto'])){
            $this->mensagem->alerta('O campo texto é obrigatório!')->flash();
            return false;
        }
        return true;
    }

    public function deletar(int $id):void
    {

        // $id =  filter_var($id, FILTER_VALIDATE_INT); 

        // if($id){

        // } OU

        if(is_int($id)){
            $post = (new PostModelo())->buscaPorId($id);
            if(!$post){
                $this->mensagem->alerta('Post não encontrado!')->flash();
                Helpers_c::redirecionar('blog/admin/posts/listar');
            } else {
                if($post->deletar()){
                    $this->mensagem->sucesso('Post deletado com sucesso!')->flash();
                    Helpers_c::redirecionar('blog/admin/posts/listar');
                } else {
                    $this->mensagem->erro($post->erro())->flash();
                    Helpers_c::redirecionar('blog/admin/posts/listar');
                }
            }
        }

        if($id){
            $post = (new PostModelo())->buscaPorId($id);
            if(!$post){
                Helpers_c::redirecionar('blog/404');
            }
        }
    }
}

?>