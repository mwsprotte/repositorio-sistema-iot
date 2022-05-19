<?php

// ATUALIZANFO INFORMAÇÕES A RESPEITO DE DATA E HORÁRIO
date_default_timezone_set('America/Sao_Paulo');
$dataLeitura =  date('d/m/Y \à\s H:i:s');
$dataChart = date('d/m/y');

?>


<html>

<head>
	<title>Gerenciar</title>

	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="icon" type="image/png" href="./assets/logo.png" />


	<!-- INPORTANDO BIBLIOTECAS LOCAIS -->
	<link rel="stylesheet" type="text/css" href="style/Chart.js_2.9.3.css">
	<link rel="stylesheet" type="text/css" href="./fontawesome-free/css/all.min.css">
	<link href="style/Roboto-display.css" rel="stylesheet">
	<script src="style/kit_fontawesome.js" crossorigin="anonymous"></script>
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
				<a href="dashboard2.php?escolha_sensor=0" class="sidebar-nav-link ">
					<div>
						<i class="fas fa-tachometer-alt"></i>
					</div>
					<span>Dashboard</span>
				</a>
			</li>
			<li class="sidebar-nav-item">
				<a href="gerenciar2.php" class="sidebar-nav-link ">
					<div>
						<i class="fas fa-tasks"></i>
					</div>
					<span>Gerenciar</span>
				</a>
			</li>
			<li class="sidebar-nav-item">
				<a class="sidebar-nav-link active">
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


			<div class="col-4 col-m-6 col-sm-6">
				<div class="counter bg-success">
					<form action="historico2.php" method="post">
						<p>
							<label for="inputDate">
								<h3>Histórico de dados:</h3>
							</label>
						</p>
						<input id="inputDate" type="date" name="data">
						<input type="submit" name="submit" value="Baixar arquivo .xls">
					</form>
				</div>
			</div>

		</div>



	</div>
	<!-- end main content -->
	<!-- import script -->
	<script src="script/ajax_jquery_3.4.1.js"></script>
	<script src="script/Chart.js_2.9.3.js"></script>
	<script src="./script/index2.js"></script>
	<!-- end import script -->
</body>

</html>