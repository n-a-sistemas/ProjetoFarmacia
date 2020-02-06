<?php
    require('conn.php');
    session_start();

    $peso = "";
    $data_peso = date('Y-m-d');
    $id = "";

    if(isset($_POST['peso'])){
        $peso = $_POST['peso'];
    }
    if(isset($_POST['data_peso'])){
        $data_peso = $_POST['data_peso'];
    }
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }

    if($peso != "" && $id != ""){
        $sql_peso = "INSERT INTO peso (id_nome, peso, data) VALUES ('$id', '$peso','$data_peso')";
        if($conn->query($sql_peso) != TRUE){
            $erro = "Erro : " . $conn->error;
        }
    }
    else{
        $erro = "Insira um peso para prosseguir";
    }
    header('Location: ../HTML/meuperfil.php');
?>