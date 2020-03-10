<?php
    session_start();
    require("PHP/conn.php");
    $id_qrcode = "";
    if(isset($_GET['id'])){
        $id_qrcode = $_GET['id'];
        $_SESSION['id_qrcode'] = $id_qrcode;
    }
    if($id_qrcode != ""){
        $sql = "SELECT * FROM pessoa WHERE id_qrcode ='". $id_qrcode . "'";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $id = $linha['id_nome'];
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
                $foto_perfil = $linha['foto_perfil'];
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
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meu Perfil</title>
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="JS/login.js"></script>
    <script type="text/javascript" src="JS/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="CSS/estilos.css" />
    <link rel="icon" href="PHP/uploads/logo.png">
</head>

<body>

    <?php require("./parts/navegacao.php"); ?>

    <div class="container mt-5">
        <div class="row">
            <main>
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Meu Perfil</h1>
                    </div>

                    <div class="bg-white shadow rounded overflow-hidden">
                        <div class="px-4 pt-0 pb-4">
                            <div class="card-body">
                                <div class="pb-2">
                                    <?php require("./parts/header_login.php"); ?>
                                </div>

                                <div class="form-group">
                                    <div class="input-group form-group text-center">
                                        <h2>Dados Pessoais</h2>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <label class="col-12"><strong>Email:</strong>
                                                <?php echo $email; ?></label>

                                            <label class="col-12"><strong>Sexo:</strong>
                                                <?php echo $sexo; ?></label>
                                                
                                            <label class="col-12"><strong>Data de Nascimento:</strong>
                                                <?php echo $datanascimento->format("d/m/Y"); ?></label>

                                            <label class="col-12"><strong>Altura:</strong>
                                                <?php echo $altura . "m"; ?></label>

                                            <label class="col-12"><strong>CPF:</strong> <?php echo $cpf; ?></label>

                                            <label class="col-12"><strong>CEP:</strong> <?php echo $cep; ?></label>

                                            <label class="col-12"><strong>Cidade/Estado:</strong>
                                                <?php echo $cidade . "/" . $estado; ?></label>

                                            <label class="col-12"><strong>Endereço:</strong>
                                                <?php echo $endereco; ?></label>

                                            <label class="col-12"><strong>Telefone:</strong>
                                                <?php echo $telefone; ?></label>

                                            <label class="col-12"><strong>Contato de Emergência:</strong>
                                                <?php echo $contatoemergencia; ?></label>

                                            <label class="col-12"><strong>Tipo Sanguíneo:</strong>
                                                <?php echo $tiposanguineo; ?></label>

                                            <label class="col-12"><strong>Alergias ou Doenças:</strong>
                                                <?php echo $alergiadoencas; ?></label>

                                            <label class="col-12"><strong>Plano de Saúde:</strong>
                                                <?php echo $planodesaude; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <img class="img-fluid grafico" src="./parts/grafico_peso.php"
                                        alt="Gráfico do seu peso">

                                    <img class="img-fluid grafico" src="./parts/grafico_pressao.php"
                                        alt="Gráfico da sua pressão">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>