<?php
    session_start();
	Class Conexao{
        private $server = "localhost";
        private $usuario = "root";
        private $senha = "";
        private $banco = "dados-sistema-iot";


        public function conectar(){
            try{
                $conexao = new PDO("mysql:host=$this->server;dbname=$this->banco", $this->usuario, $this->senha);
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $erro){
                $conexao = null;
            }

            return $conexao;
        }
	}
?>




<?php
	
	//------------------

	//Testo se existe uma data pesquisada. Caso contrário uso a data atual

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$dataPesquisa = $_POST['data'];
		$dataArray = explode("-", $dataPesquisa);
        $dataPesquisa = $dataArray[0] . "-" . $dataArray[1];

        $query = "SELECT * FROM tb_dados WHERE date_time LIKE '%" . $dataPesquisa . "%' ORDER BY date_time DESC";
	}

    else{

        $dataAtual = date('Y-m');
        $query = "SELECT * FROM tb_dados WHERE date_time LIKE '%" . $dataAtual . "%' ORDER BY date_time DESC";
    }

    
	$conexaoClass = new Conexao();
	$conexao = $conexaoClass->conectar();
	// $adm  = $_SESSION["usuario"][1];
	// $nome = $_SESSION["usuario"];

	$stmt = $conexao->prepare($query);
	$stmt->execute();
	$linha = $stmt->fetch(PDO::FETCH_OBJ);

	//------------------

	


	// DECLARAÇÃO DAS VARIÁVEIS GLOBAIS PARA LEITURA DE TENSAO E CORRENTE:

	$ftcorrente = 0.02203023758; // Fator de multiplicação de acordo com a máxima corrente a ser medida
	$fttensao = 0.6683359375; // Fator de multiplicação de acordo com a máxima tensão a ser medida
	$nivel_CC = 0.13;

	//Definição de variáveis


	if($linha->tensao == ""){
		$tensao = 0;
	} else {
		$tensao = $linha->tensao;
	}

	if($linha->corrente == ""){
		$corrente = 0;
	} else {
		$corrente = $linha->corrente;
	}

	if($linha->frequencia == ""){
		$frequencia = 0;
	} else {
		$frequencia = $linha->frequencia;
	}
		
	$valor_corrente_RMS = 0;
	$valor_tensao_RMS = 0;
	$potencia = 0;
	$valor_Pativa = 0;
	$valor_Preativa = 0;
	$valor_Paparente = 0;

	//------------------

	//Integração

	for($a = 0; $a < 1000; $a++ ){
		$valor_corrente_real = ($corrente * $ftcorrente) - ($nivel_CC * $ftcorrente); 
		$valor_tensao_real = ($tensao * $fttensao) - ($nivel_CC * $fttensao);
		$potencia = $potencia + ($valor_corrente_real * $valor_tensao_real);
		$valor_corrente_RMS = $valor_corrente_RMS + ($valor_corrente_real**2);
		$valor_tensao_RMS = $valor_tensao_RMS + ($valor_tensao_real**2);
	}
	
	//------------------

	//Cálculos finais e correções de leitura

	$valor_corrente_RMS = sqrt($valor_corrente_RMS/1000);
	$valor_tensao_RMS = sqrt($valor_tensao_RMS/1000);
	$valor_Pativa = ($potencia/1000);
	$valor_Paparente = $valor_corrente_RMS * $valor_tensao_RMS;
	$FP = $valor_Pativa / $valor_Paparente;
	$valor_Preativa = sqrt(($valor_Paparente**2) - ($valor_Pativa**2));
	$energia_ativa = (($valor_Pativa*0.000517)/(1000*3600)); // primeiro valor tentado: 0.00052; segundo valor 0.000515
	$energia_aparente = (($valor_Paparente*0.000517)/(1000*3600)); // primeiro valor tentado: 0.00052; segundo valor 0.000515
	$energia_reativa = (($valor_Preativa*0.000517)/(1000*3600)); // primeiro valor tentado: 0.00052; segundo valor 0.000515

	//------------------
?>


