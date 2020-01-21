<?php
    session_start();
    include('../../PHP/phplot-6.2.0/phplot.php');
    include('../../PHP/conn.php');
    
    /*
    $sql_peso = "";
    $id = "";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $sql_peso = "SELECT * FROM pressao WHERE id_nome =" . $id . "";
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
        $sql_pressao = "SELECT * FROM pressao WHERE id_nome =" . $id . "";
    }
    
    if($sql_pressao != ""){
        $resultado = $conn->query($sql_pressao);
        if($resultado->num_rows > 0){
            while($linha = $resultado->fetch_assoc()){
                $data = $linha['data'];
                $data_pressao = DateTime::createFromFormat("Y-m-d", $data);
                $informacoes = array('data'=>$data_peso->format("d-m-Y"), 'peso'=>$linha['pressao']);
                $tabela_pressao[] = $informacoes;
            }
            if(count($tabela_pressao) > 0 ){
                $plot = new PHPlot(500 , 500);
                $plot->SetTitle('Grafico da sua pressao');
                $plot->SetXTitle("Datas");
                $plot->SetYTitle("Pressão");
                $plot->SetPrecisionY(1);
                $plot->SetPlotType("linepoints");
                $plot->SetDataType("text-data");
                $plot->SetDataValues($tabela_pressao);
                $plot->SetXTickPos('none');
                $plot->SetXLabelFontSize(2);
                $plot->SetAxisFontSize(2);
                $plot->SetYDataLabelPos('plotin');
                $plot->DrawGraph();
            }
        }
    }
    */
    $informacoes = array('data'=>'08/01/2020', 'pressao'=>10/6);
    $tabela_pressao[] = $informacoes;
    $plot = new PHPlot(500 , 500);
    $plot->SetTitle('Grafico da sua pressao');
    $plot->SetXTitle("Datas");
    $plot->SetYTitle("Pressão");
    $plot->SetPrecisionY(1);
    $plot->SetPlotType("linepoints");
    $plot->SetDataValues($tabela_pressao);
    $plot->SetXTickPos('none');
    $plot->SetYTickPos('none');
    $plot->SetXLabelFontSize(2);
    $plot->SetAxisFontSize(2);
    $plot->DrawGraph();
?>