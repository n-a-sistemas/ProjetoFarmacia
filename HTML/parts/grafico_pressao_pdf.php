<?php
    $sql_pressao = "";
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
        $sql_pressao = "SELECT * FROM pressao WHERE id_nome = ".$id." ORDER BY data ASC";
    }
    
    if($sql_pressao != ""){
        $resultado = $conn->query($sql_pressao);
        if($resultado->num_rows > 0){
            while($linha = $resultado->fetch_assoc()){
                $data = $linha['data'];
                $data_pressao = new DateTime($data);
                $informacoes = array('data'=>$data_pressao->format("d/m/Y"), 'valor'=>$linha['pressao']);
                $pressoes[] = $informacoes;
            }
            $pressoes = array_reverse($pressoes);
            for($i=0; $i<count($pressoes); $i++){
                if($i<=5){
                    list($sistolica, $diastolica) = explode("/", $pressoes[$i]['valor']);
                    $informacoes = array('data'=>$pressoes[$i]['data'], 'sistolica'=>(int)$sistolica, 'diastolica'=>(int)$diastolica);
                    $tabela_pressao[] = $informacoes;
                }
            }
            $tabela_pressao = array_reverse($tabela_pressao);
        }
        else{
            $tabela_pressao = array(array('data'=>date("d/m/Y"), 'sistolica'=>0, 'diastolica'=>0));
        }
        $legenda = array('Sistólica', 'Diastólica');
        $plot = new PHPlot(500 , 500);
        $plot = new PHPlot(500 , 500);
        $plot->SetTitle('Gráfico da sua pressão');
        $plot->SetXTitle("Datas");
        $plot->SetYTitle("Pressão");
        $plot->SetLegend($legenda);
        $plot->SetLegendPosition(-4.9, 0.02, 'image', 0, 0, 0, 0);
        $plot->SetPrecisionY(1);
        $plot->SetPlotType("linepoints");
        $plot->SetDataValues($tabela_pressao);
        $plot->SetXTickPos('none');
        $plot->SetYTickPos('none');
        $plot->SetXLabelFontSize(2);
        $plot->SetAxisFontSize(2);
        $plot->SetIsInline(true);
        $plot->SetOutputFile('../PHP/grafico/grafico_pressao_'.$cpf.'.png');
        $plot->DrawGraph();
    }
?>