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


      $local = $_GET['local'];
      $tensao = $_GET['tensao'];
      $corrente = $_GET['corrente'];
      $frequencia = $_GET['frequencia'];

      $sql = "INSERT INTO tb_dados (local, tensao, corrente, frequencia) VALUES (:local, :tensao, :corrente, :frequencia)";

      $stmt = $PDO->prepare($sql);

      $stmt->bindParam(':local', $local);
      $stmt->bindParam(':tensao', $tensao);
      $stmt->bindParam(':corrente', $corrente);
      $stmt->bindParam(':frequencia', $frequencia);

      if($stmt->execute()){
            echo "Salvo_com_sucesso";
      } else {
            echo "erro_ao_salvar";
      }

?>