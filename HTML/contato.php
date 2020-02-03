<?php
    session_start();
    include("../PHP/conn.php");
    $id = "";
    $email = "";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
    if($id != ""){
        $sql = "SELECT * FROM pessoa WHERE id_nome = $id";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $email = $linha['email'];
            }
        }
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
</head>
<body>

  

    <?php include("./parts/navegacao.php"); ?>
    <?php include("./parts/header_login.php"); ?>
    <main class="container d-flex text-left">

    <div class="row">
    <form class="form-horizontal" action="../PHP/enviar_email.php" method="post">
            <div class="form-group">
           
                <label for="nome">Nome:</label>
            <div class="col-auto">
                <input class="form-control" type="nome" name="nome" id="nome">
            </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
            <div class="col-auto">
                <input class="form-control" type="email" name="email" id="email">
            </div>
            </div>
            <div class="form-group">
                <label for="assunto">Assunto:</label>
            <div class="col-auto">
                <input class="form-control" type="text" name="assunto" id="assunto">
            </div>
            </div>
            <div class="form-group">
                <label for="mensagem">Mensagem:</label>
            <div class="col-auto">
                <textarea class="form-control" name="mensagem" id="mensagem" cols="50" rows="10"></textarea>
            </div>
            </div>
            <div class="form-group" >
            <div class="col-auto">
                <button class="btn btn-primary mb-2 m-5" type="submit">Enviar Mensagem</button>
            </div>
            </div>
        </form>
    </div>
    </main>
</body>
</html>