<?php
    include("conn.php");
    session_start();
    require 'mailer/PHPMailerAutoload.php';
    date_default_timezone_set('America/Sao_Paulo');
    $email = "";
    $erro =false;
    $trocar_senha = false;
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }

    if($email != ""){
        $sql = "SELECT * FROM pessoa WHERE email ='" . $email . "'";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            $trocar_senha = true;
        }
        if($trocar_senha){
            $token = md5(uniqid(mt_rand(), true));
            $data = date("Y-m-d H:i:s");
            $valido = false;
            $sql = "INSERT INTO token (token,email,data_criacao,valido) VALUES ('$token', '$email', '$data', '$valido')";
            if($conn->query($sql) == TRUE){
                
                //require para a execução se houver problema para importar o arquivo
                
                $assunto = $_POST['assunto'];
                $corpo = $_POST['mensagem'];

                $mail = new PHPMAILER(); //INSTANCIA UM OBJETO do tipo PHPMAIL

                $mail->isSMTP();
                $mail->CharSet = 'UTF-8';
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure ='tls';
                $mail->Username='projetofarmaciati33@gmail.com';
                $mail->Password='senac123';
                $mail->Port=587;

                //$mail->setFrom($email);
                $mail->addReplyTo('projetofarmaciati33@gmail.com');
                $mail->addAddress('projetofarmaciati33@gmail.com');

                $mail->isHTML(true);
                $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
                // DEFINIÇÃO DA MENSAGEM
                $mail->Subject  = "Token de recuperação de senha"; // Assunto da mensagem
                // Texto da mensagem
                $mail->Body .= " Mensagem: ". $token .""; // Texto da mensagem
                // ENVIO DO EMAIL
                $enviado = $mail->Send();
                // Limpa os destinatários e os anexos
                $mail->ClearAllRecipients();
                
                if ($enviado) {
                    $_SESSION['email'] = $email;
                    header('Location: ../HTML/recuperar_senha.php');
                } else {
                    echo "Não foi possível enviar o e-mail.";
                    echo "Detalhes do erro: " . $mail->ErrorInfo;
                }
            }
        }
        else{
            echo "Esse email não foi cadastrado nesse sistema";
        }
    }
    else{
        echo "Envie um email para prosseguir";
    }
?>