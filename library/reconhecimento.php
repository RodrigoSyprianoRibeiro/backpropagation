<?php

session_start();

require_once('Util.php');
require_once('RedesNeurais.php');

if ($_POST) {
    $redesNeurais = unserialize($_SESSION['redeTreinada']);
    echo json_encode($redesNeurais->reconhecerLetra(Util::getLetraReconhecimento($_POST['letra'])));
}