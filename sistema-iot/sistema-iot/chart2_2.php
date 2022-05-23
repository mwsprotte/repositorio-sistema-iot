<?php

$dataAtual = date('Y-m-d');
date_default_timezone_set('America/Sao_Paulo');

$pdo_2 = new PDO('mysql:host=localhost;dbname=dados-sistema-iot;port=3306; charset=utf8', 'root', '');

$sql_dados_2 = "SELECT * FROM tb_dados_projeto_2_2 WHERE date_time LIKE '%".$dataAtual."%'";

$statement_2 = $pdo_2->prepare($sql_dados_2);
$statement_2->execute();

while($results_dados_2 = $statement_2->fetch(PDO::FETCH_ASSOC)){
	$result_dados_2[] = $results_dados_2;
}

echo json_encode($result_dados_2);

?>