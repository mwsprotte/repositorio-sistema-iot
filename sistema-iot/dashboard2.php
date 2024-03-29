<?php
/* VERIFICANDO A ESCOLHA DO SENSOR */
$escolha_sensor = $_GET['escolha_sensor'];

// ATUALIZANFO INFORMAÇÕES A RESPEITO DE DATA E HORÁRIO
date_default_timezone_set('America/Sao_Paulo');
$dataLeitura =  date('d/m/Y \à\s H:i:s');
$dataChart = date('d/m/y');
?>

<!-- MONTANDO O DASHBOARD -->
<html>

<head>
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="icon" type="image/png" href="./assets/logo.png" />

	<!-- INPORTANDO BIBLIOTECAS LOCAIS -->
	<link rel="stylesheet" type="text/css" href="style/Chart.js_2.9.3.css">
	<link rel="stylesheet" type="text/css" href="./fontawesome-free/css/all.min.css">
	<link href="style/Roboto-display.css" rel="stylesheet">
	<script src="style/kit_fontawesome.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="./style.css">
	<script src="script/jQuery_Alterado.js"></script>

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
				<img src="assets/logo-dark.png" alt="Sensoria =ento logo" class="logo logo-light">
				<img src="assets/logo-light.png" alt="Sensoria =ento logo" class="logo logo-dark">
			</li>
		</ul>
		<!-- end nav left -->
		<!-- nav right -->
		<ul class="navbar-nav nav-right">

			<li class="nav-item mode">
				<a class="nav-link">
					<span>
						<?php echo "Deformação de Rotores em $dataChart"; ?>

					</span>
				</a>
			</li>

			<li class="nav-item mode">
				<a class="nav-link" onclick="switchTheme()">
					<i class="fas fa-moon dark-icon"></i>
					<i class="fas fa-sun light-icon"></i>
				</a>
			</li>

			<li class="nav-item avt-wrapper">
				<div class="avt dropdown">
					<img src="assets/tuat.jpg" alt="fas fa-user-tie" class="dropdown-toggle" data-toggle="user-menu">
					<ul id="user-menu" class="dropdown-menu">
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
				<a class="sidebar-nav-link active">
					<div>
						<i class="fas fa-tachometer-alt"></i>
					</div>
					<span>Dashboard</span>
				</a>
			</li>
			<li class="sidebar-nav-item">
				<a href="gerenciar2.php" class="sidebar-nav-link">
					<div>
						<i class="fas fa-tasks"></i>
					</div>
					<span>Gerenciar</span>
				</a>
			</li>
			<li class="sidebar-nav-item">
				<a href="relatorios2.php" class="sidebar-nav-link">
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



	<!-- IMPORTA OS GRÁFICOS COM BASE NA ESCOLHA DO SENSOR -->
	<?php if ($escolha_sensor == 1) : ?>
		<script>
			$(document).ready(function() {
				$("#div_refresh").load("cards_2_1.php");
				setInterval(function() {
					$("#div_refresh").load("cards_2_1.php");
				}, 1000);
				// O NÚMERO ACIMA É O TEMPO EM MILISSEGUNDOS DA ATUALIZAÇÃO DOS DADOS
			});
		</script>

		<!-- IMPORTA OS CARDS COM AS LEITURAS EM TEMPO REAL -->
		<div id="div_refresh"></div>

		<div class="wrapper_2">
			<!-- main content -->
			<div class="col-12 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header" style="text-align: center;">
						<?php
						echo "<h3>Variação do Coeficiente de Deformação  µ - Sensor 1 ";
						?>
						<button onClick="window.location.reload();"> ↻ </button></h3>
					</div>
					<div class="card-content">
						<canvas id="coeficienteChart"></canvas>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-m-12 col-sm-12">
					<div class="card">
						<div class="card-header" style="text-align: center;">
							<?php
							echo "<h3>Variação de Deformacão em (nm) - Sensor 1";
							?>
							<button onClick="window.location.reload();"> ↻ </button></h3>
						</div>
						<div class="card-content">
							<canvas id="deformacaoChart"></canvas>
						</div>
					</div>
				</div>
			</div>


	<?php elseif ($escolha_sensor == 2) : ?>

		<script>
			$(document).ready(function() {
				$("#div_refresh").load("cards_2_2.php");
				setInterval(function() {
					$("#div_refresh").load("cards_2_2.php");
				}, 1000);
				// O NÚMERO ACIMA É O TEMPO EM MILISSEGUNDOS DA ATUALIZAÇÃO DOS DADOS
			});
		</script>

		<!-- IMPORTA OS CARDS COM AS LEITURAS EM TEMPO REAL -->
		<div id="div_refresh"></div>

		<div class="wrapper_2">

		<div class="col-12 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header" style="text-align: center;">
						<?php
						echo "<h3>Variação do Coeficiente de Deformação  µ - Sensor 2";
						?>
						<button onClick="window.location.reload();"> ↻ </button></h3>
					</div>
					<div class="card-content">
						<canvas id="coeficiente_2Chart"></canvas>
					</div>
				</div>
			</div>



			<div class="row">
				<div class="col-12 col-m-12 col-sm-12">
					<div class="card">
						<div class="card-header" style="text-align: center;">
							<?php
							echo "<h3>Variação de Deformacão (nm) - Sensor 2";
							?>
							<button onClick="window.location.reload();"> ↻ </button></h3>
						</div>
						<div class="card-content">
							<canvas id="deformacao_2Chart"></canvas>
						</div>
					</div>
				</div>
			</div>

		</div>

	<?php else : ?>

		<script>
			$(document).ready(function() {
				$("#div_refresh").load("cards_2_0.php");
				setInterval(function() {
					$("#div_refresh").load("cards_2_0.php");
				}, 1000);
				// O NÚMERO ACIMA É O TEMPO EM MILISSEGUNDOS DA ATUALIZAÇÃO DOS DADOS
			});
		</script>

		<!-- IMPORTA OS CARDS COM AS LEITURAS EM TEMPO REAL -->
		<div id="div_refresh"></div>

		<div class="wrapper_2">
			<!-- main content -->
			<div class="col-12 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header" style="text-align: center;">
						<?php
						echo "<h3>Variação do Coeficiente de Deformação  µ - Sensor 1 ";
						?>
						<button onClick="window.location.reload();"> ↻ </button></h3>
					</div>
					<div class="card-content">
						<canvas id="coeficienteChart"></canvas>
					</div>
				</div>
			</div>

			<div class="col-12 col-m-12 col-sm-12">
				<div class="card">
					<div class="card-header" style="text-align: center;">
						<?php
						echo "<h3>Variação do Coeficiente de Deformação  µ - Sensor 2";
						?>
						<button onClick="window.location.reload();"> ↻ </button></h3>
					</div>
					<div class="card-content">
						<canvas id="coeficiente_2Chart"></canvas>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-m-12 col-sm-12">
					<div class="card">
						<div class="card-header" style="text-align: center;">
							<?php
							echo "<h3>Variação de Deformacão em (nm) - Sensor 1";
							?>
							<button onClick="window.location.reload();"> ↻ </button></h3>
						</div>
						<div class="card-content">
							<canvas id="deformacaoChart"></canvas>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-m-12 col-sm-12">
					<div class="card">
						<div class="card-header" style="text-align: center;">
							<?php
							echo "<h3>Variação de Deformacão (nm) - Sensor 2";
							?>
							<button onClick="window.location.reload();"> ↻ </button></h3>
						</div>
						<div class="card-content">
							<canvas id="deformacao_2Chart"></canvas>
						</div>
					</div>
				</div>
			</div>

		</div>

	<?php endif; ?>

</html>


<html>
<!-- end main content -->
<!-- import script -->
<script src="script/ajax_jquery_3.4.1.js"></script>
<script src="script/Chart.js_2.9.3.js"></script>
<script src="./script/index2.js"></script>
<!-- end import script -->
</body>

</html>