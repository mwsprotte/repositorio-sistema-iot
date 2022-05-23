
<?php

$dataAtual = date('Y-m-d');
date_default_timezone_set('America/Sao_Paulo');

// EXCLUO OS DADOS COLETADOS NA DATA ATUAL PARA O SENSOR 1
$strcon = mysqli_connect('localhost','root','','dados-sistema-iot');
$sql = "DELETE FROM tb_dados_projeto_3 WHERE date_time LIKE '%" . $dataAtual . "%' ORDER BY date_time DESC";
mysqli_query($strcon,$sql) or die("Erro ao tentar excluir registro");
mysqli_close($strcon);

header('Location: gerenciar3.php');

?> 
