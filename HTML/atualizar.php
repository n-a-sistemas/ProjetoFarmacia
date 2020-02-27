<?php
    session_start();
    unset($_SESSION["id_qrcode"]);
    require("PHP/conn.php");
    $id = "";
    $foto_perfil = "";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
    else{
        header('Location: index.php');
    }
    
    $sql = "SELECT * FROM pessoa WHERE id_nome = $id";
    $resultado = $conn->query($sql);
    if($resultado->num_rows == 1){
        while($linha = $resultado->fetch_assoc()){
            $nome = $linha['nome'];
            $email = $linha['email'];
            $data_nascimento = $linha['data_nascimento'];
            $cpf = $linha['cpf'];
            $sexo  = $linha['sexo'];
            $telefone = $linha['telefone'];
            $alergiadoencas = $linha['alergia_doencas'];
            $tiposanguineo = $linha['tipo_sanguineo'];
            $contatoemergencia = $linha['telefone_emergencia'];
            $planodesaude = $linha['plano_saude'];
            $altura = $linha['altura']; 
            $endereco = $linha['endereco'];
            $id_cidade = $linha['id_cidade'];
            $id_estado = $linha['id_estado'];
            $cep = $linha['cep'];
            $foto_perfil = $linha['foto_perfil'];
        }
        $sql_cidade = "SELECT `id`, `nome` FROM cidade WHERE id = $id_cidade ORDER BY nome ASC";
        $resultado = $conn->query($sql_cidade);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $cidade = $linha['nome'];
            }
        }
        $sql_estado = "SELECT `id`, `nome` FROM cidade WHERE id = $id_estado ORDER BY nome ASC";
        $resultado = $conn->query($sql_estado);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $estado = $linha['nome'];
            }
        }
    }

    $erro = "";
    $alerta = "";
    if(isset($_SESSION['erro_atualizar'])){
        $erro = $_SESSION['erro_atualizar'];
    }
    if(isset($_SESSION['alert_imagem'])){
        $alerta = $_SESSION['alert_imagem'];
    }
    
    $session = "erro_atualizar";
    $session_alert = "alert_imagem";
    $page = 'atualizar.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atualização de dados</title>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/estilos.css" />
    <link rel="stylesheet" href="CSS/cadastro.css">
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/cadastro.js"></script>
    <script type="text/javascript" src="JS/bootstrap.min.js"></script>
</head>

