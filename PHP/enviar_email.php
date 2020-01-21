<?php
    //PHPMailer v5.2 - estável
    //github.com/PHPMailer/tree/5.2-stable

    require 'mailer/PHPMailerAutoload.php';
    //require para a execução se houver problema para importar o arquivo

    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $conteudo = $_POST['conteudo'];

    $mail = new PHPMailer(); //instancia do objeto do tipo PHPMailer
    $mail->isSMTP();
    $mail->Charset = 'UTF-8';
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'ti33senacsc@gmail.com';
    $mail->Password = 'senac123';
    $mail->Port = 587;
    
    $mail->setFrom('ti33senacsc@gmail.com');
    $mail->addReplyTo('ti33senacsc@gmail.com');
    $mail->addAddress($email);
    #$mail->addCC("outromail@gmail.com"); cópia
    #$mail->addBCC("outromail@gmail.com"); cópia oculta

    $mail->isHTML(true);
    $mail->Subject = $assunto;
    $mail->Body = $conteudo;

    if(!$mail->send()){
        echo "Não foi possível enviar a mensagem";
    }
    else{
        echo "Mensagem enviada";
    }            
?>