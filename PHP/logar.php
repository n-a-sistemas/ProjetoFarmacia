<?php
    include("conn.php");
    session_start();

    if(isset($_POST['email']) && isset($_POST['senha'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if($email != "" && $senha != ""){
            $senha = hash('sha256', $senha);
            $sql = "SELECT `senha`, `email`, `adm` FROM `pessoa` WHERE email ='" . $email . "'";
            $resultado = $conn->query($sql);
            if($resultado->num_rows > 0){
                $linha = $resultado->fetch_assoc();
                echo $linha['email'];
                if($linha['senha'] == $senha){
                    $_SESSION['login'] = 'true';
                    $_SESSION['adm'] = $linha['adm'];
                    $_SESSION['email'] = $linha['email'];
                    header('Location: ../HTML/index.php');
                }
                else{
                    echo "<p>Erro ao tentar logar no site, email e/ou senha incorretos</p>";    
                }
            }
            else{
                echo "<p>Erro ao tentar logar no site, email e/ou senha incorretos</p>";
            }
        }
        else{
            echo "<p>Erro ao tentar logar no site, volte e preencha os campos corretamente</p>";
        }
    }
    else{
        echo "<p>Erro ao tentar logar no site, volte e preencha os campos corretamente</p>";
    }
?>