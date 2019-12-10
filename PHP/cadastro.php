<?php

include('conn.php');
include('phpqrcode/qrlib.php');


$nome = $_POST['nome'];
$email =  $_POST['email'];
$datanascimento = $_POST['data_nascimento'];
$rg = $_POST['rg'];
$sexo  = $_POST['sexo'];
$telefone = $_POST['tel'];
$alergiadoencas = $_POST['alergias_doencas'];
$tiposanguineo = $_POST['tipo_sanguineo'];
$contatoemergencia = $_POST['contato_emergencia'];
$planodesaude = $_POST['plano_de_saude'];
$senha  = $_POST['senha'];
$senha = md5($senha);
$altura = $_POST['altura'];
$adm = 0;
$diretorio = "uploads/";
$arquivo = $diretorio . basename($_FILES['imagemUpload']['name']);

$tipo = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

if(move_uploaded_file($_FILES['imagemUpload']['tmp_name'], $arquivo)){
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


$sql = "INSERT INTO pessoa (nome,email,data_nascimento,rg,sexo,telefone,alergia_doencas,tipo_sanguineo,contato_emergencia,plano_de_saude,senha,altura,qrcode,foto_de_perfil,adm) 
        VALUES ('$nome', '$email','$datanascimento','$rg','$sexo','$telefone','$alergiadoencas','$tiposanguineo','$contatoemergencia','$planodesaude','$senha','$altura','$tempDir . $nomeqrcode','$arquivo','$adm')";

if($conn->query($sql) == TRUE){

    echo "$arquivo salva com sucesso";
    echo "Dado inserido com sucesso";
}
else{
    echo "Erro : " . $conn->error;
}


