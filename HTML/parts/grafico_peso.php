<?php
    session_start();
    include('../../PHP/phplot-6.2.0/phplot.php');
    include('../../PHP/conn.php');
    
    $id = "";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
    $sql_peso = "SELECT * FROM peso WHERE id_nome =" . $id . ""; //ORDER BY data ASC
    $resultado = $conn->query($sql_peso);
    if($resultado->num_rows > 0){
        while($linha = $resultado->fetch_assoc()){
            $data = $linha['data'];
            $data_peso = DateTime::createFromFormat("Y-m-d", $data);
            $informacoes = array('data'=>$data_peso->format("d-m-Y"), 'peso'=>$linha['peso']);
            $test[] = $informacoes;
            for($i = 0; $i < count($test); $i++){

            }
            $valores[] = $informacoes;
        }
        if(count($valores) > 0 ){
            $plot = new PHPlot(500 , 500);
            $plot->SetTitle('Grafico do seu peso');
            $plot->SetPrecisionY(1);
            $plot->SetPlotType("linepoints");
            $plot->SetPlotType("linepoints");
            $plot->SetDataType("text-data");
            $plot->SetDataValues($valores);
            $plot->SetXTickPos('none');
            $plot->SetXLabelFontSize(2);
            $plot->SetAxisFontSize(2);
            $plot->SetYDataLabelPos('plotin');
            $plot->DrawGraph();
        }
    }
?>