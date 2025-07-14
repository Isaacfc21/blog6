<?php

namespace sistema\Nucleo;

use sistema\Suporte\Template;

/**
 * Class Controlador
 * 
 * @author Isaac Caraça <isaaccaracayahoo@gmail.com>
 */

class Controlador
{
    protected Template $template;
    protected Mensagem $mensagem;

    public function __construct(string $diretorio)
    {
        $this->template = new Template($diretorio);

        $this->mensagem = new Mensagem();
    }
}

?>