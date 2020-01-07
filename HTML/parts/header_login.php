<?php
    include("../PHP/conn.php");
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
    $nome = "";
    if($id != ""){
        $sql = "SELECT `nome`, `foto_perfil` FROM pessoa WHERE id_nome = $id";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $nome = $linha['nome'];
                $foto_perfil = $linha['foto_perfil'];
            }
        }
    }
    if($nome != ""){
        echo "<img id='foto_perfil' src='../PHP/" . $foto_perfil ."' alt='Foto de perfil'>";
        echo "<h2>" . $nome . "</h2>";
    }
?>