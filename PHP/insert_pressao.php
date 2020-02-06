<?php
    require('conn.php');
    session_start();

    $pressao = "";
    $data_pressao = date('Y-m-d');
    $id = "";

    if(isset($_POST['pressao'])){
        $pressao = $_POST['pressao'];
    }
    if(isset($_POST['data_pressao'])){
        $data_pressao = $_POST['data_pressao'];
    }
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }

    if($pressao != "" && $id != ""){
        $sql_pressao = "INSERT INTO pressao (id_nome, pressao, data) VALUES ('$id', '$pressao','$data_pressao')";
        if($conn->query($sql_pressao) != TRUE){
            $erro = "Erro : " . $conn->error;
        }
    }
    else{
        $erro = "Insira uma pressão para prosseguir";
    }
    header('Location: ../HTML/meuperfil.php');
?>