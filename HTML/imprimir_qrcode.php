<?php
    require("PHP/conn.php");
    $qrcode = "";
    if(isset($_GET['id'])){
        $qrcode = $_GET['id'];
    }
    else{
        header('Location: meuperfil.php');
    }

    if($qrcode != ""){
        $sql = "SELECT * FROM pessoa WHERE id_qrcode ='". $qrcode . "'";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $img = $linha['foto_qrcode'];
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir QRCode</title>
</head>
<body>
    
    <img src="PHP/<?php echo $img;?>">
    <div>
        <img src="../Documentação/KevinLindo.png" width="1000" height="1000">
    </div>

</body>
</html>