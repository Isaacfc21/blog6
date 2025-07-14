<?php
/*  Jogo de Adivinhação
 *  Execute com: php adivinhacao.php
 */

$numeroSecreto = rand(1, 10); 
$tentativas = 0;            
$palpite = 0;            

while ($palpite !== $numeroSecreto) {
    $palpite = (int) readline("Adivinhe o número (1‑10): ");
    $tentativas++;

    if ($palpite < $numeroSecreto) {
        echo "Muito baixo! Tente de novo.\n";
    } elseif ($palpite > $numeroSecreto) {
        echo "Muito alto! Tente de novo.\n";
    }
}

echo "\nParabéns! Você acertou em {$tentativas} tentativa(s).\n";

?>
