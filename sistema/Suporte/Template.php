<?php

namespace sistema\Suporte;
use Twig\Lexer;
use sistema\Nucleo\Helpers_c;
use sistema\Controlador\UsuarioControlador;

/**
 * Class Controlador
 * 
 * @author Isaac Caraça <isaaccaracayahoo@gmail.com>
 */

class Template
{
    private \Twig\Environment $twig;

    public function __construct(string $diretorio)
    {
        $loader = new \Twig\Loader\FilesystemLoader($diretorio);
        $this->twig = new \Twig\Environment($loader);

        // $lexer = new Lexer($this->twig, array(
            $this->helpers();
        // ));
        // $this->twig->setLexer($lexer);
    }

    public function renderizar(string $view, array $dados)
    {
        return $this->twig->render($view, $dados);
    }

    private function helpers():void
    {
        array(
            $this->twig->addFunction(
                new \Twig\TwigFunction('url', function(?string $url = null){
                    return Helpers_c::url($url);
                })
            ),
            $this->twig->addFunction(
                new \Twig\TwigFunction('saudacao_switch', function(){
                    return Helpers_c::saudacao_switch();
                })
            ),
            $this->twig->addFunction(
                new \Twig\TwigFunction('resumirTexto', function(string $texto, int $limite = 100){
                    return Helpers_c::resumirTexto($texto, $limite);
                })   
            ),
            $this->twig->addFunction(
                new \Twig\TwigFunction('flash', function(){
                    return Helpers_c::flash();
                })   
            ),
            $this->twig->addFunction(
                new \Twig\TwigFunction('usuario', function(){
                    return UsuarioControlador::usuario();
                })   
            )
        );
    }
}

?>  