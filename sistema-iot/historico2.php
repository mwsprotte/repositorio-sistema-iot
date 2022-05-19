<!--**
 * @author Cesar Szpak - Celke -   cesar@celke.com.br, aprimorado por Matheus Willian Sprotte
 * @pagina desenvolvida usando framework bootstrap,
 * o código é aberto e o uso é free,
 * porém lembre -se de conceder os créditos ao desenvolvedor.
 *-->
 <?php

    $dataPesquisa = $_POST['data'];

    // echo $dataPesquisa;
    // $date = DateTime::createFromFormat('d-m-Y', $dataPesquisa);
    // $dataCorreta = $date->format('Y-m-d');

	// CONECTA O Histórico AO BANCO DE DADOS

    // session_start();
	// Class Conexao{
    //     private $server = "localhost";
    //     private $usuario = "root";
    //     private $senha = "";
    //     private $banco = "dados-sistema-iot";


    //     public function conectar(){
    //         try{
    //             $conexao = new PDO("mysql:host=$this->server;dbname=$this->banco", $this->usuario, $this->senha);
    //             $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         }catch(PDOException $erro){
    //             $conexao = null;
    //         }

    //         return $conexao;
    //     }
	// }

	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "dados-sistema-iot";
	
	//Criar a conexão
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
?>


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Historico</title>
	<head>
	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		// $arquivo = 'Histórico.xls';
		$arquivo = "Histórico_".$dataPesquisa.".xls";
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Planilha Dados coletados - Sensor 1</tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>ID</b></td>';
		$html .= '<td><b>Coeficiente</b></td>';
		$html .= '<td><b>Deformacao</b></td>';
		$html .= '<td><b>Deformacao Total</b></td>';
		$html .= '<td><b>Instante</b></td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela 
		$historico = "SELECT * FROM tb_dados_projeto_2 WHERE date_time LIKE '%".$dataPesquisa."%'";
		$resultado_historico = mysqli_query($conn , $historico);
		
		while($row_historico = mysqli_fetch_assoc($resultado_historico)){
			$html .= '<tr>';
			$html .= '<td>'.$row_historico["ID"].'</td>';
			$html .= '<td>'.$row_historico["coeficiente"].'</td>';
			$html .= '<td>'.$row_historico["deformacao"].'</td>';
			$html .= '<td>'.$row_historico["deformacao_total"].'</td>';
            $html .= '<td>'.$row_historico["date_time"].'</td>';
			// $data = date('d/m/Y H:i:s',strtotime($row_historico["created"]));
			// $html .= '<td>'.$data.'</td>';
			$html .= '</tr>';
			;
		}

		$html .= '</tr>';
		$html .= '</tr>';
		$html .= '<td colspan="5">Planilha Dados coletados - Sensor 2</tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>ID</b></td>';
		$html .= '<td><b>Coeficiente</b></td>';
		$html .= '<td><b>Deformacao</b></td>';
		$html .= '<td><b>Deformacao Total</b></td>';
		$html .= '<td><b>Instante</b></td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela 
		$historico = "SELECT * FROM tb_dados_projeto_2_2 WHERE date_time LIKE '%".$dataPesquisa."%'";
		$resultado_historico = mysqli_query($conn , $historico);
		
		while($row_historico = mysqli_fetch_assoc($resultado_historico)){
			$html .= '<tr>';
			$html .= '<td>'.$row_historico["ID"].'</td>';
			$html .= '<td>'.$row_historico["coeficiente_2"].'</td>';
			$html .= '<td>'.$row_historico["deformacao_2"].'</td>';
			$html .= '<td>'.$row_historico["deformacao_total_2"].'</td>';
            $html .= '<td>'.$row_historico["date_time"].'</td>';
			// $data = date('d/m/Y H:i:s',strtotime($row_historico["created"]));
			// $html .= '<td>'.$data.'</td>';
			$html .= '</tr>';
			;
		}

		// Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $html;
		exit; ?>
	</body>
</html>