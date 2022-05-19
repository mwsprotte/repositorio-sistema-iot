<html>

<head>
    <title>Sistema IoT IFSC - Rau</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/png" href="./assets/logo.png" />
    <link rel="stylesheet" href="style/W3.CSS 4.15.css">
</head>

<body>
    <div class="w3-container w3-green">
        <h2 style="text-align: center;">Cadastro de usuário | Sistema IoT IFSC - Rau</h2>
    </div>
    <!-- <div>
            <h1>Cadastro de usuário</h1>
        </div> -->
    <form class="w3-container w3-light-grey" action="controle.php" method="post">
        <div style="margin: auto; width: 50%; padding: 10px;">
            <br>
            <div>
                <label>Nome:</label><input class="w3-input w3-border w3-round-large" type="text" name="nome" value="">
                <br>
            </div>

            <div>
                <label>E-mail:</label><input class="w3-input w3-border w3-round-large" type="email" name="email">
                <br>
            </div>

            <div>
                <label>Projeto:</label>
                <select style="width:50%" class="w3-select w3-round-large w3-border" name="projeto">
                    <option value="">Selecione seu projeto</option>
                    <option value="1">Monitoramento de Dados Energéticos</option>
                    <option value="2">Deformação de Rotores</option>
                    <option value="3">Smart Meter</option>
                </select>
                <a href="guia.php">Quero inserir o meu projeto<br><br></a>
            </div>

            <div>
                <label>Senha:</label><input class="w3-input w3-border w3-round-large" type="password" name="senha">
                <br>
            </div>

            <div>
                <input type="submit" name="cadastrar" value="Cadastrar" />
                <input type="reset" value="Limpar">
            </div>
            <br>
        </div>
    </form>
</body>

</html>