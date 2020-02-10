<?php
    session_start();
    require("conn.php");
    
    $estado_atual = "";
    $cidade_atual = "";
    $codEstado = "";

    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $sql = "SELECT `id_estado`, `id_cidade` FROM pessoa WHERE id_nome = $id";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $estado_atual = $linha['id_estado'];
                $cidade_atual = $linha['id_cidade'];
            }
        }
    }

    if(isset($_POST['estado'])){
        $codEstado = $_POST['estado'];
    }
    else if($estado_atual != ""){
        $codEstado = $estado_atual;
    }
    
    if($codEstado != ""){
        $sql = "SELECT * FROM cidade WHERE estado = $codEstado ORDER BY nome ASC";
        $resultado = $conn->query($sql);

        if($resultado->num_rows > 0){
            if($cidade_atual == ""){
                while($linha = $resultado->fetch_assoc()){
                    echo "<option value=" . $linha['id'] . ">" . $linha['nome'] . "</option>";
                }
            }
            else{
                while($linha = $resultado->fetch_assoc()){
                    if($cidade_atual == $linha['id']){
                        $selecionado = "selected";
                    }
                    else{
                        $selecionado = null;
                    }
                    echo "<option value=" . $linha['id'] . " ". $selecionado . ">" . $linha['nome'] . "</option>";
                }
            }
        }
    }
?>