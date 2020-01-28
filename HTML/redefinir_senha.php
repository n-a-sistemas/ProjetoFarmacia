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
    <div id="primeira-parte">
            <div>
                <label for="token">Codigo enviado: </label>
                <input type="text" name="token" id="token">
            </div>
            <div>
                <button type="button" id="btn-enviar-2">Enviar</button>
            </div>
        </div>
        <div id="segunda-parte">
            <div>
                <label for="senha">Nova senha: </label>
                <input type="password" name="senha" id="senha" minlength="5" required>
            </div>
            <div>
                <label for="confirmacao">Digite novamente sua senha: </label>
                <input type="password" name="confirmacao" id="confirmacao" minlength="5" onblur="confirmaSenha()" required>
                <label for="confirmacao" id="errorSenha"></label>
            </div>
            <div>
                <button type="submit"></button>
            </div>
        </div>
    </main>
</body>