<html>
<head>
	<title>Monitoramento de Dados Energéticos</title>

	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="icon" type="image/png" href="./assets/logo.png" />


	<!-- Import lib -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
	<link rel="stylesheet" type="text/css" href="./fontawesome-free/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<!-- End import lib -->
	
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body class="overlay-scrollbar">
	<!-- navbar -->
	<div class="navbar">	
		<!-- nav left -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link">
					<i class="fas fa-bars" onclick="collapseSidebar()"></i>
				</a>
			</li>
			<li class="nav-item">
				<img src="assets/logo-dark.png" alt="Sensoriamento logo" class="logo logo-light">
				<img src="assets/logo-light.png" alt="Sensoriamento logo" class="logo logo-dark">
			</li>
		</ul>
		<!-- end nav left -->
		<!-- nav right -->
		<ul class="navbar-nav nav-right">

			<li class="nav-item mode">
				<a class="nav-link" href="#">
					<span><?php echo 'Monitoramento de Dados Energéticos'?></span>
				</a>
			</li>

			<li class="nav-item mode">
				<a class="nav-link" href="#" onclick="switchTheme()">
					<i class="fas fa-moon dark-icon"></i>
					<i class="fas fa-sun light-icon"></i>
				</a>
			</li>

			<li class="nav-item avt-wrapper">
				<div class="avt dropdown">
					<img src="assets/tuat.jpg" alt="fas fa-user-tie" class="dropdown-toggle" data-toggle="user-menu">
					<ul id="user-menu" class="dropdown-menu">
						<li class="dropdown-menu-item">
							<a class="dropdown-menu-link">
								<div>
									<i class="fas fa-user-tie"></i>
								</div>
								<span>Perfil</span>
							</a>
						</li>
						<li class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="fas fa-cog"></i>
								</div>
								<span>Configurações</span>
							</a>
						</li>
						<li class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="fas fa-chart-line"></i>
								</div>
								<span>Relatórios</span>
							</a>
						</li>
						<li class="dropdown-menu-item">
							<a href="acoes/logout.php" class="dropdown-menu-link">
								<div>
									<i class="fas fa-sign-out-alt"></i>
								</div>
								<span>Sair</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
		<!-- end nav right -->
	</div>
	<!-- end navbar -->
	<!-- sidebar -->
	<div class="sidebar">
		<ul class="sidebar-nav">
			<li class="sidebar-nav-item">
				<a href="#" class="sidebar-nav-link active">
					<div>
						<i class="fas fa-tachometer-alt"></i>
					</div>
					<span>Dashboard</span>
				</a>
			</li>
			<li class="sidebar-nav-item">
				<a href="#" class="sidebar-nav-link">
					<div>
						<i class="fas fa-tasks"></i>
					</div>
					<span>Gerenciar</span>
				</a>
			</li>
			<li class="sidebar-nav-item">
				<a href="#" class="sidebar-nav-link">
					<div>
						<i class="fas fa-chart-line"></i>
					</div>
					<span>Relatórios</span>
				</a>
			</li>
			<li class="sidebar-nav-item">
				<a href="acoes/logout.php" class="sidebar-nav-link">
					<div>
						<i class="fas fa-sign-out-alt"></i>
					</div>
					<span>Sair</span>
				</a>
			</li>
		</ul>
	</div>
	<!-- end sidebar -->
	<!-- main content -->
	<div class="wrapper">


		<div class="row">
			<div class="col-6 col-m-6 col-sm-6">
				<div class="counter bg-primary">
					<form action="" method="post">
                        <p>
                        <label for="inputDate">Insira ou selecione uma data:</label>
                        </p>
		                <input id="inputDate" type="date" name="data">
		                <input type="submit" name="submit" value="Buscar">
	                </form>
				</div>
			</div>
			<div class="col-6 col-m-6 col-sm-6">
				<div class="counter bg-primary">
					<h3>CAMPO PARA A DATA</h3>
				</div>
			</div>
		</div>




		<div class="row">
			<div class="col-3 col-m-6 col-sm-6">
				<div class="counter bg-primary">
					<h3>Tensão</h3>
					<?php 
						echo"<h1>" . round($valor_tensao_RMS, 2) . "</h1>";                        
                    ?>
					<p>VOLTS</p>
				</div>
			</div>
			<div class="col-3 col-m-6 col-sm-6">
				<div class="counter bg-warning">
					<h3>Corrente</h3>
					<?php 
						echo"<h1>" . round($valor_corrente_RMS, 2) . "</h1>";                        
                    ?>
					<p>AMPÈRE</p>
				</div>
			</div>
			<div class="col-3 col-m-6 col-sm-6">
				<div class="counter bg-success">
					<h3>Frequência</h3>
					<?php 
						echo"<h1>" . round($frequencia, 2) . "</h1>";
                    ?>
					<p>HERTZ</p>
				</div>
			</div>
			<div class="col-3 col-m-6 col-sm-6">
				<div class="counter bg-danger">
					<h3>Energia Ativa</h3>
					<?php 
						echo"<h1>" . round($energia_ativa, 8) . "</h1>";						
					?>
					<p>WATTS</p>
				</div>
			</div>
		</div>



		



		<div class="row">
			<div class="col-3 col-m-6 col-sm-6">
				<div class="counter bg-primary">
					<h3>Potência Ativa</h3>
					<?php 
						echo"<h1>" . round($valor_Pativa, 2) . "</h1>";						
					?>
					<p>WATTS</p>
				</div>
			</div>
			<div class="col-3 col-m-6 col-sm-6">
				<div class="counter bg-warning">
					<h3>Potência Reativa</h3>
					<?php 
						echo"<h1>" . round($valor_Preativa, 8) . "</h1>";						
					?>
					<p>WATTS</p>
				</div>
			</div>
			<div class="col-3 col-m-6 col-sm-6">
				<div class="counter bg-success">
					<h3>Potência Aparente</h3>
					<?php 
						echo"<h1>" . round($valor_Paparente, 2) . "</h1>";						
					?>
					<p>WATTS</p>
				</div>
			</div>
			<div class="col-3 col-m-6 col-sm-6">
				<div class="counter bg-danger">
					<h3>Fator de Potência</h3>
					<?php 
						echo"<h1>" . round($FP, 2) . "</h1>";						
					?>
					<p>kVAr</p>
				</div>
			</div>
		</div>

		<!-- --------------- -->

		<div class="row">
			
		<div class="col-6 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3>
							TENSÃO
						</h3>
					</div>
					<div class="card-content">
						<canvas id="tensaoChart"></canvas>
					</div>
				</div>
			</div>

			<div class="col-6 col-m-10 col-sm-10">
				<div class="card">
					<div class="card-header">
						<h3>
							CORRENTE
						</h3>
					</div>
					<div class="card-content">
						<canvas id="correnteChart"></canvas>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-6 col-m-10 col-sm-10">
				<div class="card">
					<div class="card-header">
						<h3>
							FREQUÊNCIA
						</h3>
					</div>
					<div class="card-content">
						<canvas id="frequenciaChart"></canvas>
					</div>
				</div>
			</div>

			<div class="col-6 col-m-10 col-sm-10">
				<div class="card">
					<div class="card-header">
						<h3>
							CONSUMO
						</h3>
					<div class="card-content">
						<canvas id="consumoChart"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end main content -->
	<!-- import script -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script src="./script/index.js"></script>
	<!-- end import script -->
