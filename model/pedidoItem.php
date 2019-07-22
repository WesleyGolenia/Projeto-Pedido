<?php

class pedidoItem {

    function __construct() {//abre conexao
        $this->con = new conexao();
    }

    function __destruct() {// fecha conexao
        $this->con->fecha();
    }

    function setIdPedido($id_pedido) {
        $this->id_pedido = $id_pedido;
    }
    function setIdProduto($id_produto) {
        $this->id_produto = $id_produto;
    }
    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
    function setVlUnitario($vl_unitario) {
        $this->vl_unitario = $vl_unitario;
    }
    function setVlTotal($vl_total) {
        $this->vl_total = $vl_total;
    }

	function select() {
        $sql = " select * from pedido_item pi inner join produto p on p.id = pi.id_produto" ;
        if(!empty($this->id_pedido)){
            $sql .=" where pi.id_pedido = ".$this->id_pedido;
        }
        $sql .=" order by p.id";
        $rs = $this->con->execute($sql);// rs = 'return select'
		return $rs;// retorna para control
	}
	//INSERIR NO BANCO
    function insert() {
		$sql = "BEGIN WORK";
        $rs = $this->con->execute($sql);
        $sql = "INSERT INTO pedido_item (id_pedido,id_produto,quantidade,vl_unitario,vl_total)
                VALUES ('" . $this->id_pedido . "','" . $this->id_produto . "','" . $this->quantidade . "','" . $this->vl_unitario . "','" . $this->vl_total . "');";
        $rs = $this->con->execute($sql);
        if ($rs === false) {
            $sql = "ROLLBACK WORK";
            $rs1 = $this->con->execute($sql);
            $retorno[0] = 0;
            $retorno[1] = "Erro ao cadastrar contate o administrador do sistema";
            return $retorno;
        } else {
            $sql = "COMMIT WORK";
            $rs1 = $this->con->execute($sql);
            $retorno[0] = 1;
            $retorno[1] = "Pedido inserido com sucesso!";
            return $retorno;
        }
    }
}
