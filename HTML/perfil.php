<?php
    session_start();
    session_unset(); // limpa todas as variáveis de sessão
    session_destroy(); // destroi a sessão
    include("../PHP/conn.php");
    $id_qrcode = "";
    if(isset($_GET['id'])){
        $id_qrcode = $_GET['id'];
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
</head>
<body>
    
    <header>
        <?php include("./parts/header_login.php"); ?>
        <h1>Meu Perfil</h1>
    </header>

    <?php include("./parts/navegacao.php"); ?>

    <main>
        <div>
            <img src="./parts/grafico_peso.php?id=<?php echo $id_qrcode;?>" alt="Gráfico do seu peso">
        </div>

        <div>
            <h2>Suas informações cadastradas</h2>
            <p>Email: <?php echo $email; ?></p>
            <p>Sexo: <?php echo $sexo; ?></p>
            <p>Data de Nascimento: <?php echo $datanascimento->format("d-m-Y"); ?></p>
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
    </main>
</body>
</html>