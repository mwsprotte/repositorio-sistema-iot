<html>

<head>
    <title>Sistema IoT IFSC - Rau</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/png" href="./assets/logo.png" />
    <link rel="stylesheet" href="style/W3.CSS 4.15.css">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
</head>

<body>
    <div class="w3-container w3-green">
        <h2 style="text-align: center;">Acesso | Sistema IoT IFSC - Rau</h2>
    </div>

    <div>
        <form class="w3-container w3-light-grey" action="controle.php" method="post">

            <!-- <div style="position: relative; left: 250px; right:250px;"> -->
            <div style="margin: auto; width: 50%; padding: 10px;">

                <div>
                    <br>
                    <label>E-mail:</label><input class="w3-input w3-border w3-round-large" type="text" type="email" name="email">
                </div>
                <br>

                <div>
                    <label>Senha:</label><input class=" w3-input w3-border w3-round-large" type="password" name="senha">
                </div>

                <br>

                <div>
                    <input type="submit" id="btnEntrar" name="enviar" value="Entrar" />
                    <a href="cadastrar.php">Não possui uma conta?</a>
                </div>
                <br>

            </div>

        </form>
    </div>


</body>

</html>