<html>

<head>
    <meta http-equiv="refresh" content="2">
</head>

<?php if ($escolha_sensor == 1) : ?>
    <div class="wrapper">
        <!-- main content -->
        <div class="col-12 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header" style="text-align: center;">
                    <?php
                    echo "<h3>Variação do Coeficiente de Deformação em  $dataChart (E-3) - Sensor 1 </h3>";
                    ?>
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
                        echo "<h3>Variação de Deformacão em  $dataChart (nm) - Sensor 1 </h3>";
                        ?>
                    </div>
                    <div class="card-content">
                        <canvas id="deformacaoChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php elseif ($escolha_sensor == 2) : ?>
    <div class="wrapper">

        <div class="col-12 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header" style="text-align: center;">
                    <?php
                    echo "<h3>Variação do Coeficiente de Deformação em  $dataChart (E-3) - Sensor 2";
                    ?>
                    <a class="nav-link" <?php echo "href = dashboard2.php?escolha_sensor=$escolha_sensor"; ?>>
                        <font size="4"> <b> ↻ </b></font>
                    </a> </h3>
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
                        echo "<h3>Variação de Deformacão em  $dataChart (nm) - Sensor 2 </h3>";
                        ?>
                    </div>
                    <div class="card-content">
                        <canvas id="deformacao_2Chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php else : ?>

    <div class="wrapper">
        <!-- main content -->
        <div class="col-12 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header" style="text-align: center;">
                    <?php
                    echo "<h3>Variação do Coeficiente de Deformação em  $dataChart (E-3) - Sensor 1 </h3>";
                    ?>
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
                    echo "<h3>Variação do Coeficiente de Deformação em  $dataChart (E-3) - Sensor 2 </h3>";
                    ?>
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
                        echo "<h3>Variação de Deformacão em  $dataChart (nm) - Sensor 1 </h3>";
                        ?>
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
                        echo "<h3>Variação de Deformacão em  $dataChart (nm) - Sensor 2 </h3>";
                        ?>
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