<!--**
 * @author Cesar Szpak - Celke -   cesar@celke.com.br, aprimorado por Matheus Willian Sprotte
 * @pagina desenvolvida usando framework bootstrap,
 * o código é aberto e o uso é free,
 * porém lembre -se de conceder os créditos ao desenvolvedor.
 *-->
 <?php

    $dataPesquisa = $_POST['data'];
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
		$html .= '<td colspan="10">Planilha de dados coletados | Smart Meter</tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>ID</b></td>';
		$html .= '<td><b>Tesão RMS</b></td>';
		$html .= '<td><b>Corrente RMS</b></td>';
		$html .= '<td><b>Frequência</b></td>';
		$html .= '<td><b>Potência Aparente</b></td>';
		$html .= '<td><b>Potência Ativa</b></td>';
		$html .= '<td><b>Potência Reativa</b></td>';
		$html .= '<td><b>Fator de Potência</b></td>';
		$html .= '<td><b>Ângulo de defasagem</b></td>';
		$html .= '<td><b>Instante</b></td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela 
		$historico = "SELECT * FROM tb_dados_projeto_3 WHERE date_time LIKE '%".$dataPesquisa."%'";
		$resultado_historico = mysqli_query($conn , $historico);
		
		while($row_historico = mysqli_fetch_assoc($resultado_historico)){
			$html .= '<tr>';
			$html .= '<td>'.$row_historico["ID"].'</td>';
			$html .= '<td>'.$row_historico["v_rms"].'</td>';
			$html .= '<td>'.$row_historico["i_rms"].'</td>';
			$html .= '<td>'.$row_historico["frequencia"].'</td>';
            $html .= '<td>'.$row_historico["pot_s"].'</td>';
			$html .= '<td>'.$row_historico["pot_p"].'</td>';
			$html .= '<td>'.$row_historico["pot_q"].'</td>';
			$html .= '<td>'.$row_historico["fp"].'</td>';
			$html .= '<td>'.$row_historico["diferencaFase"].'</td>';
			$html .= '<td>'.$row_historico["date_time"].'</td>';
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