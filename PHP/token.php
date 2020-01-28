<?php
    $email = "";
    $trocar_senha = false;
    if(isset($_POST['email']){
        $email = $_POST['email'];
    }
    $sql = "SELECT * FROM pessoa WHERE email = $email";
    $resultado = $conn->query($sql);
    if($resultado->num_rows == 1){
        $trocar_senha = true;
    }
    if($email != "" && $trocar_senha){
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];
        $header = json_encode($header);
        $header = base64_encode($header);
        
        $payload = [
            'iss' => 'localhost',
            'email' => "".$email.""
        ];
        $payload = json_encode($payload);
        $payload = base64_encode($payload);
        
        $signature = hash_hmac('sha256',"$header.$payload",'nova-senha',true);
        $signature = base64_encode($signature);
        
        echo "$header.$payload.$signature";
    }  
?>