<?php
    session_start();
    $email = "";
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
    }
    $token = "";
    if(isset($_SESSION['token'])){
        $token = $_SESSION['token'];
    }
    $erro = "";
    if(isset($_SESSION['erro'])){
        $erro = $_SESSION['erro'];
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
    <script src="JS/cadastro.js"></script>
</head>
<body>
    
    <header>
        <h1>Login</h1>
    </header>

    <?php include("./parts/navegacao.php"); ?>

    <main>
        <?php
            if($erro != ""){
                echo "<div>";
                    echo "<h3>Erro</h3>";
                    echo "<p>".$erro."</p>";
                echo '</div>';
            }
        ?>
        <?php
            if($email == "" && $token == "") {
                include('./parts/recuperar_senha_part1.html');
            }
        ?>
        
        <?php 
            if($email != ""  && $token == ""){
                include('./parts/recuperar_senha_part2.html');
            }
        ?>

        <?php 
            if($email != ""  && $token != ""){
                include('./parts/recuperar_senha_part3.html');
            }
        ?>
    </main>

</body>
</html>