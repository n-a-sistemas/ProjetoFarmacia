<?php

include("conn.php");
$sql = "SELECT * FROM pessoa";
$resultado = $conn->query($sql);

if($resultado->num_rows > 0){
    while($linha = $resultado->fetch_assoc()){
        echo "<option value=" . $linha['email'] . ">" . $linha['email'] . "</option>";
    }
}

