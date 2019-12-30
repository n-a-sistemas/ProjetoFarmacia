<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/login.js"></script>
</head>
<body>
    
    <header>
        <h1>Login</h1>
    </header>

    <?php include("./parts/navegacao.php"); ?>

    <main>
        <form action="../PHP/logar.php" method="post" onsubmit="return validaLogin();">
            <div>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" require>
            </div>
            <div>
                <label for="senha">Senha: </label>
                <input type="password" name="senha" id="senha" require>
                <button type="button" id="btn">Mostrar senha</button>
            </div>
            <div>
                <a href="#">Não é cadastrado ?</a>
                <a href="#">Não sabe a senha ?</a>
                <button type="submit" id="logar">Logar</button>
            </div>
        </form>
    </main>
</body>
</html>