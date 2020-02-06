<?php
    session_start();
    include("../PHP/conn.php");
    $id = "";
    $adm = false;
    $foto_perfil = "";
    if(isset($_SESSION['adm']) && isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $adm = $_SESSION['adm'];
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
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/estilos.css" />

</head>

<body>

    <?php include("./parts/navegacao.php"); ?>

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
                                <div>
                                    <?php include("./parts/header_login.php"); ?>
                                    <div class="p-5 text-center">
                                        <a href="atualizar.php">
                                            <button type="submit" class="btn btn-primary">Atualizar Dados</button>
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
                                        <h2>Suas informações cadastradas</h2>
                                    </div>
                                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                                    <p><strong>Sexo:</strong> <?php echo $sexo; ?></p>
                                    <p><strong>Data de Nascimento:</strong> <?php echo $datanascimento->format("d/m/Y"); ?></p>
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
                                    <img class="img-fluid" src="./parts/grafico_peso.php" alt="Gráfico do seu peso">
                                    <img class="img-fluid" src="./parts/grafico_pressao.php" alt="Gráfico da sua pressão">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script type="text/javascript" src="JS/impressao.js"></script>
        </div>
    </div>
</body>

</html>