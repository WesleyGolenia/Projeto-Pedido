<?php

header("Content-Type: application/json; charset=ISO-8859-1",true);
@session_start();

include("../../conexao.php");
include("../../function.php");

// Abre model do produto
loadClass("produto");
$produto = new produto();

//Faz request dos Dados
$id = $_REQUEST["id"];
$sku = $_REQUEST["sku"];

//Passa os Parametros
if(!empty($id)){
    $produto->setId($id);
}
if(!empty($sku)){
    $produto->setSKU($sku);
}

$registros = array_shift($produto->select());
echo json_encode($registros);
