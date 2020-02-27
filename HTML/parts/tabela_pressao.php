<?php
    $id = "";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
    if($id != ""){
        $sql = "SELECT * FROM pressao WHERE id_nome ='".$id."'";
        $resultado = $conn->query($sql);

        if($resultado->num_rows > 0){
            while($linha = $resultado->fetch_assoc()){
                $date_pressao = new DateTime($linha['data']);
                echo "<tr>";
                echo "<td>".$linha['pressao']."</td>";
                echo "<td>".$date_pressao->format("d/m/Y")."</td>";
                echo "</tr>";
            }
        }
    }
?>