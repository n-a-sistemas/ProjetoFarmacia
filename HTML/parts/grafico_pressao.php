<?php
    session_start();
    include('../../PHP/phplot-6.2.0/phplot.php');
    include('../../PHP/conn.php');
    
    $sql_pressao = "";
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
        $sql_pressao = "SELECT * FROM pressao WHERE id_nome = ".$id." ORDER BY data DESC";
    }
    
    if($sql_pressao != ""){
        $resultado = $conn->query($sql_pressao);
        if($resultado->num_rows > 0){
            while($linha = $resultado->fetch_assoc()){
                $data = $linha['data'];
                $data_pressao = DateTime::createFromFormat("Y-m-d", $data);
                list($sistolica, $diastolica) = explode("/", $linha['pressao']);
                $informacoes = array('data'=>$data_pressao->format("d-m-Y"), 'sistolica'=>(int)$sistolica, 'diastolica'=>(int)$diastolica);
                $pressaos[] = $informacoes;
            }
            for($i=0; $i<count($pressaos); $i++){
                if($i<=5){
                    $informacoes = array('data'=>$pressaos[$i]['data'], 'sistolica'=>$pressaos[$i]['sistolica'], 'diastolica'=>$pressaos[$i]['diastolica']);
                    $tabela_pressao[] = $informacoes;
                }
            }
            $tabela_pressao = array_reverse($tabela_pressao);
        }
        else{
            $tabela_pressao = array(array('data'=>date("d-m-Y"), 'sistolica'=>0, 'diastolica'=>0));
        }
        $plot = new PHPlot(500 , 500);
        $plot->SetTitle('Gráfico da sua pressão');
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
    }
?>