<?php
session_start();
loadClass("produto");//model
loadClass("pedido");//model
loadClass("pedidoItem");//model

$produto = new produto();
$pedido = new pedido();
$pedidoItem = new pedidoItem();

if ($_POST || $_GET) {
    $id = $_REQUEST["id"];
    $sku = $_REQUEST["sku"];
    $nome = $_REQUEST["nome"];
    $quantidade = $_REQUEST["quantidade"];
    $valor_unitario = $_REQUEST["valor_unitario"];
    $valor_total = $_REQUEST["valor_total"];
	$acao = $_REQUEST["acao"];
}else{
	$acao = "L";
}
# L - Listar
if($acao == "L"){
    $pedidos = $pedido->select();
    $produto->setSituacao('A');
    $produtos = $produto->select();
	include("view/pedido.php");
}
