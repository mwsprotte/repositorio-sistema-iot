<?php

// CONECTA O DASHBOARD AO BANCO DE DADOS
class Conexao
{
	private $server = "localhost";
	private $usuario = "root";
	private $senha = "";
	private $banco = "dados-sistema-iot";

	public function conectar()
	{
		try {
			$conexao = new PDO("mysql:host=$this->server;dbname=$this->banco", $this->usuario, $this->senha);
			$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $erro) {
			$conexao = null;
		}
		return $conexao;
	}
}

$conexaoClass = new Conexao();
$conexao = $conexaoClass->conectar();

/* OBTEM A DATA ATUAL PARA REQUISITAR OS DADOS */
$dataAtual = date('Y-m-d');
date_default_timezone_set('America/Sao_Paulo');
$query = "SELECT * FROM tb_dados_projeto_3 WHERE date_time LIKE '%" . $dataAtual . "%' ORDER BY date_time DESC";

$stmt = $conexao->prepare($query);
$stmt->execute();
$linha = $stmt->fetch(PDO::FETCH_OBJ);

date_default_timezone_set('America/Sao_Paulo');
$dataLeitura =  date('d/m/Y \à\s H:i:s');
$dataChart = date('d/m/y');
$horaLeitura =  date('H:i:s');


// VERIFICA SE EXISTEM DADOS PARA O SENSOR 1
$conn = mysqli_connect("localhost", "root", "", "dados-sistema-iot");
$sql = "SELECT * FROM tb_dados_projeto_3 WHERE date_time LIKE '%" . $dataAtual . "%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

	//OBTEM OS ULTIMOS REGISTROS DO SENSOR 1
	$sql = "SELECT MAX(ID) as ID FROM tb_dados_projeto_3";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();

	$ultimo_id = $row['ID'];

	$sql = "SELECT v_rms FROM tb_dados_projeto_3 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$v_rms = "" . $row['v_rms'] . " V";

	$sql = "SELECT i_rms FROM tb_dados_projeto_3 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$i_rms = "" . $row['i_rms'] . " A";

	$sql = "SELECT frequencia FROM tb_dados_projeto_3 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$frequencia = "" . $row['frequencia'] . " Hz";

	$sql = "SELECT pot_s FROM tb_dados_projeto_3 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$pot_s = "" . $row['pot_s'] . " VA";

	$sql = "SELECT pot_p FROM tb_dados_projeto_3 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$pot_p = "" . $row['pot_p'] . " W";

	$sql = "SELECT pot_q FROM tb_dados_projeto_3 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$pot_q = "" . $row['pot_q'] . " VAR";

	$sql = "SELECT fp FROM tb_dados_projeto_3 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$fp = "" . $row['fp'] . "";

	$sql = "SELECT diferencaFase FROM tb_dados_projeto_3 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$diferencaFase = "" . $row['diferencaFase'] . " °";
} else {

	/* CASO NÃO TENHA DADOS, ENVIA UM " - " */
	$v_rms = "-";
	$i_rms = "-";
	$frequencia = "-";
	$pot_s = "-";
	$pot_p = "-";
	$pot_q = "-";
	$fp = "-";
	$diferencaFase = "-";
}