</body>
</html>

<!--<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="style/dashboard.css" />
        <title>Dashboard - <?php/* echo $nome; ?></title>
    </head>
    <body>
        <header>
            <div id="content">
                <div id="user">
                    <span><?php echo $adm ? $nome." (ADM)" : $nome; ?></span>
                </div>
                <span class="logo">Sistema de acesso</span>
                <div id="logout">
                    <a href="acoes/logout.php"><button>Sair</button></a>
                </div>
            </div>
        </header>


       <div id="content">
            <?php if($adm): ?>
                <div id="tabelaUsuarios">
                    <span class="title">Dados Coletados</span>

                    <form action="" method="post">
                        <p>
                        <label for="inputDate">Insira ou selecione uma data:</label>
                        </p>
		                <input id="inputDate" type="date" name="data">
		                <input type="submit" name="submit" value="Buscar">
	                </form>

                    <table>

                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Local</td>
                                <td>Tensão</td>
                                <td>Corrente</td>
                                <td>Frequencia</td>
                                <td>Data|Hora</td>
                                <td>Excluir</td>
                            </tr>                
                        </thead>
                        
                        <tbody>
                        
                            <?php
                                
                                if($_SERVER['REQUEST_METHOD'] == "POST"){

                                    $dataPesquisa = $_POST['data'];
                                    $dataArray = explode("-", $dataPesquisa);
                                    $dataPesquisa = $dataArray[0] . "-" . $dataArray[1];

                                    $query = "SELECT * FROM tb_dados WHERE date_time LIKE '%" . $dataPesquisa . "%'";
                                }

                                else{

                                    $dataAtual = date('Y-m');
                                    $query = "SELECT * FROM tb_dados WHERE date_time LIKE '%" . $dataAtual . "%'";
                                }
                        
                                $stmt = $conexao->prepare($query);
                                $stmt->execute();

                                while($linha = $stmt->fetch(PDO::FETCH_OBJ)){
                                    
                                    echo"<tr>";
                                    echo"<td>" . $linha->ID . "</td>";
                                    echo"<td>" . $linha->local . "</td>";
                                    echo"<td>" . $linha->tensao . "</td>";
                                    echo"<td>" . $linha->corrente . "</td>";
                                    echo"<td>" . $linha->frequencia . "</td>";
                                    echo"<td>" . $linha->date_time . "</td>";
                                    echo"<td><button>Excluir</button></td>";
                                    echo"</tr>";
                                }
                            ?>
                            
                        </tbody>            
                    </table>
                </div>
            <?php endif; ?>
        </div>        
    </body>
</html>








