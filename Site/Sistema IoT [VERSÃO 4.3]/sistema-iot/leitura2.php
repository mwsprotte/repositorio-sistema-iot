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
// $adm  = $_SESSION["usuario"][1];
// $nome = $_SESSION["usuario"];

// if($_SERVER['REQUEST_METHOD'] == "POST")
// {
// 	$dataPesquisa = $_POST['data'];
// 	$dataArray = explode("-", $dataPesquisa);
//     $dataPesquisa = $dataArray[0] . "-" . $dataArray[1];

//     $query = "SELECT * FROM tb_dados_projeto_2 WHERE date_time LIKE '%" . $dataPesquisa . "%' ORDER BY date_time DESC";
// }

// else
// {
$dataAtual = date('Y-m-d');
date_default_timezone_set('America/Sao_Paulo');
$query = "SELECT * FROM tb_dados_projeto_2 WHERE date_time LIKE '%" . $dataAtual . "%' ORDER BY date_time DESC";
// }

$stmt = $conexao->prepare($query);
$stmt->execute();
$linha = $stmt->fetch(PDO::FETCH_OBJ);

date_default_timezone_set('America/Sao_Paulo');
$dataLeitura =  date('d/m/Y \à\s H:i:s');
$dataChart = date('d/m/y');
$horaLeitura =  date('H:i:s');


// VERIFICA SE EXISTEM DADOS PARA O SENSOR 1
$conn = mysqli_connect("localhost", "root", "", "dados-sistema-iot");
$sql = "SELECT * FROM tb_dados_projeto_2 WHERE date_time LIKE '%" . $dataAtual . "%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	//OBTEM OS ULTIMOS REGISTROS DO SENSOR 1
	$sql = "SELECT MAX(ID) as ID FROM tb_dados_projeto_2";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();

	$ultimo_id = $row['ID'];

	$sql = "SELECT coeficiente FROM tb_dados_projeto_2 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	// $coeficiente = $row['coeficiente'];
	// $arquivo = "Histórico_".$dataPesquisa.".xls";

	$coeficiente = "" . $row['coeficiente'] . " E-3";

	$sql = "SELECT deformacao FROM tb_dados_projeto_2 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$deformacao = "" . $row['deformacao'] . " nm";

	$sql = "SELECT deformacao_total FROM tb_dados_projeto_2 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$deformacao_total = "" . $row['deformacao_total'] . " nm";
} else {
	$coeficiente = "-";
	$deformacao = "-";
	$deformacao_total = "-";
}

// VERIFICA SE EXISTEM DADOS PARA O SENSOR 2
$conn = mysqli_connect("localhost", "root", "", "dados-sistema-iot");
$sql = "SELECT * FROM tb_dados_projeto_2_2 WHERE date_time LIKE '%" . $dataAtual . "%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	//OBTEM OS ULTIMO REGISTROS DO SENSOR 2
	$sql = "SELECT MAX(ID) as ID FROM tb_dados_projeto_2_2";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();

	$ultimo_id = $row['ID'];

	$sql = "SELECT coeficiente_2 FROM tb_dados_projeto_2_2 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$coeficiente_2 = "" . $row['coeficiente_2'] . " E-6";

	$sql = "SELECT deformacao_2 FROM tb_dados_projeto_2_2 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$deformacao_2 = "" . $row['deformacao_2'] . " nm";

	$sql = "SELECT deformacao_total_2 FROM tb_dados_projeto_2_2 WHERE ID='$ultimo_id' AND date_time LIKE '%" . $dataAtual . "%'";
	$sql = $conexao->query($sql);
	$row = $sql->fetch();
	$deformacao_total_2 = "" . $row['deformacao_total_2'] . " nm";
} else {
	$coeficiente_2 = "-";
	$deformacao_2 = "-";
	$deformacao_total_2 = "-";
}
?>