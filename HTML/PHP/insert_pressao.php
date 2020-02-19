<?php
    require('conn.php');
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    $pressao = "";
    $data_pressao = "";
    $id = "";

    if(isset($_POST['pressao'])){
        $pressao = $_POST['pressao'];
    }
    if(isset($_POST['data_pressao'])){
        $data_pressao = $_POST['data_pressao'];
    }
    if($data_pressao == ""){
        $data_pressao = date("Y-m-d");
    }
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }

    if($pressao != "" && $id != ""){
        if($data_pressao <= date("Y-m-d")){
            $sql_pressao = "INSERT INTO pressao (id_nome, pressao, data) VALUES ('$id', '$pressao','$data_pressao')";
            if($conn->query($sql_pressao) != TRUE){
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
        $erro = "Insira uma pressão para prosseguir";
        $_SESSION['erro'] = $erro;
    }
    header('Location: ../meuperfil.php');
?>