<?php
    include("conn.php");
    
    $sql = "SELECT * FROM cidade";
    $resultado = $conn->query($sql);

    if($resultado->num_rows > 0){
        while($linha = $resultado->fetch_assoc()){
            $test = array('id'=>$linha['id'], 'nome'=>$linha['nome'], 'uf'=>$linha['estado']);
            $cidades[] = $test;
        }
    }
    else{
        $cidades = "Nenhum resultado";
    }

    echo json_encode($cidades);
?>