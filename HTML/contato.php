<?php
    session_start();
    require_once('PHP/conn.php');
    unset($_SESSION["id_qrcode"]);
    $erro = "";
    if(isset($_SESSION['erro_contato'])){
        $erro = $_SESSION['erro_contato'];
    }
    $session = "erro_contato";
    $page = 'contato.php';
    $id = "";
    $nome = "";
    $email = "";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
    if($id != ""){
        $sql = "SELECT * FROM pessoa WHERE id_nome ='".$id."'";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $nome = $linha['nome'];
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
    <link rel="stylesheet" href="CSS/estilos.css" />
    <link rel="stylesheet" href="CSS/contato.css" />
    <link rel="icon" href="PHP/uploads/logo.png">
</head>

<body>

    <?php require("./parts/navegacao.php"); ?>
    <?php require("./parts/header_login.php"); ?>

    <main class="container d-flex justify-content-center p-5">
        <div class="row">
            <?php
                if($erro != ""){
                    include("./parts/erro.php");
                }
            ?>
            <div class="col-sm-auto col-md-6">
                <form class="form-horizontal" action="PHP/enviar_email.php" method="post">
                    <div class="text-center">
                        <h1>Contato</h1>
                        <label for="alerta">Campos marcados com <span class="ast font-weight-bold text-center">*</span>
                            são obrigatórios.</label>
                    </div>
                    <div class="form-group required">
                        <label for="nome" class="control-label font-weight-bold">Nome</label>
                        <div class="col-auto">
                            <input class="form-control" placeholder="Nome" type="nome" name="nome" id="nome"
                                value="<?php echo $nome;?>" required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="email" class="control-label font-weight-bold">Email</label>
                        <div class="col-auto">
                            <input class="form-control" placeholder="Email" type="email" name="email" id="email"
                                value="<?php echo $email;?>" required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="assunto" class="control-label font-weight-bold">Assunto</label>
                        <div class="col-auto">
                            <input class="form-control" type="text" placeholder="Assunto" name="assunto" id="assunto"
                                required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="mensagem" class="control-label font-weight-bold">Mensagem</label>
                        <div class="col-auto">
                            <textarea class="form-control" placeholder="Mensagem" name="mensagem" id="mensagem"
                                cols="50" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3698.6484369460777!2d-47.89359248501157!3d-22.02477761252949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94b87722afe006bb%3A0x4a8b254e7543696!2sSenac%20S%C3%A3o%20Carlos!5e0!3m2!1spt-BR!2sbr!4v1581451958431!5m2!1spt-BR!2sbr"
                    width="100%" height="650" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </main>
</body>

</html>