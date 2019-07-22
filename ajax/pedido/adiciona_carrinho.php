<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
include("../../conexao.php");
include("../../function.php");

session_start();
// Abre model produto
loadClass("produto");
$produto = new produto();

$quantidade = $_REQUEST["quantidade"];
$id = $_REQUEST["id"];

if(!isset($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}
$soff=sizeof($_SESSION['cart']);
if($soff <=0 || $soff == "undefined"){
	unset($_SESSION['cart']);
}
if($id <=0 || $id == "undefined"){
	$id=0;
	unset($_SESSION['cart']);
}
if(intval($id)>0){
	$produto->setId($id);
	$operacao = $produto->select();
	if(sizeof($operacao)>0){
		$_SESSION['cart'][$id]["id"]=$id;
		$_SESSION['cart'][$id]['sku'] = $operacao[0]['sku'];
		$_SESSION['cart'][$id]['nome'] = $operacao[0]['nome'];
		$_SESSION['cart'][$id]['quantidade'] = $quantidade;
		$_SESSION['cart'][$id]['valor_unitario'] = $operacao[0]['preco'];
		$_SESSION['cart'][$id]['valor_total'] = $quantidade * $operacao[0]['preco'];
	}
}

// Abre list do carrinho
require_once("list_carrinho.php");




