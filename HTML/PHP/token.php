<?php
    require("conn.php");
    session_start();
    session_unset();
    require 'mailer/PHPMailerAutoload.php';
    date_default_timezone_set('America/Sao_Paulo');

    $email = "";
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    
    if($email != ""){
        $sql = "SELECT * FROM pessoa WHERE email ='" . $email . "'";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            $token = md5(uniqid(mt_rand(), true));
            $data = date("Y-m-d H:i:s");
            $valido = true;

            $mail = new PHPMailer(); //instancia do objeto do tipo PHPMailer
            //$mail->SMTPDebug  = 1; 
            $mail->isSMTP();
            $mail->Charset = 'UTF-8';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'projetofarmaciati33@gmail.com';
            $mail->Password = 'senac123';
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                
            $mail->setFrom('projetofarmaciati33@gmail.com');
            $mail->addReplyTo('projetofarmaciati33@gmail.com');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Token de recuperacao de senha";

            $sql = "INSERT INTO token (token,email,data_criacao,valido) VALUES ('$token', '$email', '$data', '$valido')";
            if($conn->query($sql) == TRUE){
                $mail->Body = "Mensagem: ". $token;
                if($mail->send()){
                    $_SESSION['email'] = $email;
                    $_SESSION['erro_senha'] = "";
                }
                else{
                    $erro = "Não foi possível enviar o e-mail. Detalhes do erro: " . $mail->ErrorInfo;
                    $_SESSION['erro_senha'] = $erro;
                }
            }
            else{
                $erro = "Erro na criação do codigo para enviar, por favor tente novamente";
                $_SESSION['erro_senha'] = $erro;
            }
        }
        else{
            $erro = "Esse email não foi cadastrado nesse sistema";
            $_SESSION['erro_senha'] = $erro;
        }
    }
    else{
        $erro = "Envie um email para prosseguir";
        $_SESSION['erro_senha'] = $erro;
    }
    header('Location: ../recuperar_senha.php');
?>