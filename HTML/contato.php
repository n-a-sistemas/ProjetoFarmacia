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
            <div class="col-6">
                <form class="form-horizontal" action="../PHP/enviar_email.php" method="post">
                    <div class="text-center">
                        <h1>Contato</h1>
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <div class="col-auto">
                            <input class="form-control" type="nome" name="nome" id="nome" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="col-auto">
                            <input class="form-control" type="email" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="assunto">Assunto</label>
                        <div class="col-auto">
                            <input class="form-control" type="text" name="assunto" id="assunto" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mensagem">Mensagem</label>
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
            <div class="col-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3698.6484369460777!2d-47.89359248501157!3d-22.02477761252949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94b87722afe006bb%3A0x4a8b254e7543696!2sSenac%20S%C3%A3o%20Carlos!5e0!3m2!1spt-BR!2sbr!4v1581451958431!5m2!1spt-BR!2sbr" width="600" height="650" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </main>
</body>

</html>