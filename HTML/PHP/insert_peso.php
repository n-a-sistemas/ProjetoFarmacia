<?php
    require('conn.php');
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    $peso = "";
    $data_peso = "";
    $id = "";

    if(isset($_POST['peso'])){
        $peso = $_POST['peso'];
    }
    if(isset($_POST['data_peso'])){
        $data_peso = $_POST['data_peso'];
    }
    if($data_peso == ""){
        $data_peso = date("Y-m-d");
    }
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }

    if($peso != "" && $id != ""){
        if($data_peso <= date("Y-m-d")){
            $sql_peso = "INSERT INTO peso (id_nome, peso, data) VALUES ('$id', '$peso','$data_peso')";
            if($conn->query($sql_peso) != TRUE){
                $erro = "Erro : " . $conn->error;
                $_SESSION['erro'] = $erro;
            }
            else{
                $_SESSION['erro'] = "";
            }
        }
        else{
            $erro = "Não pode enviar uma data com um dia, mês ou ano adiantado";
            $_SESSION['erro'] = $erro;
        }
    }
    else{
        $erro = "Insira um peso para prosseguir";
        $_SESSION['erro'] = $erro;
    }
    header('Location: ../meuperfil.php');
?>