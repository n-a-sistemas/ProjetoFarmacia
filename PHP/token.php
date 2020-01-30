<?php
    include("conn.php");
    $email = "";
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
            echo $data;
            /*
            $sql = "INSERT INTO token (codigo,email,data) VALUES ('$token', '$email', '$data')";
            if($conn->query($sql) == TRUE){
                //header('Location: ../HTML/recuperar_senha.php?pag=2');
            }
            */
        }
        else{
            echo "Esse email não foi cadastrado nesse sistema";
        }
    }
    else{
        echo "Envie um email para prosseguir";
    }
?>