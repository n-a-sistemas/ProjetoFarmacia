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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/estilos.css" />
    <link rel="stylesheet" href="CSS/cadastro.css">
    <link rel="stylesheet" href="CSS/recuperar_senha.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/cadastro.js"></script>
    <script type="text/javascript" src="JS/bootstrap.min.js"></script>
</head>

<body>
    <?php include("./parts/navegacao.php"); ?>

    <div class="container d-flex justify-content-center mt-5">
        <div class="row">
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
        </div>
    </div>
</body>

</html>