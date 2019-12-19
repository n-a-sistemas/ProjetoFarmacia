<?php
    include("conn.php");
    // Uma forma de obter $_POST['estado'] mais segura
    $codEstado = $_POST['estado'];

    $sql = "SELECT * FROM cidade WHERE estado = $codEstado ORDER BY nome ASC";
    $resultado = $conn->query($sql);

    if($resultado->num_rows > 0){
        while($linha = $resultado->fetch_assoc()){
            echo "<option value=" . $linha['id'] . " class='cidade'>" . $linha['nome'] . "</option>";
        }
    }
?>