<?php

include 'leitura3.php';

?>

<div class="wrapper">

	<div class="row">

		<div class="col-4 col-m-6 col-sm-6">
			<div class="counter bg-primary">
				<h3>Tensão RMS</h3>
				<?php
				echo "<h3>$v_rms</h3>";
                echo "Última autualização: $horaLeitura"
				?>
				<!-- Sensor 1 -->
			</div>
		</div>

		<div class="col-4 col-m-6 col-sm-6">
			<div class="counter bg-primary">
				<h3>Corrente RMS</h3>
				<?php
				echo "<h3>$i_rms</h3>";
                echo "Última autualização: $horaLeitura"
				?>
				<!-- Sensor 1 -->
			</div>
		</div>


		<div class="col-4 col-m-6 col-sm-6">
			<div class="counter bg-primary">
				<h3>Frequência</h3>
				<?php
				echo "<h3>$frequencia</h3>";
                echo "Última autualização: $horaLeitura"
				?>
				<!-- Sensor 1 -->
			</div>
		</div>

		<div class="col-4 col-m-6 col-sm-6">
			<div class="counter bg-primary">
				<h3>Potência Aparente</h3>
				<?php
				echo "<h3>$pot_s</h3>";
                echo "Última autualização: $horaLeitura"
				?>
				<!-- Sensor 1 -->
			</div>
		</div>

		<div class="col-4 col-m-6 col-sm-6">
			<div class="counter bg-primary">
				<h3>Potência Ativa</h3>
				<?php
				echo "<h3>$pot_p</h3>";
                echo "Última autualização: $horaLeitura"
				?>
				<!-- Sensor 1 -->
			</div>
		</div>

		<div class="col-4 col-m-6 col-sm-6">
			<div class="counter bg-primary">
				<h3>Potência Reativa</h3>
				<?php
				echo "<h3>$pot_q</h3>";
                echo "Última autualização: $horaLeitura"
				?>
			</div>
		</div>

		<div class="col-4 col-m-6 col-sm-6">
			<div class="counter bg-primary">
				<h3>Fator de Potência</h3>
				<?php
				echo "<h3>$fp</h3>";
                echo "Última autualização: $horaLeitura"
				?>
			</div>
		</div>

		<div class="col-4 col-m-6 col-sm-6">
			<div class="counter bg-primary">
				<h3>Ângulo de defasagem</h3>
				<?php
				echo "<h3>$diferencaFase</h3>";
                echo "Última autualização: $horaLeitura"
				?>
			</div>
		</div>

	</div>