<?php
  session_start();

  //PHPMAILER v5.2 - versão estável
  require 'mailer/PHPMailerAutoload.php';
  //require para a execução se houver problema para importar o arquivo

  $email = "";
  $assunto = "";
  $corpo = "";
  $nome = "";

  if(isset($_POST['email']) && 
  isset($_POST['assunto']) && 
  isset($_POST['mensagem']) && 
  isset($_POST['nome'])){
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $corpo = $_POST['mensagem'];
    $nome = $_POST['nome'];
  }
  if($email != "" && $assunto != "" && $corpo != "" && $nome != ""){
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
    $mail->Body .= " Nome: ". $nome ."<br>"; // Texto da mensagem
    $mail->Body .= " E-mail: ". $email ."<br>"; // Texto da mensagem
    $mail->Body .= " Assunto: ". $assunto ."<br><br>"; // Texto da mensagem
    $mail->Body .= " Mensagem: ". $corpo ; // Texto da mensagem
    // ENVIO DO EMAIL
    $enviado = $mail->Send();
    // Limpa os destinatários e os anexos
    $mail->ClearAllRecipients();
      
    if ($enviado) {
      $_SESSION['erro_contato'] = "";
    }
    else {
      $erro = "Não foi possível enviar o e-mail. Detalhes do erro: " . $mail->ErrorInfo;
      $_SESSION['erro_contato'] = $erro;
    }
  }
  else{
    $erro = "Erro ao enviar email. Preencha todos os campos";
    $_SESSION['erro_contato'] = $erro;
  }
  header("location: ../contato.php");
?>