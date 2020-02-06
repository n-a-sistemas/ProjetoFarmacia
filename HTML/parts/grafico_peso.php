<?php
    session_start();
    include('../../PHP/phplot-6.2.0/phplot.php');
    include('../../PHP/conn.php');
    
    $sql_peso = "";
    $id = "";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
    else if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql_select = "SELECT * FROM pessoa WHERE id_qrcode ='". $id . "'";
        $resultado = $conn->query($sql_select);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $id = $linha['id_nome'];
            }
        }
    }
    if($id != ""){
        $sql_peso = "SELECT * FROM peso WHERE id_nome = ".$id." ORDER BY data ASC";
    }
    
    if($sql_peso != ""){
        $resultado = $conn->query($sql_peso);
        if($resultado->num_rows > 0){
            while($linha = $resultado->fetch_assoc()){
                $data = $linha['data'];
                $data_peso = DateTime::createFromFormat("Y-m-d", $data);
                $informacoes = array('data'=>$data_peso->format("d-m-Y"), 'peso'=>$linha['peso']);
                $tabela_peso[] = $informacoes;
            }
            if(count($tabela_peso) > 0 ){
                $plot = new PHPlot(500 , 500);
                $plot->SetTitle('Grafico do seu peso');
                $plot->SetXTitle("Datas");
                $plot->SetYTitle("Pesos");
                $plot->SetPrecisionY(1);
                $plot->SetPlotType("linepoints");
                $plot->SetDataValues($tabela_peso);
                $plot->SetXTickPos('none');
                $plot->SetYTickPos('none');
                $plot->SetXLabelFontSize(2);
                $plot->SetAxisFontSize(2);
                $plot->DrawGraph();
            }
        }
    }
?>