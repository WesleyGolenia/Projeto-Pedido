<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
include("../../conexao.php");
include("../../function.php");
session_start();
$id=$_REQUEST["id"];
if(intval($id)>0){
	$dados = $_SESSION["cart"];
	foreach ($dados as $i=> $value){
		if($dados[$i]["id"]== $id){
			unset($dados[$i]);
			$dados1 = array_values($dados);
			$_SESSION["cart"] = NULL;
			$_SESSION["cart"] = $dados1;
		}
	}
}
// Abre list do carrinho
require_once("list_carrinho.php");
