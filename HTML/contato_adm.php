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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/estilos.css" />
</head>

<body>

    <?php include("./parts/navegacao.php"); ?>
    <?php include("./parts/header_login.php"); ?>

    <div class="container d-flex text-left p-5">
        <div class="row">
            <main>
                <form class="form-horizontal" action="../PHP/enviar_todos.php" method="post">
                    <h1>Contato para dúvidas ou bugs encontrados no site</h1>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <select class="form-control col-auto" name="email" id="email" required>
                            <option value="all">Enviar para Todos</option>
                            <?php include("../PHP/emails.php"); ?>
                        </select>
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
                    <div class="form-group">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>

</html>