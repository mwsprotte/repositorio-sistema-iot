<?php
//utilização de namespaces
namespace processaAcesso{
include 'conexao/mysql.php';
    use Mysql as Mysql;
    class ProcessaAcesso {
        var $db;
        public function __construct() {
            $conexao = new Mysql\mysql(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
            $this->db = $conexao;
        }
        public function verificaAcesso($email, $senha) {
            $select = $this->db->select('tb_usuarios', '*', " where email = '$email' and senha = '$senha'");
            return $select;
        }
        public function cadastraUsuario($dados){
            $insert = $this->db->insert('tb_usuarios', $dados);
            return $insert;
        }
    }
}
?>