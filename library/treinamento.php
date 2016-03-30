<?php

session_start();

require_once('Util.php');
require_once('RedesNeurais.php');

if ($_POST) {

//    $dados = array('quantidade_geracoes' => 5, 'taxa_aprendizagem' => 20, 'tamanho_vetor_intermediario' => 3);

    $redesNeurais = new RedesNeurais($_POST);

    $redesNeurais->iniciarTreinamento(Util::getLetrasTreinamento());

    $_SESSION['redeTreinada'] = serialize($redesNeurais);

    echo json_encode("Rede treinada.");
}