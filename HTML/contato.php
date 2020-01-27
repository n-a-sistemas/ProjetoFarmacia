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
</head>
<body>

    <header>
        <?php include("./parts/header_login.php"); ?>
        <h1>Contato para dúvidas ou bugs encontrados no site</h1>
    </header>
    
    <?php include("./parts/navegacao.php"); ?>

    <main>
    <form action="../PHP/enviar_email.php" method="post">
            <div>
                <label for="email">email:</label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="assunto">assunto:</label>
                <input type="text" name="assunto" id="assunto">
            </div>
            <div>
                <label for="corpo">Conteudo:</label>
                <textarea name="corpo" id="corpo" cols="30" rows="10"></textarea>
            </div>
            <div>
                <input type="submit" name="Enviar">
            </div>
        </form>
    </main>
</body>
</html>