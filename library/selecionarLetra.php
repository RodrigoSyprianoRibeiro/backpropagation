<?php
require_once('Util.php');

if ($_POST) {
    echo json_encode(Util::getLetraPorNome($_POST['letra']));
}