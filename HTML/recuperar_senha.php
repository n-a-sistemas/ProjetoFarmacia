<?php
    session_start();
    $pag = "";
    $informacoes = "NADA";
    if(isset($_GET['pag'])){
        $pag = $_GET['pag'];
    }
    if($pag == 2){
        $json = file_get_contents("http://10.60.44.29:8080/ProjetoFarmacia/PHP/token.php");
        $informacoes = base64_decode($json);
        $informacoes = json_decode($informacoes);
    }
    
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
        <form action="../PHP/token.php" method="post" id="primeira-form">
            <h2>Coloque seu email para enviarmos um codigo</h2>
            <div>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <button type="submit" id="btn-enviar-1">Enviar</button>
            </div>
        </form>
        <form action="" method="post" id="segundo-form">
            <h2>Agora troque a senha para uma melhor e que você lembre dela</h2>
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
        </form>
    </main>

    <aside>
        <?php echo $informacoes;?>
    </aside>

</body>
</html>