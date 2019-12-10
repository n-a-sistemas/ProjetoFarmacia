<?php

include('conn.php');
include('phpqrcode/qrlib.php');


$nome = $_POST['nome'];
$email =  $_POST['email'];
$datanascimento = $_POST['data'];
$rg = $_POST['rg'];
$sexo  = $_POST['sexo'];
$telefone = $_POST['tel'];
$alergiadoencas = $_POST['alergia-doencas'];
$tiposanguineo = $_POST['tipo-sanguineo'];
$contatoemergencia = $_POST['contato-emergencia'];
$planodesaude = $_POST['plano-de-saude'];
$senha  = $_POST['senha'];
$senha = md5($senha);
$altura = $_POST['altura'];
$peso = $_POST['peso'];

$diretorio = "img/";
$arquivo = $diretorio . basename($_FILES['perfil']['name']);

$tipo = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

if(move_uploaded_file($_FILES['perfil']['tmp_name'], $arquivo)){


}
else{
    echo "Erro ao cadastrar imagem";
}

// how to configure pixel "zoom" factor
$tempDir = "qrcodes/";
$nomeqrcode = '006_4.png';
$codeContents = 'perfil.php';
// generating
QRcode::png($codeContents, $tempDir. $nomeqrcode, QR_ECLEVEL_L, 2);  
// displaying
echo '<img src="'.$tempDir.'006_4.png" />';


$sql = "INSERT INTO pessoa (nome,email,datanascimento,rg,sexo,telefone,alergia-doencas,tipo-sanguineo,contato-emergencia,plano-saude,senha,altura,peso,qrcode,foto-de-perfil) 
        VALUES ('$nome' , '$email','$datanascimento','$rg','$sexo','$telefone','$alergiadoencas','$tiposanguineo','$contatoemergencia','$planodesaude','$senha','$altura','$peso','$tempDir . $nomeqrcode','$diretorio')";

if($conn->query($sql) == TRUE){
    echo "Dado inserido com sucesso";
    header('perfil.php');
}
else{
    echo "Erro : " . $conn->error;
}



$conn->close();
