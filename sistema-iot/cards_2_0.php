<?php

include 'leitura2.php';

?>

<div class="wrapper">

		<div class="row">
			<div class="col-4 col-m-6 col-sm-6">
				<div class="counter bg-primary">
					<h3>Coef. de Deformação - Sensor 1</h3>
					<?php
					echo "<h3>$coeficiente</h3>";
					echo "Última autualização: $horaLeitura"
					?>
					
				</div>
			</div>

			<div class="col-4 col-m-6 col-sm-6">
				<div class="counter bg-primary">
					<h3>Coef. de Deformação - Sensor 2</h3>
					<?php
					echo "<h3>$coeficiente_2</h3>";
					echo "Última autualização: $horaLeitura"
					?>
					
				</div>
			</div>

			<div class="col-4 col-m-6 col-sm-6">
				<div class="counter bg-primary">
					<h3>Deformação - Sensor 1</h3>
					<?php
					echo "<h3>$deformacao</h3>";
					echo "Última autualização: $horaLeitura"
					?>
				</div>
			</div>

			<div class="col-4 col-m-6 col-sm-6">
				<div class="counter bg-primary">
					<h3>Deformação - Sensor 2</h3>
					<?php
					echo "<h3>$deformacao_2</h3>";
					echo "Última autualização: $dataLeitura";
					?>
				</div>
			</div>
		</div>
	</div>