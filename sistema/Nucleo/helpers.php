<?php
    #echo("Arquivo de Funções");

/**
 * Retorna a data atual de acordo com o sistema Windows
 * @return string retorna a data formatada  
 */

function dataAtual(): string
{
    $diaMes = date('d');
    $diaSemana = date('w');
    $mes = date('n') - 1;
    $ano = date('Y');

    $nomesDiasSemanas = [
        'domingo', 
        'segunda-feira', 
        'terça-feira', 
        'quarta-feira', 
        'quinta-feira', 
        'sexta-feira', 
        'sábado'
    ];
    $nomesDiasMeses = [
        'Janeiro', 
        'Fevereiro',
        'Março', 
        'Abril', 
        'Maio', 
        'Junho', 
        'Julho',
        'Agosto',
        'Setembro',
        'Novembro',
        'Dezembro'
    ];

    $dataFormatada = $nomesDiasSemanas[$diaSemana].', '.$diaMes.' de '.$nomesDiasMeses[$mes]. ' de '.$ano;
    return $dataFormatada;
}

/**
 * Valida uma informação do servidor e implementa junto com uma URL
 * @param string $url URL a ser trabalhada
 * @return string endereço implementado junto com a URL
 */

function url(string $url): string
{
    $servidor = $_SERVER["SERVER_NAME"]; 
    $ambiente = ($servidor == 'localhost' ? URL_DESENVOLVIMENTO : URL_PRODUCAO);

    if(str_starts_with($url, '/')){
        return $ambiente.$url;
    }
    return $ambiente.'/'.$url;
}

/**
 * Valida uma informação do Servidor
 * @return bool verifica se o endereço é existente ou não
 */

function localhost(): bool
{
    $servidor = $_SERVER["SERVER_NAME"];  
    
    if ($servidor == "localhost") {
        return true;
    }
    return false;
}

/**
 * Valida uma URL sem Filtro
 * @param string $url endereço a ser verificado
 * @return bool url verificada 
 */

function validarURL(string $url): bool
{
    if(mb_strlen($url < 10)){
        return false;
    }
    if(!str_contains($url, '.')){
        return false;
    }   
    if(str_contains($url, 'http://') or ('https://')){
        return true;
    }   
    return false;
} 

/**
 * Valida uma URL com Filtro
 * @param string $url endereço a ser verificado
 * @return bool url verificada true ou false
 */

function validarURLComFiltro(string $url): bool
{
    return filter_var($url, FILTER_VALIDATE_URL);
}

/**
 * Valida um E-mail
 * @param string $email email a ser verificado
 * @return bool email verificado true ou false
 */

function validarEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Conta o tempo decorrido de uma data
 * @param string $data tempo a ser operado
 * @return string tempo já operado
 */

function contarTempo(string $data)
{
    $agora = strtotime(date('Y-m-d H:i:s'));
    $tempo = strtoTime($data);
    $diferenca = $agora - $tempo;
    $segundos = $diferenca;
    $minutos = round($diferenca / 60); 
    $horas = round($diferenca / 3600);
    $dias = round($diferenca / 86400);
    $semanas = round($diferenca / 604800);
    $meses = round($diferenca / 2419200);
    $anos = round($diferenca / 29030400);

    if($segundos <= 60){
        return 'agora';
    }elseif($minutos <= 60){
        return $minutos == 1 ? 'há 1 minuto' : 'há '.$minutos.' minutos';
    }elseif($horas <= 24){
        return $horas == 1 ? 'há 1 hora' : 'há '.$horas.' horas';
    }elseif($dias <= 7){
        return $dias == 1 ? 'há 1 dia' : 'há '.$dias.' dias';
    }elseif($semanas <= 4){
        return $semanas == 1 ? 'há 1 semana' : 'há '.$semanas.' semanas';
    }elseif($meses <= 12){
        return $meses == 1 ? 'há 1 mês' : 'há '.$meses.' meses';
    }else{
        return $anos == 1 ? 'há 1 ano' : 'há '.$anos.' anos';
    }
}

/**
 * Formata valores
 * @param float $valor valor para formatar
 * @return string valor formatado
 */

function formatarValor(float $valor): string
{
    return number_format($valor, 2, ',', '.');
}

/**
 * Formata numeros
 * @param int $numero numero para formatar
 * @return string numero formatado
 */

function formatarNumero(int $numero): string
{
    return number_format($numero ?: 0,0,'.','.');
}

/**
 * Saudação de acordo com o horário
 * @return string saudação
 */

function saudacao(): string
{
    echo $hora = date('H');

    if ($hora >= 0 && $hora <= 5) {
        $saudacao = "Boa madrugada";
    } else if ($hora >= 6 and $hora <= 12) {
        $saudacao = "Bom dia";
    } else if ($hora >= 13 and $hora <= 18) {
        $saudacao = "Boa tarde";
    } else {
        $saudacao = "Boa noite";
    }

    return $saudacao;
};

/**
 * Resume um Texto
 * 
 * @param string $texto texto para resumir
 * @param int $limite quantidade de caracteres
 * @param string $continue opcional - o que deve ser exibido ao final do resumo
 * @return  string texto resumido
 */

function resumirTexto(string $texto, int $limite, string $continue = "..."): string
{
    $textoLimpo = trim(strip_tags($texto));

    if (mb_strlen($textoLimpo) <= $limite) {
        return $textoLimpo;
    }

    $resumirTexto = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo, 0, $limite), ""));

    return $resumirTexto.$continue;
};