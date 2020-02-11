<?php
    require('../PHP/conn.php');
    $id = "";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }

    $sql = "SELECT * FROM pessoa";
    $resultado = $conn->query($sql);

    if($resultado->num_rows > 0){
        while($linha=$resultado->fetch_assoc()){
            if($id == $linha['id_nome']){
                echo "<tr class='table-danger'>";
            }
            else{
                echo "<tr>";                
            }
            echo "<td>".$linha['id_nome']."</td>";
            echo "<td>".$linha['nome']."</td>";
            echo "<td>".$linha['email']."</td>";
            echo "<td>".$linha['telefone']."</td>";
            echo "<td>".$linha['telefone_emergencia']."</td>";
            if($id != $linha['id_nome']){
                echo "<td><a href='../PHP/reset_senha.php?id=".$linha['id_nome']."'>Resetar senha</a></td>";
                echo "<td><a href='../PHP/apagar_usuario.php?id=".$linha['id_nome']."'>Deletar usuário</a></td>";
            }
            echo "</tr>";
        }
    }
?>