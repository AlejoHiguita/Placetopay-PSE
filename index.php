<?php

require_once "controladores/PagosC.php";

$pagos = new Pagos();
$pagos -> vistaPagos();
$pagos -> getBankList();
$pagos -> Transaction();








?>