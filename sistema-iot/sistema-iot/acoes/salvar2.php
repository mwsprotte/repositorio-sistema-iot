<?php

try {
      $HOST = "localhost";
      $BANCO = "dados-sistema-iot";
      $USUARIO = "root";
      $SENHA = "";
      $PDO = new PDO("mysql:host=" . $HOST . ";dbname=" . $BANCO . ";charset=utf8", $USUARIO, $SENHA);
} catch (PDOExeption $erro) {
      echo "Erro de conexão, detalhes: " . $erro->getMessage();
}


$local = $_GET['local'];
$coeficiente = $_GET['coeficiente'];
$deformacao = $_GET['deformacao'];
$deformacao_total = $_GET['deformacao_total'];

$sql = "INSERT INTO tb_dados_projeto_2 (local, coeficiente, deformacao, deformacao_total) VALUES (:local, :coeficiente, :deformacao, :deformacao_total)";

$stmt = $PDO->prepare($sql);

$stmt->bindParam(':local', $local);
$stmt->bindParam(':coeficiente', $coeficiente);
$stmt->bindParam(':deformacao', $deformacao);
$stmt->bindParam(':deformacao_total', $deformacao_total);

if ($stmt->execute()) {
      echo "Salvo_com_sucesso";
} else {
      echo "erro_ao_salvar";
}
