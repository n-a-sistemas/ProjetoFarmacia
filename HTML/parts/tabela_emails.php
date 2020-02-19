<?php
    require('PHP/conn.php');
    $id = "";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }

    $sql = "SELECT * FROM pessoa WHERE ativo = 1";
    $resultado = $conn->query($sql);

    if($resultado->num_rows > 0){
        while($linha=$resultado->fetch_assoc()){
            if($linha['adm']){
                echo "<tr class='table-secondary'>";
                echo "<td><span class='d-flex justify-content-center'><i class='fas fa-star'>ADM</i></span></td>";
            }
            else{
                echo "<tr>";
                echo "<td><span class='d-flex justify-content-center'><i class='fas fa-user'>USER</i></span></td>";
            }
            echo "<td>".$linha['nome']."</td>";
            echo "<td>".$linha['email']."</td>";
            echo "<td>".$linha['telefone']."</td>";
            echo "<td>".$linha['telefone_emergencia']."</td>";
            echo "<td><a href='perfil.php?id=".$linha['id_qrcode']."'>Ver usuário</a></td>";
            echo "<td><a href='PHP/reset_senha.php?id=".$linha['id_nome']."'>Resetar senha</a></td>";
            if(!$linha['adm']){
                echo "<td><a href='PHP/desabilitar_usuario.php?id=".$linha['id_nome']."'>Desabilitar usuário</a></td>";
            }
            else{
                echo "<td></td>";
            }
            echo "</tr>";
        }
    }
?>