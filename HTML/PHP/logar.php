<?php
    require("conn.php");
    session_start();

    if(isset($_POST['email']) && isset($_POST['senha'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if($email != "" && $senha != ""){
            $senha = hash('sha256', $senha);
            $sql = "SELECT `senha`, `id_nome`, `adm` FROM pessoa WHERE email ='" . $email . "'";
            $resultado = $conn->query($sql);
            if($resultado->num_rows == 1){
                while($linha = $resultado->fetch_assoc()){
                    $senha_bd = $linha['senha'];
                    $adm = $linha['adm'];
                    $id = $linha['id_nome'];
                }
                if($senha_bd == $senha){
                    $_SESSION['adm'] = $adm;
                    $_SESSION['id'] = $id;
                    $_SESSION['erro_login'] = "";
                }
                else{
                    $erro = "Erro ao tentar logar no site, email e/ou senha incorretos";
                    $_SESSION['erro_login'] = $erro;
                }
            }
            else{
                $erro = "Erro ao tentar logar no site, email e/ou senha não cadastrados no sistema";
                $_SESSION['erro_login'] = $erro;
            }
        }
        else{
            $erro = "Erro ao tentar logar no site, preencha os campos corretamente";
            $_SESSION['erro_login'] = $erro;
        }
    }
    else{
        $erro = "Erro ao tentar logar no site, preencha os campos corretamente";
        $_SESSION['erro_login'] = $erro;
    }
    if($_SESSION['erro_login'] == ""){
        header('Location: ../meuperfil.php');
    }
    else{
        header('Location: ../index.php');
    }
?>