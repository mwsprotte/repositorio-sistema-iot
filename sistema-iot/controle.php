<?php
//utilização de namespaces
namespace controle;

include 'processaAcesso.php';

$valor_0 = 0;

use processaAcesso as processaAcesso;

$controle = new \processaAcesso\ProcessaAcesso;
if ($_POST['enviar']) {
    $email = $_POST['email'];
    $senha = ($_POST['senha']);
    $projeto = $controle->verificaAcesso($email, $senha);
    //redirecionando para pagina conforme o tipo do usuário
    if ($projeto[0]['projeto'] == 1) {
        header("Location:dashboard1.php");
    } else if ($projeto[0]['projeto'] == 2) {
        header("Location:dashboard2.php?escolha_sensor=0");
    } else if ($projeto[0]['projeto'] == 3) {
        header("Location:dashboard3.php");
    } else {
        header("Location:index_erro.php");
    }
} else if ($_POST['cadastrar']) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = ($_POST['senha']);
    $projeto = $_POST['projeto'];
    $arr = array('nome' => $nome, 'email' => $email, 'senha' => $senha, 'projeto' => $projeto);
    if (!$controle->cadastraUsuario($arr)) {
        echo 'Aconteceu algum erro';
    } else {
        $projeto = $controle->verificaAcesso($email, $senha);
        if ($projeto[0]['projeto'] == 1) {
            header("Location:dashboard1.php");
        } else if ($projeto[0]['projeto'] == 2) {
            header("Location:dashboard2.php?escolha_sensor=0");
        } else if ($projeto[0]['projeto'] == 3) {
            header("Location:dashboard3.php");
        }
    }
}
