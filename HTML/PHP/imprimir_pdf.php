<?php
    require('FPDF/fpdf.php');
    require('phplot-6.2.0/phplot.php');
    date_default_timezone_set('America/Sao_Paulo');
    require('conn.php');
    session_start();

    $id="";
    if(isset($_SESSION['id'])){
        $id=$_SESSION['id'];
    }
    if($id != ""){
        $sql = "SELECT * FROM pessoa WHERE id_nome ='".$id."'";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $nome = $linha['nome'];
                $email = $linha['email'];
                $data = $linha['data_nascimento'];
                $datanascimento = DateTime::createFromFormat("Y-m-d", $data);
                $cpf = $linha['cpf'];
                $sexo  = $linha['sexo'];
                $telefone = $linha['telefone'];
                $alergiadoencas = $linha['alergia_doencas'];
                $tiposanguineo = $linha['tipo_sanguineo'];
                $contatoemergencia = $linha['telefone_emergencia'];
                $planodesaude = $linha['plano_saude'];
                $altura = $linha['altura'];
                $altura = str_replace('.',',', $altura);
                $endereco = $linha['endereco'];
                $cidade = $linha['id_cidade'];
                $estado = $linha['id_estado'];
                $cep = $linha['cep'];
            }
        }
        $sql_cidade = "SELECT `id`, `nome` FROM cidade WHERE id = $cidade ORDER BY nome ASC";
        $resultado = $conn->query($sql_cidade);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $cidade = $linha['nome'];
            }
        }
        $sql_estado = "SELECT `id`, `uf` FROM estado WHERE id = $estado ORDER BY nome ASC";
        $resultado = $conn->query($sql_estado);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $estado = $linha['uf'];
            }
        }

        require('../parts/grafico_peso_pdf.php');
        require('../parts/grafico_pressao_pdf.php');
        
        if(count($pesos) != 0){
            $pesos = array_reverse($pesos);
        }
        else{
            $pesos = array(array('data'=>date("d/m/Y"), 'valor'=>0));
        }
        if(count($pressoes) != 0){
            $pressoes = array_reverse($pressoes);
        }
        else{
            $pressoes = array(array('data'=>date("d/m/Y"), 'valor'=>0));
        }

        class PDF extends FPDF
        {
            function Header()
            {
                // Logo
                $this->Image('../IMG/logo.png',10,6,30);
                // Arial bold 15
                $this->SetFont('Arial','B',15);
                // Move to the right
                $this->Cell(160);
                // Data atual
                $this->Cell(80,10,date('d/m/Y'),0,1);
                // Title
                $this->Cell(80);
                $this->Cell(30,10,'Fármacia',1,0,'C');
                // Line break
                $this->Ln(30);
            }
            function FancyTable($header, $data, $texto)
            {
                // Colors, line width and bold font
                $this->SetLeftMargin(70);
                //$this->SetTopMargin(20);
                //$this->SetAutoPageBreak(70);
                $this->SetFillColor(255,0,0);
                $this->SetTextColor(0);
                $this->SetDrawColor(128,0,0);
                $this->SetLineWidth(.3);
                $this->SetFont('','B');
                $this->Cell(75,10,$texto, 1, 1, 'C');
                // Header
                $w = array(25, 50);
                $this->SetTextColor(255);
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                $this->Ln();
                // Color and font restoration
                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);
                $this->SetFont('');
                // Data
                $fill = false;
                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$row['valor'],'LR',0,'C',$fill);
                    $this->Cell($w[1],6,$row['data'],'LR',0,'C',$fill);
                    $this->Ln();
                    $fill = !$fill;
                }
                // Closing line
                $this->Cell(array_sum($w),2,'','T');
            }
        }

        $pdf = new PDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(14,10,'Dados Pessoais: ', 0, 1);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(14,10,'Nome: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(80,10,$nome, 0, 1);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(14,10,'Email: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(80,10,$email, 0, 1);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(13,10,'Sexo: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(25,10,$sexo, 0, 0);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(43,10,'Data de Nascimento: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(20,10,$datanascimento->format("d/m/Y"), 0, 1);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(11,10,'CPF: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(35,10,$cpf, 0, 0);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(15,10,'Altura: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(35,10,$altura."m", 0, 1);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(11,10,'CEP: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(25,10,$cep, 0, 0);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(32,10,'Cidade/Estado: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(80,10,$cidade."/".$estado, 0, 1);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(22,10,'Endereço: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(80,10,$endereco, 0, 1);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(20,10,'Telefone: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(35,10,$telefone, 0, 0);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(44,10,'Contato Emergência: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(25,10,$contatoemergencia, 0, 1);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(35,10,'Tipo Sanguíneo: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(10,10,$tiposanguineo, 0, 0);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(34,10,'Plano de saúde: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(25,10,$planodesaude, 0, 1);
        $pdf->SetFont('Arial','',16);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(43,10,'Alergia ou Doenças: ', 0, 0);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(25,10,$alergiadoencas, 0, 1);
        $pdf->SetFont('Arial','',16);

        $pdf->Image('grafico/grafico_peso_'.$cpf.'.png', 5,150,100);
        $pdf->Image('grafico/grafico_pressao_'.$cpf.'.png', 105,150,100);

        $header_peso = array('Peso', 'Data da Pesagem');
        $header_pressao = array('Pressão', 'Data da Pressão');

        $pdf->AddPage();
        $pdf->SetFont('Arial','',14);
        //$pdf->Image('uploads/peso.png',35,63,30);
        $pdf->FancyTable($header_peso,$pesos,'Tabela de pesagem');

        $pdf->Ln(30);
        //$pdf->Image('uploads/pressao.png',35,130,30);
        $pdf->FancyTable($header_pressao,$pressoes,'Tabela de pressões');

        $pdf->Output();
    }
?>