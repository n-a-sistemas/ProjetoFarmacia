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
        $sql = "SELECT `foto_qrcode` FROM pessoa WHERE id_qrcode ='". $qrcode . "'";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $img = $linha['foto_qrcode'];
            }
        }
        else{
            header('Location: meuperfil.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir QRCode</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="JS/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="CSS/qrcode.css" />
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="d-flex justify-content-center">
                <img src="PHP/<?php echo $img;?>" class="">
            </div>
        </div>
    </div>
</body>

</html>