<body>
    <?php require("./parts/navegacao.php"); ?>
    <div class="container d-flex justify-content-center">
        <div class="row">
            <main>
                <?php
                    if($erro != ""){
                        include("./parts/erro.php");
                    }
                    if($alerta != ""){
                        include("./parts/alert.php");
                    }
                ?>
                <form class="form-horizontal" role="form" action="PHP/update_formulario.php" method="POST"
                    enctype="multipart/form-data" onsubmit="return validaFormulario();">
                    <div class="p-2">
                        <?php include("./parts/header_login.php"); ?>
                    </div>
                    <fieldset class="form-group required">
                        <legend>Dados pessoais</legend>
                        <div class="form-group required">
                            <label for="nome" class="col-auto control-label font-weight-bold">Nome Completo</label>
                            <div class="col-auto">
                                <input value="<?php echo $nome ?>" type="text" name="nome" id="nome"
                                    class="form-control" placeholder="Nome" required>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="email" class="col-auto control-label font-weight-bold">Email</label>
                            <div class="col-auto">
                                <input value="<?php echo $email ?>" type="email" name="email" id="email"
                                    onblur="confirmaEmail()" class="form-control" placeholder="Email" required>
                            </div>
                            <label for="email" id="errorEmail"></label>
                        </div>
                        <fieldset class="form-group mb-3">
                            <legend class="control-label font-weight-bold">Sexo</legend>
                            <div class="col-auto custom-control custom-radio">
                                <div class="col-auto">
                                    <input class="custom-control-input" type="radio" name="sexo" id="Masculino"
                                        value="Masculino" <?php echo ($sexo == "Masculino") ? "checked" : null; ?>>
                                    <label class="custom-control-label" for="Masculino">Masculino</label>
                                </div>
                                <div class="col-auto">
                                    <input class="custom-control-input" type="radio" name="sexo" id="Feminino"
                                        value="Feminino" <?php echo ($sexo == "Feminino") ? "checked" : null; ?>>
                                    <label class="custom-control-label" for="Feminino">Feminino</label>
                                </div>
                                <div class="col-auto">
                                    <input class="custom-control-input" type="radio" name="sexo" id="Outros"
                                        value="Outros" <?php echo ($sexo == "Outros") ? "checked" : null; ?>>
                                    <label class="custom-control-label" for="Outros">Outros</label>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <label for="data_nascimento" class="col-auto control-label font-weight-bold">Data de Nascimento</label>
                            <div class="col-auto">
                                <input value="<?php echo $data_nascimento ?>" type="date" name="data_nascimento"
                                    id="data_nascimento" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cpf" class="col-auto control-label font-weight-bold">CPF</label>
                            <div class="col-auto">
                                <input value="<?php echo $cpf ?>" type="text" name="cpf" id="cpf" minlength="14"
                                    maxlength="14" onblur="confirmaCPF()" class="form-control" placeholder="CPF"
                                    data-mask="000.000.000-00" required>
                            </div>
                            <label for="cpf" class="col-auto text-muted">ex:111.222.333-44</label>
                            <label for="cpf" id="alerta_cpf">Ao editar esse campo é possivel que o QR Code precise ser
                                trocado.</label>
                        </div>

                        <div class="form-group">
                            <label for="tel" class="col-auto control-label font-weight-bold">Telefone</label>
                            <div class="col-auto">
                                <input value="<?php echo $telefone ?>" type="tel" name="tel" id="tel" minlength="14"
                                    maxlength="14" onblur="confirmaTelefone('tel')" class="form-control"
                                    placeholder="Telefone" data-mask="(00)00000-0000" required>
                            </div>
                            <label for="tel" class="col-auto text-muted">ex:(16)91111-4444</label>
                        </div>
                        <div class="form-group">
                            <label for="contato_emergencia" class="col-auto control-label font-weight-bold">Contato de Emergência</label>
                            <div class="col-auto">
                                <input value="<?php echo $contatoemergencia ?>" type="tel" name="contato_emergencia"
                                    id="contato_emergencia" minlength="14" maxlength="14"
                                    onblur="confirmaTelefone('contato_emergencia')" class="form-control"
                                    placeholder="Contato de Emergência" data-mask="(00)00000-0000" required>
                            </div>
                            <label for="contato_emergencia" class="col-auto text-muted">ex:(16)91111-4444</label>
                        </div>
                    </fieldset>
                    <fieldset class="form-group required">
                        <legend class="font-weight-bold">Endereço</legend>
                        <div class="form-group">
                            <label for="cep" class="col-auto control-label font-weight-bold">CEP</label>
                            <div class="col-auto">
                                <input value="<?php echo $cep ?>" type="text" name="cep" id="cep" minlength="9"
                                    maxlength="9" class="form-control" placeholder="CEP" data-mask="00000-000" required>
                            </div>
                            <label for="cep" class="col-auto text-muted">ex:91111-111</label>
                        </div>
                        <div class="form-group">
                            <label for="estados" class="col-auto control-label font-weight-bold">Estados</label>
                            <div class="col-auto">
                                <select class="form-control col-auto control-label" name="estados" id="estados"
                                    required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cidades" class="col-auto control-label font-weight-bold">Cidades</label>
                            <div class="col-auto">
                                <select class="form-control col-auto control-label" name="cidades" id="cidades"
                                    required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endereco" class="col-auto control-label font-weight-bold">Endereço</label>
                            <div class="col-auto">
                                <input value="<?php echo $endereco ?>" type="text" name="endereco" id="endereco"
                                    class="form-control" placeholder="Endereço" required>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Dados sobre sua saúde</legend>
                        <div class="form-group required">
                            <label for="tipo_sanguineo" class="col-auto control-label font-weight-bold">Tipo Sanguíneo</label>
                            <div class="col-auto">
                                <select class="form-control col-auto control-label" name="tipo_sanguineo"
                                    id="tipo_sanguineo" required>
                                    <option value="hint" selected>Selecione aqui</option>
                                    <option value="A+" <?php echo ($tiposanguineo == "A+") ? "selected" : null; ?>>A+
                                    </option>
                                    <option value="A-" <?php echo ($tiposanguineo == "A-") ? "selected" : null; ?>>A-
                                    </option>
                                    <option value="B+" <?php echo ($tiposanguineo == "B+") ? "selected" : null; ?>>B+
                                    </option>
                                    <option value="B-" <?php echo ($tiposanguineo == "B-") ? "selected" : null; ?>>B-
                                    </option>
                                    <option value="AB+" <?php echo ($tiposanguineo == "AB+") ? "selected" : null; ?>>AB+
                                    </option>
                                    <option value="AB-" <?php echo ($tiposanguineo == "AB-") ? "selected" : null; ?>>AB-
                                    </option>
                                    <option value="O+" <?php echo ($tiposanguineo == "O+") ? "selected" : null; ?>>O+
                                    </option>
                                    <option value="O-" <?php echo ($tiposanguineo == "O-") ? "selected" : null; ?>>O-
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-auto control-label font-weight-bold" for="alergias_doencas">Alergias ou Doenças</label>
                            <div class="col-auto">
                                <textarea class="form-control" name="alergias_doencas" id="alergias_doencas" cols="30"
                                    rows="10"><?php echo $alergiadoencas ?></textarea>
                            </div>
                            <label class="col-auto control-label text-muted" for="alergias_doencas">Opcional</label>
                        </div>
                        <div class="form-group">
                            <label class="col-auto control-label font-weight-bold" for="plano_de_saude">Plano de saúde</label>
                            <div class="col-auto">
                                <input value="<?php echo $planodesaude ?>" class="form-control" type="text"
                                    name="plano_de_saude" id="plano_de_saude">
                            </div>
                            <label class="col-auto control-label text-muted" for="plano_de_saude">Opcional</label>
                        </div>
                        <div class="form-group required">
                            <label class="col-auto control-label font-weight-bold" for="altura">Altura</label>
                            <div class="col-auto">
                                <input value="<?php echo $altura?>" class="form-control" type="text" name="altura"
                                    id="altura" data-mask="0.00" required>
                            </div>
                        </div>
                    </fieldset>
                    <div class="container form-group required">
                        <label class="col-auto control-label font-weight-bold" for="imagemUpload">Foto de Perfil</label>
                        <div class="col-auto custom-file">
                            <input class="form-control custom-file-input" type="file" name="imagemUpload"
                                value="Procurar..." accept="image/png ,image/jpeg">
                            <label class="custom-file-label" for="customFile">Escolha a foto, de preferência com seu
                                rosto</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-danger btn-block">Atualizar</button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script src="JS/Mascaras/js/jquery.mask.min.js"></script>
    <script src="JS/formulario.js"></script>
</body>

</html>