<?php
    require('conn.php');
    session_start();
    $id = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    if($id != ""){
        $ativo = 0;
        $sql = "UPDATE pessoa SET `ativo`='".$ativo."' WHERE id_nome ='".$id."'";
        if($conn->query($sql) != TRUE){
            $erro = $conn->error;
            $_SESSION['erro_delete'] = $erro;
        }
        else{
            $_SESSION['erro_delete'] = "";
        }
    }
    else{
        $erro = "Parâmetro invalido para prosseguir";
        $_SESSION['erro_delete'] = $erro;
    }
    header('Location: ../tabela_cadastrados.php');
?>