<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
include("../../conexao.php");
include("../../function.php");

// Abre model produto
loadClass("produto");
$produto = new produto();

$produto->setSKU($_REQUEST["sku"]);
$produto->setNome($_REQUEST["nome"]);
$produto->setDescricao($_REQUEST["descricao"]);
$preco = str_replace(',','.',str_replace('.','',$_REQUEST["preco"]));
$produto->setPreco($preco);

if(intval($_REQUEST["id"])>0){
	$produto->setId($_REQUEST["id"]);
	$operacao = $produto->update();
}else{
	$operacao = $produto->insert();
}
$produto->setId(null);
$produto->setSKU(null);
$produto->setNome(null);
$produto->setDescricao(null);
$produto->setPreco(null);

// Abre list dos produtos
require_once("list_produto.php");
