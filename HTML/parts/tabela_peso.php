<?php
    $id = "";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
    if($id != ""){
        $sql = "SELECT * FROM peso WHERE id_nome ='".$id."'";
        $resultado = $conn->query($sql);

        if($resultado->num_rows > 0){
            while($linha = $resultado->fetch_assoc()){
                $date_peso = new DateTime($linha['data']);
                echo "<tr>";
                echo "<td>".$linha['peso']."kg</td>";
                echo "<td>".$date_peso->format("d/m/Y")."</td>";
                echo "</tr>";
            }
        }
    }
?>