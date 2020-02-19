<?php
    session_start();
    unset($_SESSION["id_qrcode"]);
    $erro = "";
    if(isset($_SESSION['erro_contato_adm'])){
        $erro = $_SESSION['erro_contato_adm'];
    }
    if(!isset($_SESSION['id'])){
        header('Location: index.php');
    }
    $session = "erro_contato_adm";
    $page = 'contato_adm.php';
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="JS/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="CSS/estilos.css" />
</head>

<body>

    <?php include("./parts/navegacao.php"); ?>
    <?php include("./parts/header_login.php"); ?>

    <div class="container d-flex justify-content-center text-left p-5">
        <div class="row">
            <main>
                <?php
                    if($erro != ""){
                        include("./parts/erro.php");
                    }
                ?>
                <form class="form-horizontal" action="PHP/enviar_todos.php" method="post">
                    <h1>Contato para dúvidas ou bugs encontrados no site</h1>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="col-auto">
                            <select class="form-control" name="email" id="email" required>
                                <option value="all">Enviar para Todos</option>
                                <?php include("PHP/emails.php"); ?>
                            </select>
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
            </main>
        </div>
    </div>
</body>

</html>