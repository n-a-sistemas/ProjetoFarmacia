<?php  

session_start();
include("../PHP/conn.php");
$id = "";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
if($id != ""){
    $sql = "SELECT `foto_qrcode` FROM pessoa WHERE id_nome = $id";
    $resultado= $conn->query($sql);
}

if($resultado->num_rows > 0){
    while($linha = $resultado->fetch_assoc()){
         $img = $linha['foto_qrcode'];
    }
}



?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Qr Code</title>
</head>
<body>
    <header>
        <h1>Imprisa seu Qr Code</h1>
    </header>
    <?php include("./parts/navegacao.php"); ?>
    <main>
        
      
    </main>






    
    
   
</body>
</html>