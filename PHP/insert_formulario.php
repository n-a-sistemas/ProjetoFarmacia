<?php

    include('conn.php');
    include('phpqrcode/qrlib.php');

    if(isset($_POST['nome']) && isset($_POST['email'])
    && isset($_POST['data_nascimento']) && isset($_POST['cpf'])
    && isset($_POST['sexo']) && isset($_POST['tel'])
    && isset($_POST['contato_emergencia']) && isset($_POST['senha']) && isset($_POST['confirmacao'])
    && isset($_POST['alergias_doencas']) && isset($_POST['tipo_sanguineo'])
    && isset($_POST['plano_de_saude']) && isset($_POST['endereco'])
    && isset($_POST['altura']) && isset($_POST['cidades'])
    && isset($_POST['estados']) && isset($_POST['cep']) 
    && isset($_POST['peso'])){
        $nome = $_POST['nome'];
        $email =  $_POST['email'];
        $datanascimento = $_POST['data_nascimento'];
        $cpf = $_POST['cpf'];
        $id = hash('sha256', $cpf);
        $sexo  = $_POST['sexo'];
        $telefone = $_POST['tel'];
        $alergiadoencas = $_POST['alergias_doencas'];
        $tiposanguineo = $_POST['tipo_sanguineo'];
        $contatoemergencia = $_POST['contato_emergencia'];
        $planodesaude = $_POST['plano_de_saude'];
        $senha  = $_POST['senha'];
        $senha = hash('sha256', $senha);
        $confirmacao = $_POST['confirmacao'];
        $altura = $_POST['altura']; 
        $adm = false;
        $endereco = $_POST['endereco'];
        $cidade = $_POST['cidades'];
        $estado = $_POST['estados'];
        $cep = $_POST['cep'];
        $peso = $_POST['peso'];
        $pressao = "";
        $data_peso = date("Y-m-d");
        $data_pressao = date("Y-m-d");
        if(isset($_POST['pressao'])){
            $pressao = $_POST['pressao'];
        }
        if(isset($_POST['data_pressao'])){
            $data_pressao = $_POST['data_pressao'];
        }
        if(isset($_POST['data_peso'])){
            $data_peso = $_POST['data_peso'];
        }

        if(($nome != "") && ($email != "") &&
            ($datanascimento != "") && ($cpf != "") &&
            ($sexo != "") && ($telefone != "") &&
            ($alergiadoencas != "") && ($tiposanguineo != "") &&
            ($contatoemergencia != "") && ($planodesaude != "") &&
            ($senha != "") && ($senha == $confirmacao) && ($altura != "") &&
            ($endereco != "") && ($cidade != "") &&
            ($estado != "") && ($cidade != "hint_cidades") &&
            ($estado != "hint_estados") && ($cep != "") &&
            ($peso != "")){
            $arquivo = "";
            if($_FILES['imagemUpload']['name'] != ""){
                $diretorio = "uploads/";
                $arquivo = $diretorio . basename($_FILES['imagemUpload']['name']);

                $tipo = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

                if(move_uploaded_file($_FILES['imagemUpload']['tmp_name'], $arquivo)){
                }
                else{
                    echo "Erro ao cadastrar imagem";
                    $arquivo = "";
                }
            }
            $sql_select = "SELECT * FROM pessoa WHERE cpf ='" . $cpf . "' AND email ='" . $email . "'";
            $resultado = $conn->query($sql_select);
            if($resultado->num_rows == 0){
                // how to configure pixel "zoom" factor
                $tempDir = "qrcodes/";
                $nomeqrcode = 'qrcode_'. $cpf.'.png';
                $codeContents = 'perfil.php?id=' . $id;
                // generating
                QRcode::png($codeContents, $tempDir. $nomeqrcode, QR_ECLEVEL_L, 2);  

                $sql_pessoa = "INSERT INTO pessoa (nome,email,data_nascimento,cpf,sexo,telefone,alergia_doencas,tipo_sanguineo,telefone_emergencia,plano_saude,senha,altura,foto_qrcode,foto_perfil,adm,id_cidade,id_estado,cep,endereco) 
                        VALUES ('$nome', '$email','$datanascimento','$cpf','$sexo','$telefone','$alergiadoencas','$tiposanguineo','$contatoemergencia','$planodesaude','$senha','$altura','$tempDir . $nomeqrcode','$arquivo','$adm','$cidade','$estado','$cep','$endereco')";

                if($conn->query($sql_pessoa) == TRUE){
                    $sql_select = "SELECT * FROM pessoa WHERE cpf ='" . $cpf . "' AND email ='" . $email . "'";
                    $resultado = $conn->query($sql_select);
                    $id = "";
                    if($resultado->num_rows == 1){
                        while($linha = $resultado->fetch_assoc()){
                            $id = $linha['id_nome'];
                        }
                    }
                    $sql_peso = "INSERT INTO peso (id_nome, peso, data) VALUES ('$id', '$peso','$data_peso')";
                    if($conn->query($sql_peso) != TRUE){
                        echo "Erro : " . $conn->error;    
                    }
                    if($pressao != ""){
                        $sql_pressao = "INSERT INTO pressao (id_nome, pressao, data) VALUES ('$id', '$pressao', '$data_pressao')";
                        if($conn->query($sql_peso) != TRUE){
                            echo "Erro : " . $conn->error;    
                        }
                    }
                }
                else{
                    echo "Erro : " . $conn->error;
                }
            }
            else{
                echo "<p>Já foi cadastrado alguém com esse CPF ou email</p>";
            }
        }
        else{
            echo "<p>Erro ao cadastrar, volte e preencha o formulário corretamente</p>";
        }
    }
    else{
        echo "<p>Erro ao cadastrar, volte e preencha o formulário corretamente</p>";
        echo "<p>Se o erro persistir verifique no seu navegador se está ativo o javascript</p>";
    }
?>