<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
include("../../conexao.php");
include("../../function.php");

// Abre model produto
loadClass("produto");
$produto = new produto();

// produto
$produto->setId($_REQUEST["id"]);
$operacao = $produto->delete();

require_once("list_produto.php");