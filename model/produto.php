<?php

class produto {

    function __construct() {//abre conexao
        $this->con = new conexao();
    }

    function __destruct() {// fecha conexao
        $this->con->fecha();
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSKU($sku) {
        $this->sku = $sku;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }

	function setSituacao($situacao) {
        $this->situacao = $situacao;
    }
    
	function select() {
		$sql = " select * from produto " ;
		$sql .=" where situacao != 'E' ";
		
		if(!empty($this->id)){
			$sql .=" and id=".$this->id;
		}
		if(!empty($this->sku)){
			$sql .=" and sku='".$this->sku."'";
        }
        if(!empty($this->nome)){
			$sql .=" and nome='".$this->nome."'";
        }
        if(!empty($this->situacao)){
			$sql .=" and situacao='".$this->situacao."'";
		}
        $sql .=" order by id";
        $rs = $this->con->execute($sql);// rs = 'return select'
		return $rs;// retorna para control
		
	}
	//INSERIR NO BANCO
    function insert() {
		$sql = "BEGIN WORK";
        $rs = $this->con->execute($sql);
        $sql = "INSERT INTO produto (sku,nome,descricao,preco,situacao,dt_criacao)
                VALUES ('" . $this->sku . "','" . $this->nome . "','" . $this->descricao . "','" . $this->preco . "','A',now())";
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
            $retorno[1] = "Produto inserido com sucesso!";
            return $retorno;
        }
    }
	// FIM INSERIR NO BANCO
	
    function update() {

        $sql = "BEGIN WORK";
        $rs = $this->con->execute($sql);
		$sql = "UPDATE produto 
                SET sku ='" .  $this->sku . "',nome ='" .  $this->nome . "',descricao ='" .  $this->descricao . "',preco ='" .  $this->preco . "',dt_alteracao = now() where id = " . $this->id;
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
            $retorno[1] = "Produto Atualizado com sucesso!";
            return $retorno;
        }
    }
	function delete() {

        $sql = "BEGIN WORK";
        $rs = $this->con->execute($sql);

        $sql = "UPDATE produto 
                   SET situacao = 'E',dt_alteracao = now()
                 WHERE id = " . $this->id . " ";

        $rs = $this->con->execute($sql);

        if ($rs === false) {
            $sql = "ROLLBACK WORK";
            $rs1 = $this->con->execute($sql);
            $retorno[0] = 0;
            $retorno[1] = "Erro ao deletar contate o administrador do sistema!";
            return $retorno;
        } else {
            $sql = "COMMIT WORK";
            $rs1 = $this->con->execute($sql);
            $retorno[0] = 1;
            $retorno[1] = "Produto excluido com sucesso!";
            return $retorno;
        }
    }
	function bloquear() {

        $sql = "BEGIN WORK";
        $rs = $this->con->execute($sql);

        $sql = "UPDATE produto 
                   SET situacao = '" . $this->situacao . "',dt_alteracao = now()
                 WHERE id = " . $this->id . " ";
        $rs = $this->con->execute($sql);

        if ($rs === false) {
            $sql = "ROLLBACK WORK";
            $rs1 = $this->con->execute($sql);
            $retorno[0] = 0;
            $retorno[1] = "Erro ao bloquear contate o administrador do sistema!";
            return $retorno;
        } else {
            $sql = "COMMIT WORK";
            $rs1 = $this->con->execute($sql);
            $retorno[0] = 1;
			if($this->situacao == 'B'){
				$retorno[1] = "Produto bloqueado com sucesso!";
			}else{
				$retorno[1] = "Produto desbloqueado com sucesso!";
			}
            return $retorno;
        }
    }
	
}
