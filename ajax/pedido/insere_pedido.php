<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
include("../../conexao.php");
include("../../function.php");
session_start();
// Abre model produto
loadClass("pedido");
$pedido = new pedido();

loadClass("pedidoItem");
$pedidoItem = new pedidoItem();
$vl_total = str_replace(',','.',str_replace('.','',$_REQUEST["vl_total"]));
$pedido->setTotal($vl_total);

$idPedido = $pedido->insert();

$dados = $_SESSION["cart"];
foreach($dados as $retorno){
	$pedidoItem->setIdPedido($idPedido);
	$pedidoItem->setIdProduto($retorno["id"]);
	$pedidoItem->setQuantidade($retorno["quantidade"]);
	$pedidoItem->setVlUnitario($retorno["valor_unitario"]);
	$pedidoItem->setVlTotal($retorno["valor_total"]);
	$operacao = $pedidoItem->insert();
}
unset($_SESSION["cart"]);
// Abre list dos produtos
require_once("list_pedido.php");
