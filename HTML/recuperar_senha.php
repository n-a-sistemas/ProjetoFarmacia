<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="CSS/recuperar_senha.css">
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/token.js"></script>
</head>
<body>
    
    <header>
        <h1>Login</h1>
    </header>

    <?php include("./parts/navegacao.php"); ?>

    <main>
        <div>
            <div>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <button type="button" id="btn-enviar-1">Enviar</button>
            </div>
        </div>
    </main>

</body>
</html>