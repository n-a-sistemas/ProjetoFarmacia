<?php
    require("conn.php");
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    $token = "";
    $email = "";
    $retornar = false;

    if(isset($_POST['token'])){
        $token = $_POST['token'];
    }
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
    }
    if(isset($_GET['retornar'])){
        $retornar = $_GET['retornar'];
    }

    if(!$retornar && $email != "" && $token != ""){
        $sql = "SELECT * FROM token WHERE email ='" . $email . "' AND token ='" . $token . "'";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $data_criacao = $linha['data_criacao'];
                $valido = $linha['valido'];
            }
            if($valido){
                $date_atual = new DateTime("now");
                $date_token = new DateTime($data_criacao);
                $date_token->add(new DateInterval('PT30M'));
                if($date_atual <= $date_token){
                    $_SESSION['token'] = $token;
                    $_SESSION['erro_senha'] = "";
                }
                else{
                    $erro = "O token foi expirou, tente novamente";
                    $_SESSION['erro_senha'] = $erro;
                    $_SESSION['email'] = "";
                }
            }
            else{
                $erro = "O token não é mais valido, tente novamente";
                $_SESSION['erro_senha'] = $erro;
                $_SESSION['email'] = "";
            }
        }
        else{
            $erro = "Email e/ou token não cadastrados no sistema, tente novamente";
            $_SESSION['erro_senha'] = $erro;
        }
    }
    else if($retornar){
        $_SESSION['email'] = "";
        $_SESSION['erro_senha'] = "";
    }
    else{
        $erro = "Envie um email e/ou token para prosseguir";
        $_SESSION['erro_senha'] = $erro;
        $_SESSION['email'] = "";
    }
    header('Location: ../recuperar_senha.php');
?>