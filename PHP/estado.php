<?php
    include("conn.php");
    
    $sql = "SELECT * FROM estado ORDER BY nome ASC";
    $resultado = $conn->query($sql);

    if($resultado->num_rows > 0){
        while($linha = $resultado->fetch_assoc()){
            echo "<option value=" . $linha['id'] . ">" . $linha['nome'] . "</option>";
        }
    }
?>