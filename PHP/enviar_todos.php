<?php
    session_start();
    include('conn.php');

    //Conectando no banco e fznd um SELECT
    $sql = "SELECT * FROM pessoa";
    $resultado = $conn->query($sql);

    //PHPMAILER v5.2 - versão estável

    require 'mailer/PHPMailerAutoload.php';
    //require para a execução se houver problema para importar o arquivo

    $email = "";
    $assunto = "";
    $corpo = "";

    if(isset($_POST['email']) && 
    isset($_POST['assunto']) && 
    isset($_POST['mensagem'])){
        $email = $_POST['email'];
        $assunto = $_POST['assunto'];
        $corpo = $_POST['mensagem'];
    }
    if($email != "" && $assunto != "" && $corpo != ""){
        $mail = new PHPMAILER(); //INSTANCIA UM OBJETO do tipo PHPMAIL

        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure ='tls';
        $mail->Username='projetofarmaciati33@gmail.com';
        $mail->Password='senac123';
        $mail->Port=587;

        $mail->setFrom('projetofarmaciati33@gmail.com');
        $mail->addReplyTo('projetofarmaciati33@gmail.com');

        if($email == "all"){
            if($resultado->num_rows > 0){
                while($linha = $resultado->fetch_assoc()){
                    $mail->addAddress($linha['email']);
                }
            }
        }
        else{
            $mail->addAddress($email);
        }

        $mail->isHTML(true);
        $mail->Subject= $assunto;
        $mail->Body= $corpo;
        $enviado = $mail->Send();
        // Limpa os destinatários e os anexos
        $mail->ClearAllRecipients();

        if ($enviado) {
            $_SESSION['erro_contato_adm'] = "";
        }
        else {
            $erro = "Não foi possível enviar o e-mail. Detalhes do erro: " . $mail->ErrorInfo;
            $_SESSION['erro_contato_adm'] = $erro;
        }
    }
    else{
        $erro = "Erro ao enviar email. Preencha todos os campos";
        $_SESSION['erro_contato_adm'] = $erro;
    }
    header("location: ../HTML/contato_adm.php");
                    
                