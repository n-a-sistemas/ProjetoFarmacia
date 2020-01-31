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
    
</head>
<body>
    
    <header>
        <?php include("./parts/header_login.php"); ?>
        <h1>Meu Perfil</h1>
    </header>

    <?php include("./parts/navegacao.php"); ?>

    <main>
        <div>
            <img src="./parts/grafico_peso.php" alt="Gráfico do seu peso">
            <img src="./parts/grafico_pressao.php" alt="Gráfico da sua pressão">
        </div>

        <div>
            <h2>Suas informações cadastradas</h2>
            <p>Email: <?php echo $email; ?></p>
            <p>Sexo: <?php echo $sexo; ?></p>
            <p>Data de Nascimento: <?php echo $datanascimento->format("d/m/Y"); ?></p>
            <p>Altura: <?php echo $altura . "m"; ?></p>
            <p>CPF: <?php echo $cpf; ?></p>
            <p>CEP: <?php echo $cep; ?></p>
            <p>Cidade/Estado: <?php echo $cidade . "/" . $estado; ?></p>
            <p>Endereço: <?php echo $endereco; ?></p>
            <p>Telefone: <?php echo $telefone; ?></p>
            <p>Contato de Emergência: <?php echo $contatoemergencia; ?></p>
            <p>Tipo Sanguíneo: <?php echo $tiposanguineo; ?></p>
            <p>Alergias ou Doenças: <?php echo $alergiadoencas; ?></p>
            <p>Plano de Saúde: <?php echo $planodesaude; ?></p>
        </div>
        <a href="atualizar.php"><button>Atualizar Dados</button></a>

        <button type="button" onclick="impressao();">Imprimir Qrcode</button>

        <div id="printable"> 
            <img src="../PHP/<?php echo $img;?>">
        </div>
    </main>
    <script type="text/javascript" src="JS/impressao.js"></script>
</body>
</html>