<?php

namespace sistema\biblioteca;

use Directory;

    /**
     * Classe Upload
     * 
     * @author Isaac Caraça <isaaccaracayahoo@gmail.com>
     */

class Upload
{
    public $diretorio;
    public $arquivo;
    public $nome;
    public $pasta;

    public function __construct(?string $diretorio = null)
    {
        $this->diretorio = $diretorio ?? 'uploads';
        if(!file_exists($this->diretorio) && !is_dir($this->diretorio)){
            mkdir($this->diretorio, 0755);
        }
    }

    public function arquivo(?string $pasta = null)
    {
        $this->pasta = $pasta ?? 'arquivos';

        $this->criarPasta();
    }

    public function criarPasta(): void
    {
        $caminhoCompleto = $this->diretorio . DIRECTORY_SEPARATOR . $this->pasta;

        if (!file_exists($caminhoCompleto) && !is_dir($caminhoCompleto)) {
            mkdir($caminhoCompleto, 0755);
        }
    }


}

?>