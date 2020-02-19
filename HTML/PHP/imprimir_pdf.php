<?php
    require('FPDF/fpdf.php');
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
                $altura = str_replace(',','.', $altura);
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

        class PDF extends FPDF
        {
            function Header()
            {
                // Logo
                $this->Image('./uploads/logo.png',10,6,30);
                // Arial bold 15
                $this->SetFont('Arial','B',15);
                // Move to the right
                $this->Cell(80);
                // Title
                $this->Cell(30,10,'Fármacia',1,0,'C');
                // Line break
                $this->Ln(30);
            }
        }

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->SetFont('Arial','',16);
        $pdf->Cell(0,10,'Nome: '. $nome, 0, 1);
        $pdf->Cell(0,10,'Email: '. $email, 0, 1);
        $pdf->Cell(0,10,'Sexo: '. $sexo, 0, 1);
        $pdf->Cell(0,10,'Data de Nascimento: '. $datanascimento->format("d/m/Y"), 0, 1);
        $pdf->Cell(0,10,'Altura: '. $altura, 0, 1);
        $pdf->Cell(0,10,'CPF: '. $cpf, 0, 1);
        $pdf->Cell(0,10,'CEP: '. $cep, 0, 1);
        $pdf->Cell(0,10,'Cidade/Estado: '. $cidade."/".$estado, 0, 1);
        $pdf->Cell(0,10,'Endereco: '. $endereco, 0, 1);
        $pdf->Cell(0,10,'Telefone: '. $telefone, 0, 1);
        $pdf->Cell(0,10,'Contato Emergência: '. $contatoemergencia, 0, 1);
        $pdf->Cell(0,10,'Tipo Sanguíneo: '. $tiposanguineo, 0, 1);
        $pdf->Cell(0,10,'Alergia ou Doenças: '. $alergiadoencas, 0, 1);
        $pdf->Cell(0,10,'Plano de saúde: '. $planodesaude, 0, 1);
        

        $pdf->Output();
    }
?>