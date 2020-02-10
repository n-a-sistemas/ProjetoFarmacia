<?php
    include("../PHP/conn.php");
    $id = "";
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
        echo "<div class='d-flex justify-content-center'>
                <img id='foto_perfil' class='rounded-circle' src='../PHP/" . $foto_perfil ."' alt='Foto de perfil' width='200' height='200'>
              </div>
              <div class='d-flex justify-content-center'>
                <h2>$nome</h2>
             </div>";
    }
?>