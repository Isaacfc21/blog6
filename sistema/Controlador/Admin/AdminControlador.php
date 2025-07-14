<?php

namespace sistema\Controlador\Admin;
use sistema\Nucleo\Controlador;
use sistema\Nucleo\Helpers_c;
use sistema\Controlador\UsuarioControlador;
use sistema\Nucleo\Sessao;

/**
 * Class AdminControlador
 * 
 * @author Isaac Caraça <isaaccaracayahoo@gmail.com>
 */

class AdminControlador extends Controlador
{
    protected $usuario;

    public function __construct()
    {
      parent::__construct('templates/dashboard/views'); 
      
      $this->usuario = UsuarioControlador::usuario();

      if(!$this->usuario || $this->usuario->level != 'Admin'){
        $this->mensagem->erro('Faça login para acessar o painel de controle!')->flash();
        $sessao = (new Sessao());
        $sessao->limpar('usuarioId');
        Helpers_c::redirecionar('blog/admin/login');
      }

      // if($this->usuario || $this->usuario->level == 3){
        
      // }
    }
}

?>