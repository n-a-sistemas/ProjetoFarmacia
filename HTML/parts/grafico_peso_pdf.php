<?php
    $sql_peso = "";
    $id = "";
    
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
    if(isset($_SESSION['id_qrcode'])){
        $id = $_SESSION['id_qrcode'];
        $sql_select = "SELECT * FROM pessoa WHERE id_qrcode ='". $id . "'";
        $resultado = $conn->query($sql_select);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $id = $linha['id_nome'];
            }
        }
    }
    
    if($id != ""){
        $sql_select = "SELECT * FROM pessoa WHERE id_nome ='". $id . "'";
        $resultado = $conn->query($sql_select);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $cpf = $linha['cpf'];
            }
        }
        $sql_peso = "SELECT * FROM peso WHERE id_nome = ".$id." ORDER BY data ASC";
    }
    
    if($sql_peso != ""){
        $resultado = $conn->query($sql_peso);
        if($resultado->num_rows > 0){
            while($linha = $resultado->fetch_assoc()){
                $data = $linha['data'];
                $data_peso = new DateTime($data);;
                $informacoes = array('data'=>$data_peso->format("d/m/Y"), 'valor'=>$linha['peso']);
                $pesos[] = $informacoes;
            }
            $pesos = array_reverse($pesos);
            for($i=0; $i<count($pesos); $i++){
                if($i<=5){
                    $informacoes = array('data'=>$pesos[$i]['data'], 'peso'=>$pesos[$i]['valor']);
                    $tabela_peso[] = $informacoes;
                }
            }
            $tabela_peso = array_reverse($tabela_peso);
        }
        else{
            $tabela_peso = array(array('data'=>date("d/m/Y"), 'peso'=>0));
        }
        $plot = new PHPlot(500 , 500);
        $plot->SetTitle('Gráfico do seu peso');
        $plot->SetXTitle("Datas");
        $plot->SetYTitle("Pesos");
        $plot->SetPrecisionY(1);
        $plot->SetPlotType("linepoints");
        $plot->SetDataValues($tabela_peso);
        $plot->SetXTickPos('none');
        $plot->SetYTickPos('none');
        $plot->SetXLabelFontSize(2);
        $plot->SetAxisFontSize(2);
        $plot->SetIsInline(true);
        $plot->SetOutputFile('../PHP/grafico/grafico_peso_'.$cpf.'.png');
        $plot->DrawGraph();
    }
?>