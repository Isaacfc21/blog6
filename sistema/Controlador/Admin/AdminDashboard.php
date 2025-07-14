<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\UsuarioModelo;
use sistema\Modelo\PostModelo;
use sistema\Modelo\CategoriaModelo;
use sistema\Nucleo\Sessao;
use sistema\Nucleo\Helpers_c;

/**
 * Class AdminDashboard
 * 
 * @author Isaac Caraça <isaaccaracayahoo@gmail.com>
 */

class AdminDashboard extends AdminControlador
{
    public function dashboard(): void
    {
        $post = new PostModelo();
        $categoria = new CategoriaModelo();
        $usuario = new UsuarioModelo();

        echo $this->template->renderizar('dashboard.html', [
            'posts' => [
                'total' => $post->busca()->total(),
                'ativo' => $post->busca("status = 1")->total(),
                'inativo' => $post->busca("status = 0")->total(),
                'posts' => $post->busca()->ordem("id DESC")->limite(4)->resultado(true), 
            ],
            'categorias' => $categoria->busca()->ordem("id DESC")->limite(4)->resultado(true),

            'total' => [
                'categorias' => $categoria->total(),
                'categoriasAtiva' => $categoria->busca("status = 1")->total(),
                'categoriasInativa' => $categoria->busca("status = 0")->total(),

                'logins' => $usuario->busca()->ordem('ultimo_login DESC')->limite(5)->resultado(true),

                'usuarios' => $usuario->busca("level != 'Admin'")->total(),
                'usuariosAtivo' => $usuario->busca("status = 1 AND level != 'Admin'")->total(),
                'usuariosInativo' => $usuario->busca("status = 0 AND level != 'Admin'")->total(),
                'admin' => $usuario->busca("level = 'Admin'")->total(),
                'adminAtivo' => $usuario->busca("status = 1 AND level = 'Admin'")->total(),
                'adminInativo' => $usuario->busca("status = 0 AND level = 'Admin'")->total(),
            ]
        ]);
    }

    public function sair(): void
    {
        $this->usuario->ultimo_logout = date('Y-m-d H:i:s');
        $this->usuario->salvar();   
        $this->mensagem->informa('Você saiu do painel de controle!')->flash();
        (new Sessao())->limpar('usuarioId');
        Helpers_c::redirecionar('blog/admin/login');
    }

    
}

?>