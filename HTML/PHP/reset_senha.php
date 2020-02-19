<?php
    require('conn.php');
    session_start();
    $id = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    if($id != ""){
        $sql = "UPDATE pessoa SET `senha`='' WHERE id_nome =".$id."";
        echo $sql;
        if($conn->query($sql) != TRUE){
            $erro = $conn->error;
            $_SESSION['erro_reset'] = $erro;
        }
        else{
            $_SESSION['erro_reset'] = "";
        }
    }
    else{
        $erro = "Parâmetro invalido para prosseguir";
        $_SESSION['erro_reset'] = $erro;
    }
    header('Location: ../tabela_cadastrados.php');
?>