<?php
    session_start();
    include("conn.php");
    
    $estado_atual = "";

    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $sql = "SELECT `id_estado` FROM pessoa WHERE id_nome = $id";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $estado_atual = $linha['id_estado'];
            }
        }
    }
    $sql_estado = "SELECT * FROM estado ORDER BY nome ASC";
    $resultado = $conn->query($sql_estado);
    
    if($resultado->num_rows > 0){
        if($estado_atual == ""){
            while($linha = $resultado->fetch_assoc()){
                echo "<option value=" . $linha['id'] . ">" . $linha['nome'] . "</option>";
            }
        }
        else{
            while($linha = $resultado->fetch_assoc()){
                if($estado_atual == $linha['id']){
                    $selecionado = "selected";
                }
                else{
                    $selecionado = null;
                }
                echo "<option value=" . $linha['id'] . " ". $selecionado . ">" . $linha['nome'] . "</option>";
            }
        }
    }
    
?>