<?php

      try{
            $HOST = "localhost";
            $BANCO = "dados-sistema-iot";
            $USUARIO = "root";
            $SENHA = "";
            $PDO = new PDO("mysql:host=" . $HOST . ";dbname=" . $BANCO . ";charset=utf8", $USUARIO, $SENHA);
        } catch (PDOExeption $erro) {
            echo "Erro de conexão, detalhes: " . $erro->getMessage();
        }


      $local_2 = $_GET['local_2'];
      $coeficiente_2 = $_GET['coeficiente_2'];
      $deformacao_2 = $_GET['deformacao_2'];
      $deformacao_total_2 = $_GET['deformacao_total_2'];

      $sql = "INSERT INTO tb_dados_projeto_2_2 (local_2, coeficiente_2, deformacao_2, deformacao_total_2) VALUES (:local_2, :coeficiente_2, :deformacao_2, :deformacao_total_2)";

      $stmt = $PDO->prepare($sql);

      $stmt->bindParam(':local_2', $local_2);
      $stmt->bindParam(':coeficiente_2', $coeficiente_2);
      $stmt->bindParam(':deformacao_2', $deformacao_2);
      $stmt->bindParam(':deformacao_total_2', $deformacao_total_2);

      if($stmt->execute()){
            echo "Salvo_com_sucesso";
      } else {
            echo "erro_ao_salvar";
      }

?>