<?php

loadClass("produto");//model

$produto = new produto();

if ($_POST || $_GET) {
    $id = $_REQUEST["id"];
    $sku = $_REQUEST["sku"];
    $nome = $_REQUEST["nome"];
    $descricao = $_REQUEST["descricao"];
    $preco = $_REQUEST["preco"];
	$acao = $_REQUEST["acao"];
}else{
	$acao = "L";
}
# L - Listar
if($acao == "L"){
	$registro = $produto->select();
	include("view/produto.php");
}

