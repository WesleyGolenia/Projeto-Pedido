<?php

/**
 * NAO REMOVER
 */
class conexao {

    public $conn;

    function __construct( $iniFile = 'conexao.ini') {
        //echo "<br><b> __construct EM CONEXAOMySQL.PHP</b><br>";
        // Abre o Arquivo de Configuração
        $ini = parse_ini_file($iniFile);

        //debug($ini,false);
        // Carrega as Configurações
        $db_host = $ini["db_host"];
        $db_user = $ini["db_user"];
        $db_pass = $ini["db_pass"];
        $db_base = $ini["db_base"];
        $db_port = $ini["db_port"];
        $img_index = $ini["img_index"];
        $ambiente = $ini["ambiente"];
        $producao = $ini["producao"];
        $link_off = $ini["link_off"];

        //echo "db_host   :".$db_host."<br>";
        //echo "db_user   :".$db_user."<br>";
        //echo "db_pass   :".$db_pass."<br>";
        //echo "db_base   :".$db_base."<br>";
        //echo "db_port   :".$db_port."<br>";
        //echo "img_index :".$img_index."<br>";
        //echo "ambiente  :".$ambiente."<br>";
        //echo "producao  :".$producao."<br>";
        // Realiza a Conexão
        $this->conn = mysql_connect($db_host . ($db_port ? ":$db_port" : ''), $db_user, $db_pass); // or die ("Não foi possível estabelecer uma conexão MySQL!");
        // Seleciona o Banco de Dados
        mysql_select_db($db_base, $this->conn); // or die("Não foi possível selecionar o Banco MySQL");

        $_SESSION["ss_connMySQL"] = $this->conn;
        //debug($_SESSION["ss_conn"],false);
        // Imagem do Index na Sessão
        $_SESSION["SS_MYSQL_DB"] = $db_base;
        $_SESSION["SS_IMG_INDEX"] = $img_index;
        $_SESSION["SS_AMBIENTE"] = $ambiente;
        $_SESSION["SS_PRODUCAO"] = $producao;
        $_SESSION["SS_LINK_OFF"] = $link_off;
        //echo "IMG_INDEX(CONEXAOMySQL.PHP):".$img_index."<br>";
        //echo "SESSION(IMG_INDEX) - CONEXAOMySQL.PHP:".$_SESSION["SS_IMG_INDEX"]."<br>";
    }

    function execute($sql, $gravaLog = true) {
        //debug($sql,false);
        //echo "<br><b> execute EM CONEXAOMySQL.PHP</b><br>";

        $operacao = substr(trim($sql), 0, 6);
        //debug($operacao,false);
//        // Abre o Arquivo de Configuração
//        $ini = parse_ini_file('conexaoMySQL.ini');
//
//        //debug($ini,false);
//        // Carrega as Configurações
//        $db_host = $ini["db_host"];
//        $db_user = $ini["db_user"];
//        $db_pass = $ini["db_pass"];
//        $db_base = $ini["db_base"];
//        $db_port = $ini["db_port"];
//
//        //echo "db_host   :".$db_host."<br>";
//        //echo "db_user   :".$db_user."<br>";
//        //echo "db_pass   :".$db_pass."<br>";
//        //echo "db_base   :".$db_base."<br>";
//        //echo "db_port   :".$db_port."<br>";
//        // Realiza a Conexão
//        $this->conn = mysql_connect($db_host, $db_user, $db_pass) or die("Não foi possível estabelecer uma conexão MySQL!");
//
//        // Seleciona o Banco de Dados
//        mysql_select_db($db_base, $this->conn) or die("Não foi possível selecionar o Banco MySQL");

        // Executa a Query
        $this->rs = mysql_query($sql, $this->conn);

        if ($this->rs === false) {
            //$debug = debug_backtrace();
            //$debug[0]['args']['erro'] = mysql_error();
            //debug($debug, false);
        }
        //exit;

        if (strtoupper(trim($operacao)) == "SELECT") {
            while ($row = mysql_fetch_assoc($this->rs)) {
                $result[] = $row;
            }
            return @$result;
        } else if(strtoupper(trim($operacao)) == "DESCRI"){
			 while ($row = mysql_fetch_array($this->rs)) {
                $result[] = $row;
            }
            return @$result;
		}
		else {
            //if (strtoupper(trim($operacao)) == "INSERT" || strtoupper(trim($operacao)) == "UPDATE" || strtoupper(trim($operacao)) == "DELETE")
            //$this->gravaLog($sql); //or die("Erro ao Gravar o Log. NÃ£o Foi Possivel o Comando <br> SQL: $sql <br> ");
                return $this->rs;
        }
    }

    function numRows() {
        //echo "<br><b> numRows EM CONEXAOMySQL.PHP</b><br>";

        $rows = mysql_num_rows($this->stmt);
        return $rows;
    }

    function fecha() {
        //echo "<br><b> fecha EM CONEXAOMySQL.PHP</b><br>";
        @mysql_close($this->conn);
    }

    function ultimoIdInserido() {
        //echo "<br><b> ultimoIdInserido EM CONEXAOMySQL.PHP</b><br>";
        return mysql_insert_id();
    }

    function gravaLog($sql) {
        //echo "<br><b> gravaLog EM CONEXAOMySQL.PHP</b><br>";
        //debug("DIR_ROOT :".DIR_ROOT, false);

        $operacao = substr($sql, 0, 6);
        $dir = DIR_ROOT . '/' . "log/" . date("Y") . "/" . date("m") . "/";

        //debug("Diretorio Log :".$dir, false);

        @mkdir($dir, 0777, true);
        $arquivo = $dir . date("dmY") . ".txt";

        //debug("Arquivo :".$arquivo, false);

        $fp = fopen($arquivo, 'a+');
        fwrite($fp, $sql . ";\n");
        fclose($fp);
        $this->gravaLogBanco($sql);
    }

    function gravaLogBanco($sql) {
        //echo "<br><b> gravaLogBanco EM CONEXAOMySQL.PHP</b><br>";

        $aResultado = explode(" ", $sql);
        $nomeTabela = $aResultado[1];
        //debug($nomeTabela,false);
    }

}
