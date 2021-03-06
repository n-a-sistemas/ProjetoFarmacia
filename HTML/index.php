<?php
    session_start();
    unset($_SESSION["id_qrcode"]);
    $erro = "";
    $alerta = "";
    if(isset($_SESSION['erro_login'])){
        $erro = $_SESSION['erro_login'];
    }
    if(isset($_SESSION['alert_imagem'])){
        $alerta = $_SESSION['alert_imagem'];
    }
    if($erro == "" && $alerta == ""){
        session_unset();
        session_destroy();
    }
    $session = "erro_login";
    $session_alert = "alert_imagem";
    $page = 'index.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="JS/login.js"></script>
    <script type="text/javascript" src="JS/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="CSS/estilos.css" />
    <link rel="icon" href="PHP/uploads/logo.png">
</head>

<body>
    <?php require("./parts/navegacao.php");?>

    <?php
        if($erro != ""){
            include("./parts/erro.php");
        }
        if($alerta != ""){
            include("./parts/alert.php");
        }
    ?>
    <div class="container d-flex justify-content-center w-25 mt-5">
        <div class="row">
            <main>
                <div class="d-flex justify-content-center h-100">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Login</h3>
                        </div>

                        <div class="card-body">
                            <form action="PHP/logar.php" method="post" onsubmit="return validaLogin();">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>

                                    <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                        required>
                                </div>

                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>

                                    <input type="password" class="form-control" placeholder="Senha" name="senha"
                                        id="senha" required>

                                    <button type="button" id="btn">
                                        <img src="IMG/eye.svg" alt="eye" width="25" height="25"
                                            class="d-inline-block align-top">
                                    </button>
                                </div>

                                <div class="form-group">
                                    <button type="submit" id="logar" class="btn float-right">Logar</button>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <a href="recuperar_senha.php">Redefina sua senha</a>
                            </div>
                            
                            <div class="d-flex justify-content-center links">
                                <pre>Não é Cadastrado?<a href="cadastro.php">Cadastre-se</a></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>