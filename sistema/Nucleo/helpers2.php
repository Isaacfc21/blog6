<?php
    #echo("Arquivo de Funções");

/**
 * Valida um número de CPF
 * @param string $cpf a ser calculado os últimos dois dígitos
 * @return bool CPF Válido ou não
 */

function validarCPF(string $cpf): bool
{
    $cpf = limparNumero($cpf);

    if(mb_strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)){
        return false; 
    }

    // Esse loop FOR faz o cálculo dos dois digitos verificadores do CPF, no caso os dois últimos digitos do CPF

    // 562.564.468-36

    // Agora, vamos calcular os dois dígitos verificadores (3 e 6).

    // Passo 1: Cálculo do 1º dígito verificador

    // O primeiro dígito verificador é calculado a partir dos 9 primeiros números 562564468.

    // 5×10 + 6×9 + 2×8 + 5×7 + 6×6 + 4×5 + 4×4 + 6×3 + 8×2 = SOMA
    // (5×10) + (6×9) + (2×8) + (5×7) + (6×6) + (4×5) + (4×4) + (6×3) + (8×2) = 50 + 54 + 16 + 35 + 36 + 20 + 16 + 18 + 16 = 261
    // $d = ((10 * 261) % 11) % 10;
    // (10 × 261) % 11 = 2610 % 11 = 3

    // Ou seja, o primeiro dígito verificador é 3, igual ao do CPF informado.

    // Passo 2: Cálculo do 2º dígito verificador

    // Agora, usamos os 10 primeiros números 5625644683 e multiplicamos pelos pesos de 11 a 2:

    // 5×11 + 6×10 + 2×9 + 5×8 + 6×7 + 4×6 + 4×5 + 6×4 + 8×3 + 3×2 = SOMA
    // (5×11) + (6×10) + (2×9) + (5×8) + (6×7) + (4×6) + (4×5) + (6×4) + (8×3) + (3×2) = 55 + 60 + 18 + 40 + 42 + 24 + 20 + 24 + 24 + 6 = 313
    // $d = ((10 * 313) % 11) % 10;
    // (10 × 313) % 11 = 3130 % 11 = 6
    // Ou seja, o segundo dígito verificador é 6, igual ao do CPF informado.

    for($t = 9; $t < 11; $t++){
        for($d = 0, $c = 0; $c < $t; $c++){
            $d += $cpf[$c] * (($t + 1) - $c);
        }

        $d = ((10 * $d) % 11) % 10;

        if($cpf[$c] != $d){
            return false;
        }
    }
    return true;
}

/**
 * Limpa tudo o que não for um número
 * @param string número a ser limpado
 * @return string número limpo
 */

function limparNumero(string $numero): string
{
    return preg_replace('/[^0-9]/', '', $numero);
}

/**
 * Saudação de acordo com o horário
 * @return string saudação
 */

function saudacao_match(): string
{
    $hora = date('H');
    // $hora = '18';

    // $saudacao = match($hora){
    //     '23' => 'Boa noite',
    //     default => 'Bom dia'
    // }; 
    
    // $saudacao = match($hora){
    //     '18', '19', '20', '21', '22', '23', '24' => 'Boa noite',
    // };
    
    $saudacao = match(true){
        $hora >= 0 && $hora <= 5 => 'Boa madrugada',
        $hora >= 6 and $hora <= 12 => 'Bom dia',
        $hora >= 13 and $hora <= 18 => 'Boa tarde',
        default => 'Boa noite'
    }; 

    return $saudacao;
}

/**
 * Saudação de acordo com o horário
 * @return string saudação
 */

function saudacao_switch(): string
{
    $hora = date('H');

    switch($hora){
        case $hora >= 0 && $hora <= 5:
            $saudacao = "Boa madrugada";
            break;
        case $hora >= 6 and $hora <= 12:
            $saudacao = "Bom dia";
            break;
        case $hora >= 13 and $hora <= 18:
            $saudacao = "Boa tarde";
            break;
        default:
            $saudacao = "Boa noite";

    }

    return $saudacao;
}
 
/**
 * Gera URL Amigável
 * @param string $string a ser codificada
 * @return string slug pronto
 */

function slug(string $string): string
{
    // Usar iconv para remover acentos e caracteres especiais
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
    
    // Remover caracteres especiais (aqueles não alfanuméricos, incluindo pontuação e símbolos)
    $slug = preg_replace('/[^a-zA-Z0-9\s]/', '', $slug);

    $slug = strip_tags(trim($slug));

    $slug = str_replace(' ', '_', $slug);

    // $slug = str_replace(['_____', '____', '___', '__', '_'], '_' ,$slug);

    $slug = preg_replace('/_+/', '_', $slug);


    return strtolower($slug);
}
?>
