<?php
    require('./conn.php');
    session_start();

    $senha = "";
    $confirma_senha = "";
    $email = "";
    $token = "";

    if(isset($_POST['senha'])){
        $senha = $_POST['senha'];
    }
    if(isset($_POST['confirmacao'])){
        $confirma_senha = $_POST['confirmacao'];
    }
    if(isset($_SESSION['token'])){
        $token = $_SESSION['token'];
    }
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
    }

    if($email != "" && $token != ""){
        if($senha != "" && $confirma_senha != ""){
            if($senha == $confirma_senha){
                $senha = hash('sha256', $senha);
                $sql = "UPDATE pessoa SET `senha`='".$senha."' WHERE email ='".$email."'";
                if($conn->query($sql) == TRUE){
                    $sql_token = "UPDATE token SET `valido`= false";
                    if($conn->query($sql_token) != TRUE){
                        $erro = "Erro : " . $conn->error;
                        $_SESSION['erro'] = $erro;
                    }
                }
                else{
                    $erro = "Erro : " . $conn->error;
                    $_SESSION['erro_senha'] = $erro;
                }
            }
            else{
                $erro = "As senhas não se correspodem";
                $_SESSION['erro_senha'] = $erro;
            }
        }
        else{
            $erro = "Preenchas os campos para prosseguir";
            $_SESSION['erro_senha'] = $erro;
        }
    }
    else{
        $erro = "Envie um email e/ou token para prosseguir";
        $_SESSION['erro_senha'] = $erro;
        $_SESSION['email'] = "";
        $_SESSION['token'] = "";
    }
    
    if($_SESSION['erro_senha'] != ""){
        header('Location: ../HTML/recuperar_senha.php');
    }
    else{
        header('Location: ../HTML/index.php');
    }
?>