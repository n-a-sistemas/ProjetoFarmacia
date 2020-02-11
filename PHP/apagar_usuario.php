<?php
    require('conn.php');
    session_start();
    $id = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    if($id != ""){
        $sql = "DELETE FROM pessoa WHERE id_nome =".$id."";
        echo $sql;
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
    header('Location: ../HTML/tabela_cadastrados.php');
?>