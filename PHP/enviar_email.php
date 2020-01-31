<?php


//PHPMAILER v5.2 - versão estável


require 'mailer/PHPMailerAutoload.php';
//require para a execução se houver problema para importar o arquivo

$email = $_POST['email'];
$assunto = $_POST['assunto'];
$corpo = $_POST['mensagem'];
$nome = $_POST['nome'];


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
 $mail->Subject  = "Formulário de Contato"; // Assunto da mensagem
 $mail->Body .= " Nome: ".$_POST['nome']."<br>
"; // Texto da mensagem
 $mail->Body .= " E-mail: ".$_POST['email']."<br>
"; // Texto da mensagem
 $mail->Body .= " Assunto: ".$_POST['assunto']."<br><br>
"; // Texto da mensagem
 $mail->Body .= " Mensagem: ".($_POST['mensagem'])."
"; // Texto da mensagem
 // ENVIO DO EMAIL
 $enviado = $mail->Send();
 // Limpa os destinatários e os anexos
 $mail->ClearAllRecipients();
   
 if ($enviado) {
    echo "E-mail enviado com sucesso!";
  } else {
    echo "Não foi possível enviar o e-mail.";
    echo "Detalhes do erro: " . $mail->ErrorInfo;
  }
  header("location: ../HTML/contato.php");