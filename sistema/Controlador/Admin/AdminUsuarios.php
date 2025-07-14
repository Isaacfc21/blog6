<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\UsuarioModelo;

// use sistema\Modelo\PostModelo;
// use sistema\Modelo\CategoriaModelo;
use sistema\Nucleo\Helpers_c;

/**
 * Class AdminUsuarios
 * 
 * @author Isaac Caraça <isaaccaracayahoo@gmail.com>
 */

class AdminUsuarios extends AdminControlador
{
    public function listar():void
    {
        $usuario = new UsuarioModelo();

        echo $this->template->renderizar('usuarios.html', [
            'usuarios' => $usuario->busca()->ordem('level DESC, status ASC')->resultado(true),
            'total' => [
                'usuarios' => (new UsuarioModelo())->busca("level != 'Admin'")->total(),
                'usuariosAtivo' => (new UsuarioModelo())->busca("status = 1 AND level != 'Admin'")->total(),
                'usuariosInativo' => (new UsuarioModelo())->busca("status = 0 AND level != 'Admin'")->total(),
                'admin' => (new UsuarioModelo())->busca("level = 'Admin'")->total(),
                'adminAtivo' => (new UsuarioModelo())->busca("status = 1 AND level = 'Admin'")->total(),
                'adminInativo' => (new UsuarioModelo())->busca("status = 0 AND level = 'Admin'")->total(),
            ]

        ]);
    }
    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
            if ($this->validarDados($dados)) {
                if (empty($dados['senha'])) {
                    $this->mensagem->alerta('O campo senha é obrigatório!')->flash();

                    echo $this->template->renderizar('formulario_u.html', [
                        'usuario' => $dados
                    ]);
                    return; 
                }

                $usuario = new UsuarioModelo();
                $usuario->nome = $dados['nome'];
                $usuario->email = $dados['email'];
                $usuario->senha = Helpers_c::gerarSenha($dados['senha']);
                $usuario->level = $dados['level'];
                $usuario->status = $dados['status'];
                $usuario->cadastrado_em = date('Y-m-d H:i:s');

                if ($usuario->salvar()) {
                    $this->mensagem->sucesso('Usuário cadastrado com sucesso!')->flash();
                    Helpers_c::redirecionar('blog/admin/usuarios/listar');
                    return;
                }

                $usuario->mensagem()->flash();
            }
        }

        echo $this->template->renderizar('formulario_u.html', [
            'usuario' => $dados ?? null
        ]);
    }

    public function editar( int $id):void
    {
        $usuario = (new UsuarioModelo())->buscaPorId($id);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(isset($dados)){
            if($this->validarDados($dados)){
                $usuario = (new UsuarioModelo())->buscaPorId($id);
                $usuario->nome = $dados['nome'];
                $usuario->email = $dados['email'];
                $usuario->senha = (!empty($dados['senha']) ? Helpers_c::gerarSenha($dados['senha']) : $usuario->senha);
                $usuario->level = $dados['level'];
                $usuario->status = $dados['status'];
                $usuario->atualizado_em = date('Y-m-d H:i:s');
                
            }

            if($usuario->salvar()){
                $this->mensagem->sucesso('Usuario atualizado com sucesso!')->flash();
                Helpers_c::redirecionar('blog/admin/usuarios/listar');
            }else{
                $usuario->mensagem()->flash();
            }
        }

        echo $this->template->renderizar('formulario_u.html', [
            'usuario' => $usuario,
        ]);
    }
    public function deletar(int $id):void
    {

        // $id =  filter_var($id, FILTER_VALIDATE_INT); 

        // if($id){

        // } OU

        if(is_int($id)){
            $usuario = (new UsuarioModelo())->buscaPorId($id);
            if(!$usuario){
                $this->mensagem->alerta('Usuario não encontrado!')->flash();
                Helpers_c::redirecionar('blog/admin/usuarios/listar');
            } else {
                if($usuario->deletar()){
                    $this->mensagem->sucesso('Usuario deletado com sucesso!')->flash();
                    Helpers_c::redirecionar('blog/admin/usuarios/listar');
                } else {
                    $this->mensagem->erro($usuario->erro())->flash();
                    Helpers_c::redirecionar('blog/admin/usuarios/listar');
                }
            }
        }

        if($id){
            $usuario = (new UsuarioModelo())->buscaPorId($id);
            if(!$usuario){
                Helpers_c::redirecionar('blog/404');
            }
        }
    }

    public function validarDados(array $dados): bool
    {

        if(empty($dados['nome'])){
            $this->mensagem->alerta('O campo nome é obrigatório!')->flash();
            return false;
        }

        if(empty($dados['email'])){
            $this->mensagem->alerta('O campo e-mail é obrigatório!')->flash();
            return false;
        }

        if(!Helpers_c::validarEmail($dados['email'])){
            $this->mensagem->alerta('O campo email é obrigatório!')->flash();
            return false;
        }

        if(!empty($dados['senha'])){
            if(!Helpers_c::validarSenha($dados['senha'])){
                $this->mensagem->alerta('A senha deve ter entre 6 e 50 caracteres!')->flash();
                return false;
             }
        }

        return true;
    }
}

?>