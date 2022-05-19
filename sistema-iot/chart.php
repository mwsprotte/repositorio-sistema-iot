<?php

$pdo = new PDO('mysql:host=localhost;dbname=dados-sistema-iot;port=3306; charset=utf8', 'root', '');

$sql_dados = "SELECT * FROM tb_dados";

//$sql_locais = "SELECT DISTINCT tb_dados.local FROM tb_dados";

$statement = $pdo->prepare($sql_dados);
$statement->execute();

while($results_dados = $statement->fetch(PDO::FETCH_ASSOC)){

	$result_dados[] = $results_dados;
}


//$statement = $pdo->prepare($sql_locais);
//$statement->execute();

//while($results_locais = $statement->fetch(PDO::FETCH_ASSOC)){

	//$result_locais[] = $results_locais;
//}

//transforma array em arquivo json

//$tam [] = count($result_locais);

//$dados = array_merge($tam, $result_locais, $result_dados);

//var_dump($dados);

echo json_encode($result_dados);

?>