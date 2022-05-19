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
$v_rms = $_GET['v_rms'];
$i_rms = $_GET['i_rms'];
$frequencia = $_GET['frequencia'];
$pot_s = $_GET['pot_s'];
$pot_p = $_GET['pot_p'];
$pot_q = $_GET['pot_q'];
$fp = $_GET['fp'];
$diferencaFase = $_GET['diferencaFase'];

$sql = "INSERT INTO tb_dados_projeto_3 (local, v_rms, i_rms, frequencia, pot_s, pot_p, pot_q, fp, diferencaFase) VALUES (:local, :v_rms, :i_rms, :frequencia,:pot_s, :pot_p,:pot_q, :fp, :diferencaFase)";

$stmt = $PDO->prepare($sql);

$stmt->bindParam(':local', $local);
$stmt->bindParam(':v_rms', $v_rms);
$stmt->bindParam(':i_rms', $i_rms);
$stmt->bindParam(':frequencia', $frequencia);
$stmt->bindParam(':pot_s', $pot_s);
$stmt->bindParam(':pot_p', $pot_p);
$stmt->bindParam(':pot_q', $pot_q);
$stmt->bindParam(':fp', $fp);
$stmt->bindParam(':diferencaFase', $diferencaFase);

if ($stmt->execute()) {
      echo "Salvo_com_sucesso";
} else {
      echo "erro_ao_salvar";
}
