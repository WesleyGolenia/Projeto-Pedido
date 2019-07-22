<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
include("../../conexao.php");
include("../../function.php");

// Abre mode produto
loadClass("produto");
$produto = new produto();

// produto
$produto->setId($_REQUEST["id"]);
$consulta = $produto->select();
if($consulta[0]["situacao"] == 'A'){
	$produto->setSituacao('B');
	$operacao = $produto->bloquear();
}else{
	$produto->setSituacao('A');
	$operacao = $produto->bloquear();
}
$produto->setSituacao(NULl);
require_once("list_produto.php");