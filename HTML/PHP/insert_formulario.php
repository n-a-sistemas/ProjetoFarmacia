<?php

    require('conn.php');
    require('phpqrcode/qrlib.php');
    date_default_timezone_set('America/Sao_Paulo');
    session_start();
    $adm = 0;
    $_SESSION['erro_cadastro'] = "";
    $_SESSION['alert_imagem'] = "";

    if(isset($_POST['nome']) && isset($_POST['email'])
    && isset($_POST['data_nascimento']) && isset($_POST['cpf'])
    && isset($_POST['sexo']) && isset($_POST['tel'])
    && isset($_POST['contato_emergencia']) && isset($_POST['senha']) && isset($_POST['confirmacao'])
    && isset($_POST['tipo_sanguineo']) && isset($_POST['endereco'])
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
        $confirmacao = $_POST['confirmacao'];
        $altura = $_POST['altura']; 
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
            ($senha != "") && ($senha == $confirmacao) && ($altura != "") &&
            ($endereco != "") && ($cidade != "") &&
            ($estado != "") && ($cidade != "hint_cidades") &&
            ($estado != "hint_estados") && ($cep != "") &&
            ($peso != "")){
            $arquivo = "";
            $senha = hash('sha256', $senha);
            $altura = str_replace(',','.', $altura);

            $diretorio = "uploads/";
            if($_FILES['imagemUpload']['name'] != ""){
                $arquivo = $diretorio . basename($_FILES['imagemUpload']['name']);
            }
            else{
                $arquivo = $diretorio . "user.png";
            }
            $tipo = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

            $sql_foto = "SELECT `foto_perfil` FROM pessoa WHERE foto_perfil ='".$arquivo."'";
            $resultado_foto = $conn->query($sql_foto);
            if($resultado_foto->num_rows == 0){
                if(!move_uploaded_file($_FILES['imagemUpload']['tmp_name'], $arquivo)){
                    $erro = "Erro ao cadastrar imagem";
                    $_SESSION['alert_imagem'] = $erro;
                }
            }

            $sql_select_cpf = "SELECT * FROM pessoa WHERE cpf ='" . $cpf . "'";
            $resultado_cpf = $conn->query($sql_select_cpf);
            $sql_select_email = "SELECT * FROM pessoa WHERE email ='" . $email . "'";
            $resultado_email = $conn->query($sql_select_email);
            if($resultado_cpf->num_rows == 0 && $resultado_email->num_rows == 0){
                // how to configure pixel "zoom" factor
                $tempDir = "qrcodes/";
                $nomeqrcode = 'qrcode_'. $cpf . '.png';
                $codeContents = 'http://localhost:8080/perfil.php?id=' . $id;
                // generating
                QRcode::png($codeContents, $tempDir. $nomeqrcode, QR_ECLEVEL_L, 2);  

                $sql_pessoa = "INSERT INTO pessoa (nome,email,data_nascimento,cpf,sexo,telefone,alergia_doencas,tipo_sanguineo,telefone_emergencia,plano_saude,senha,altura,foto_qrcode,foto_perfil,adm,id_cidade,id_estado,cep,endereco,id_qrcode) 
                        VALUES ('$nome', '$email','$datanascimento','$cpf','$sexo','$telefone','$alergiadoencas','$tiposanguineo','$contatoemergencia','$planodesaude','$senha','$altura','$tempDir$nomeqrcode','$arquivo', '$adm','$cidade','$estado','$cep','$endereco','$id')";
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
                        $erro = $conn->error;
                        $_SESSION['erro_cadastro'] = $erro;
                    }
                    if($pressao != ""){
                        $sql_pressao = "INSERT INTO pressao (id_nome, pressao, data) VALUES ('$id', '$pressao', '$data_pressao')";
                        if($conn->query($sql_pressao) != TRUE){
                            $erro = $conn->error;
                            $_SESSION['erro_cadastro'] = $erro;
                        }
                    }
                }
                else{
                    $erro = $conn->error;
                    $_SESSION['erro_cadastro'] = $erro;
                }
            }
            else{
                $erro = "Já foi cadastrado alguém com esse CPF ou email";
                $_SESSION['erro_cadastro'] = $erro;
            }
        }
        else{
            $erro = "Erro ao cadastrar, preencha todos os campos do formulário corretamente";
            $_SESSION['erro_cadastro'] = $erro;
        }
    }
    else{
        $erro = "Erro ao cadastrar, preencha todos os campos do formulário corretamente. Se o erro persistir verifique no seu navegador se está ativo o javascript";
        $_SESSION['erro_cadastro'] = $erro;
    }

    if($_SESSION['erro_cadastro'] == ""){
        header('Location: ../index.php');
    }
    else{
        header('Location: ../cadastro.php');
    }
?>