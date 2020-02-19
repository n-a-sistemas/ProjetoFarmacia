<?php
    session_start();
    unset($_SESSION["id_qrcode"]);
    require("PHP/conn.php");
    $id = "";
    $adm = false;
    $foto_perfil = "";
    if(isset($_SESSION['adm']) && isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $adm = $_SESSION['adm'];
    }
    else{
        header('Location: index.php');
    }
    $erro = "";
    if(isset($_SESSION['erro'])){
        $erro = $_SESSION['erro'];
    }

    if($id != ""){
        $sql = "SELECT * FROM pessoa WHERE id_nome = $id";
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
                $foto_perfil = $linha['foto_perfil'];
                $img = $linha['foto_qrcode'];
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
    $session = "erro";
    $page = 'meuperfil.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Meu Perfil</title>
    <link rel="stylesheet" href="./CSS/meu_perfil.css">
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
    <link rel="stylesheet" href="CSS/cadastro.css">
    <script src="JS/cadastro.js"></script>
</head>

<body>

    <?php include("./parts/navegacao.php"); ?>

    <div class="container mt-5">
        <div class="row">
            <main>
                <div class="card">
                    <?php
                        if($erro != ""){
                            include("./parts/erro.php");
                        }
                    ?>
                    <div class="card-header text-center">
                        <h1>Meu Perfil</h1>
                    </div>
                    <div class="bg-white shadow rounded overflow-hidden">
                        <div class="px-4 pt-0 pb-4">
                            <div class="card-body">
                                <div>
                                    <?php include("./parts/header_login.php"); ?>
                                    <div class="p-5 text-center">
                                        <a href="atualizar.php">
                                            <button type="submit" class="btn btn-primary my-3">Atualizar Dados</button>
                                        </a>
                                        <button class="btn btn-danger" type="button" onclick="impressao();">Imprimir
                                            Qrcode</button>
                                        <div id="printable">
                                            <img src="../PHP/<?php echo $img;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group form-group text-center">
                                        <h2>Dados Pessoais</h2>
                                    </div>
                                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                                    <p><strong>Sexo:</strong> <?php echo $sexo; ?></p>
                                    <p><strong>Data de Nascimento:</strong>
                                        <?php echo $datanascimento->format("d/m/Y"); ?></p>
                                    <p><strong>Altura:</strong> <?php echo $altura . "m"; ?></p>
                                    <p><strong>CPF:</strong> <?php echo $cpf; ?></p>
                                    <p><strong>CEP:</strong> <?php echo $cep; ?></p>
                                    <p><strong>Cidade/Estado:</strong> <?php echo $cidade . "/" . $estado; ?></p>
                                    <p><strong>Endereço:</strong> <?php echo $endereco; ?></p>
                                    <p><strong>Telefone:</strong> <?php echo $telefone; ?></p>
                                    <p><strong>Contato de Emergência:</strong> <?php echo $contatoemergencia; ?></p>
                                    <p><strong>Tipo Sanguíneo:</strong> <?php echo $tiposanguineo; ?></p>
                                    <p><strong>Alergias ou Doenças:</strong> <?php echo $alergiadoencas; ?></p>
                                    <p><strong>Plano de Saúde:</strong> <?php echo $planodesaude; ?></p>
                                </div>
                                <div>
                                    <img class='img-fluid' src='./parts/grafico_peso.php' alt='Gráfico do seu peso'>
                                    <img class='img-fluid' src='./parts/grafico_pressao.php'
                                        alt='Gráfico da sua pressão'>
                                </div>
                                <div class="modal fade" id="modalPesoForm" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h4 class="modal-title w-100 font-weight-bold">Atualizar Peso</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body mx-3">
                                                <form action="PHP/insert_peso.php" method="post">
                                                    <div class="md-form mb-5">
                                                        <label for="peso" data-error="wrong" data-success="right"
                                                            class="col-auto control-label">Peso:</label>
                                                        <input type="text" name="peso" id="peso" data-mask="0,00"
                                                            data-mask-reverse="true" class="form-control">
                                                    </div>
                                                    <div class="md-form mb-4">
                                                        <label data-error="wrong" data-success="right" for="data_peso"
                                                            class="col-auto control-label">Data
                                                            da Pesagem:</label>
                                                        <input type="date" name="data_peso" id="data_peso"
                                                            class="form-control">

                                                        <label for="data_peso">*Se deixar vazio o campo, ele enviará a
                                                            data
                                                            atual.</label>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-danger">Atualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="modalPressaoForm" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h4 class="modal-title w-100 font-weight-bold">Atualizar Pressão</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body mx-3">
                                                <form action="PHP/insert_pressao.php" method="post">
                                                    <div class="md-form mb-5">
                                                        <label for="pressao" data-error="wrong" data-success="right"
                                                            class="col-auto control-label">Pressão:</label>
                                                        <input type="text" name="pressao" id="pressao"
                                                            data-mask="000/000" class=" form-control">
                                                    </div>
                                                    <div class="md-form mb-4">
                                                        <label data-error="wrong" data-success="right"
                                                            for="data_pressao" class="col-auto control-label">Data
                                                            da Pressão:</label>
                                                        <input type="date" name="data_pressao" id="data_pressao"
                                                            class=" form-control">
                                                        <label for="data_peso">*Se deixar vazio o campo, ele enviará a
                                                            data
                                                            atual.</label>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button class="btn btn-danger">Atualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-md-start justify-content-xl-around">
                                    <a href="" class="btn btn-danger btn-rounded btn-block m-3" data-toggle="modal"
                                        data-target="#modalPesoForm">Atualizar Peso</a>

                                    <a href="" class="btn btn-danger btn-rounded btn-block m-3" data-toggle="modal"
                                        data-target="#modalPressaoForm">Atualizar Pressão</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script type="text/javascript" src="JS/impressao.js"></script>
        </div>
    </div>
    <script src="JS/Mascaras/js/jquery.mask.min.js"></script>
</body>

</html>