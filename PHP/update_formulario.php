<?php
    session_start();
    include('conn.php');
    include('phpqrcode/qrlib.php');
    date_default_timezone_set('America/Sao_Paulo');

    if(isset($_POST['nome']) && isset($_POST['email'])
    && isset($_POST['data_nascimento']) && isset($_POST['cpf'])
    && isset($_POST['sexo']) && isset($_POST['tel'])
    && isset($_POST['contato_emergencia'])
    && isset($_POST['tipo_sanguineo']) && isset($_POST['endereco'])
    && isset($_POST['altura']) && isset($_POST['cidades']) && isset($_POST['estados'])
    && isset($_POST['cep'])){
        $erro = false;
        $id_nome = "";
        $nome = $_POST['nome'];
        $email =  $_POST['email'];
        $datanascimento = $_POST['data_nascimento'];
        $cpf = $_POST['cpf'];
        $id_qrcode = hash('sha256', $cpf);
        $sexo  = $_POST['sexo'];
        $telefone = $_POST['tel'];
        $alergiadoencas = $_POST['alergias_doencas'];
        $tiposanguineo = $_POST['tipo_sanguineo'];
        $contatoemergencia = $_POST['contato_emergencia'];
        $planodesaude = $_POST['plano_de_saude'];
        $altura = $_POST['altura']; 
        $adm = false;
        $endereco = $_POST['endereco'];
        $cidade = $_POST['cidades'];
        $estado = $_POST['estados'];
        $cep = $_POST['cep'];
        $peso = $_POST['peso'];
        $pressao = $_POST['pressao'];
        $data_pressao = $_POST['data_pressao'];
        $data_peso = $_POST['data_peso'];
        if($data_pressao == ""){
            $data_pressao = date('Y-m-d');
        }
        if($data_peso == ""){
            $data_peso = date('Y-m-d');
        }
        if($alergiadoencas == ""){
            $alergiadoencas = "Nenhum";
        }
        if($planodesaude == ""){
            $planodesaude = "Nenhum";
        }
        if(($nome != "") && ($email != "") &&
            ($datanascimento != "") && ($cpf != "") &&
            ($sexo != "") && ($telefone != "") &&
            ($tiposanguineo != "") && ($contatoemergencia != "") && 
            ($altura != "") && ($endereco != "") && 
            ($cidade != "") && ($estado != "") && 
            ($cidade != "hint_cidades") && ($estado != "hint_estados") && 
            ($cep != "")){
            if(isset($_SESSION['id'])){
                $id_nome = $_SESSION['id'];
            }
            if($id_nome != ""){
                $sql = "SELECT * FROM pessoa WHERE id_nome = $id_nome";
                $resultado = $conn->query($sql);
                if($resultado->num_rows == 1){
                    while($linha = $resultado->fetch_assoc()){
                        $arquivo_antigo = $linha['foto_perfil'];
                        $cpf_antigo = $linha['cpf'];
                        $email_antigo = $linha['email'];
                    }
                }

                $diretorio = "uploads/";
                $arquivo = "";
                if($_FILES['imagemUpload']['name'] != ""){
                    $arquivo = $diretorio . basename($_FILES['imagemUpload']['name']);
                }
                else{
                    $arquivo = $arquivo_antigo;
                }

                $tipo = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
                if($arquivo != "" && $arquivo != $arquivo_antigo){
                    if(!move_uploaded_file($_FILES['imagemUpload']['tmp_name'], $arquivo)){
                        echo "Erro ao cadastrar imagem<br>";
                        $erro = true;
                    }
                }
                // how to configure pixel "zoom" factor
                $tempDir = "qrcodes/";
                $nomeqrcode = 'qrcode_'. $cpf.'.png';
                $codeContents = 'perfil.php?id=' . $id_qrcode;
                // generating
                QRcode::png($codeContents, $tempDir. $nomeqrcode, QR_ECLEVEL_L, 2);  

                $sql_pessoa = "UPDATE pessoa SET `nome`='".$nome."',`email`='".$email."',`endereco`='".$endereco."',
                `id_estado`='".$estado."',`id_cidade`='".$cidade."',`cep`='".$cep."',
                `foto_perfil`='".$arquivo."',`foto_qrcode`='".$tempDir . $nomeqrcode."',`id_qrcode`='".$id_qrcode."',
                `data_nascimento`='".$datanascimento."',`sexo`='".$sexo."',`cpf`='".$cpf."',
                `telefone`='".$telefone."',`telefone_emergencia`='".$contatoemergencia."',`altura`='".$altura."',
                `tipo_sanguineo`='".$tiposanguineo."',`alergia_doencas`='".$alergiadoencas."',`plano_saude`='".$planodesaude."' 
                WHERE cpf ='" . $cpf_antigo . "' AND email ='" . $email_antigo . "'";
                if($conn->query($sql_pessoa) == TRUE){
                    if($peso != ""){
                        $sql_peso = "INSERT INTO peso (id_nome, peso, data) VALUES ('$id_nome', '$peso','$data_peso')";
                        if($conn->query($sql_peso) != TRUE){
                            echo "Erro : " . $conn->error;
                            $erro = true;            
                        }
                    }
                    if($pressao != ""){
                        $sql_pressao = "INSERT INTO pressao (id_nome, pressao, data) VALUES ('$id_nome', '$pressao', '$data_pressao')";
                        if($conn->query($sql_peso) != TRUE){
                            echo "Erro : " . $conn->error;
                            $erro = true;  
                        }
                    }
                    if(!$erro){
                        header('Location: ../HTML/meuperfil.php');
                    }
                }
                else{
                    echo "Erro : " . $conn->error;
                }
            }
        }
        else{
            echo "<p>Erro ao atualizar seus dados, volte e preencha o formulário corretamente</p>";
        }
    }
    else{
        echo "<p>Erro ao atualizar seus dados, volte e preencha o formulário corretamente</p>";
        echo "<p>Se o erro persistir verifique no seu navegador se está ativo o javascript</p>";
    }
?>