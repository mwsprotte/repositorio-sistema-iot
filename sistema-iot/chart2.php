<?php

$dataAtual = date('Y-m-d');
date_default_timezone_set('America/Sao_Paulo');

// $date = DateTime::createFromFormat('d-m-Y', $dataPesquisa2);
// $dataCorreta = $date->format('Y-m-d');

$pdo = new PDO('mysql:host=localhost;dbname=dados-sistema-iot;port=3306; charset=utf8', 'root', '');

// $sql_dados = "SELECT top 10 * FROM tb_dados_projeto_2 ORDER BY ID desc";
// $sql_dados = "SELECT * FROM tb_dados_projeto_2 ;";


$sql_dados = "SELECT * FROM tb_dados_projeto_2 WHERE date_time LIKE '%".$dataAtual."%'";

$statement = $pdo->prepare($sql_dados);
$statement->execute();

while($results_dados = $statement->fetch(PDO::FETCH_ASSOC)){
	$result_dados[] = $results_dados;
}

echo json_encode($result_dados);

?>