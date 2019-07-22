<?php

class pedido {

    function __construct() {//abre conexao
        $this->con = new conexao();
    }

    function __destruct() {// fecha conexao
        $this->con->fecha();
    }

    function setTotal($total) {
        $this->total = $total;
    }

	function select() {
		$sql = " select * from pedido " ;
        $sql .=" order by id desc";
        $rs = $this->con->execute($sql);// rs = 'return select'
		return $rs;// retorna para control
	}
	//INSERIR NO BANCO
    function insert() {
		$sql = "BEGIN WORK";
        $rs = $this->con->execute($sql);
        $sql = "INSERT INTO pedido (total,data)
                VALUES ('" . $this->total . "',now());";
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
            $sql = "SELECT LAST_INSERT_ID() as id;";
            $retorno = $this->con->execute($sql);
            return $retorno[0]['id'];
        }
    }
}
