<?php

include('conn.php');

//Conectando no banco e fznd um SELECT
$sql = "SELECT * FROM pessoa";
$resultado = $conn->query($sql);
$email = $_POST['email'];

$conn->close();




//PHPMAILER v5.2 - versão estável


require 'mailer/PHPMailerAutoload.php';
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
$mail->Subject=$assunto;
$mail->Body=$corpo;

if(!$mail->send()){
                    
     echo "Não foi possivel enviar a mensagem";

    }else{
        echo "Mensagem enviada com sucesso";
     }

     header("location: ../HTML/contato.php");
                
                