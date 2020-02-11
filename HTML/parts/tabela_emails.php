<?php
    require('../PHP/conn.php');

    $sql = "SELECT * FROM pessoa";
    $resultado = $conn->query($sql);

    if($resultado->num_rows > 0){
        while($linha=$resultado->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$linha['id_nome']."</td>";
            echo "<td>".$linha['nome']."</td>";
            echo "<td>".$linha['email']."</td>";
            echo "<td>".$linha['telefone']."</td>";
            echo "<td>".$linha['telefone_emergencia']."</td>";
            echo "<td><a href='reset_senha?id=".$linha['id_nome'].">Resetar senha</a></td>";
            echo "<td><a href='apagar_usuario?id=".$linha['id_nome'].">Deletar usuário</a></td>";
            echo "</tr>";
        }
    }
?>