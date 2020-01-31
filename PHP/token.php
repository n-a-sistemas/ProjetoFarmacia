<?php
    include("conn.php");
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
            $erro = true;
            echo $data;
            if(!$erro){
                $sql = "INSERT INTO token (codigo,email,data,valido) VALUES ('$token', '$email', '$data', '$valido')";
                if($conn->query($sql) == TRUE){
                    //header('Location: ../HTML/recuperar_senha.php?pag=2');
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