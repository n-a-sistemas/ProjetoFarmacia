<?php
    session_start();

    $erro = "";
    if(isset($_SESSION['erro_contato'])){
        $erro = $_SESSION['erro_contato'];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contato</title>
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/login.js"></script>
    <script type="text/javascript" src="JS/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="css/estilos.css" />
    <link rel="stylesheet" href="css/contato.css" />
</head>

<body>

    <?php include("./parts/navegacao.php"); ?>
    <?php include("./parts/header_login.php"); ?>

    <main class="container d-flex justify-content-center p-5">
        <div class="row">
            <?php
                if($erro != ""){
                    include("./parts/erro.php");
                }
            ?>
            <form class="form-horizontal" action="../PHP/enviar_email.php" method="post">
                <div class="text-center">
                    <h1>Contato</h1>
                </div>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <div class="col-auto">
                        <input class="form-control" type="nome" name="nome" id="nome" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <div class="col-auto">
                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="assunto">Assunto:</label>
                    <div class="col-auto">
                        <input class="form-control" type="text" name="assunto" id="assunto" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mensagem">Mensagem:</label>
                    <div class="col-auto">
                        <textarea class="form-control" name="mensagem" id="mensagem" cols="50" rows="10"
                            required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>