<?php


//PHPMAILER v5.2 - versão estável


require 'mailer/PHPMailerAutoload.php';
//require para a execução se houver problema para importar o arquivo

$email = $_POST['email'];
$assunto = $_POST['assunto'];
$corpo = $_POST['corpo'];

$mail = new PHPMAILER(); //INSTANCIA UM OBJETO do tipo PHPMAIL

$mail->isSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure ='tls';
$mail->Username='projetofarmaciati33@gmail.com';
$mail->Password='senac123';
$mail->Port=587;

$mail->setFrom($email);
$mail->addReplyTo('projetofarmaciati33@gmail.com');
$mail->addAddress('projetofarmaciati33@gmail.com');

$mail->isHTML(true);
$mail->Subject=$assunto;
$mail->Body=$corpo;
   

                if(!$mail->send()){
                    
                    echo "Não foi possivel enviar a mensagem";

                }else{
                    echo "Mensagem enviada com sucesso";
                }