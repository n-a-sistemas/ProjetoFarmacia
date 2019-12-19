<?php
    include("conn.php");
    
    $sql = "SELECT * FROM estado ORDER BY nome ASC";
    $resultado = $conn->query($sql);

    if($resultado->num_rows > 0){
        while($linha = $resultado->fetch_assoc()){
            $test = array('id'=>$linha['id'], 'nome'=>$linha['nome'], 'uf'=>$linha['uf']);
            $estados[] = $test;
        }
    }
    else{
        $estados = "Nenhum resultado";
    }

    echo json_encode($estados);
?>