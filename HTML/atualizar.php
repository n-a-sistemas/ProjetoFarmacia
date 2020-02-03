<?php
    session_start();
    include("../PHP/conn.php");
    $id = "";
    $foto_perfil = "";
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }
    if($id != ""){
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
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atualização de dados</title>
    <link rel="stylesheet" href="CSS/cadastro.css">
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/cadastro.js"></script>
</head>

<body>
    <?php include("./parts/navegacao.php"); ?>
    <?php include("./parts/header_login.php"); ?>

    <main>
        <form action="../PHP/update_formulario.php" method="POST" enctype="multipart/form-data"
            onsubmit="return validaFormulario();">
            <p>*Campos de preenchimento obrigatório.</p>
            <fieldset>
                <legend>Dados pessoais</legend>
                <div>
                    <label for="nome">Nome*: </label>
                    <input type="text" name="nome" id="nome" value="<?php echo $nome ?>" required>
                </div>
                <div>
                    <label for="email">Email*: </label>
                    <input type="email" name="email" id="email" onblur="confirmaEmail()" value="<?php echo $email ?>"
                        required>
                    <label for="email" id="errorEmail"></label>
                </div>
                <fieldset>
                    <legend>Sexo*: </legend>
                    <input type="radio" name="sexo" id="Masculino" value="Masculino"
                        <?php echo ($sexo == "Masculino") ? "checked" : null; ?>>
                    <label for="Masculino">Masculino</label>
                    <input type="radio" name="sexo" id="Feminino" value="Feminino"
                        <?php echo ($sexo == "Feminino") ? "checked" : null; ?>>
                    <label for="Feminino">Feminino</label>
                    <input type="radio" name="sexo" id="Outros" value="Outros"
                        <?php echo ($sexo == "Outros") ? "checked" : null; ?>>
                    <label for="Outros">Outros</label>
                </fieldset>
                <div>
                    <label for="data_nascimento">Data de Nascimento*: </label>
                    <input type="date" name="data_nascimento" id="data_nascimento"
                        value="<?php echo $data_nascimento ?>" required>
                </div>
                <div>
                    <label for="cpf">CPF*: </label>
                    <input type="text" name="cpf" id="cpf" minlength="14" maxlength="14" onblur="confirmaCPF()"
                        value="<?php echo $cpf ?>" required>
                    <label for="cpf">ex:111.222.333-44</label>
                    <label for="cpf" id="alerta_cpf">Ao editar esse campo é possivel que o QR Code precisa ser
                        trocado</label>
                </div>
                <div>
                    <label for="tel">Telefone*: </label>
                    <input type="tel" name="tel" id="tel" minlength="14" maxlength="14" onblur="confirmaTelefone('tel')"
                        value="<?php echo $telefone ?>" required>
                    <label for="tel">ex:(16)91111-4444</label>
                </div>
                <div>
                    <label for="contato_emergencia">Contato de Emergência*: </label>
                    <input type="tel" name="contato_emergencia" id="contato_emergencia" minlength="14" maxlength="14"
                        onblur="confirmaTelefone('contato_emergencia')" value="<?php echo $contatoemergencia ?>"
                        required>
                    <label for="contato_emergencia">ex:(16)91111-4444</label>
                </div>
            </fieldset>
            <fieldset>
                <legend>Endereço</legend>
                <div>
                    <label for="cep">CEP*: </label>
                    <input type="text" name="cep" id="cep" minlength="9" maxlength="9" value="<?php echo $cep ?>"
                        required>
                    <label for="cep">ex:91111-111</label>
                </div>
                <div>
                    <label for="estados">Estados*: </label>
                    <select name="estados" id="estados" required>
                    </select>
                </div>
                <div>
                    <label for="cidades">Cidades*: </label>
                    <select name="cidades" id="cidades" required>
                    </select>
                </div>
                <div>
                    <label for="endereco">Endereço*: </label>
                    <input type="text" name="endereco" id="endereco" value="<?php echo $endereco ?>" required>
                </div>
            </fieldset>
            <fieldset>
                <legend>Dados sobre sua saúde</legend>
                <div>
                    <label for="tipo_sanguineo">*Tipo Sanguíneo*: </label>
                    <select name="tipo_sanguineo" id="tipo_sanguineo" required>
                        <option value="hint" selected>Selecione aqui</option>
                        <option value="A+" <?php echo ($tiposanguineo == "A+") ? "selected" : null; ?>>A+</option>
                        <option value="A-" <?php echo ($tiposanguineo == "A-") ? "selected" : null; ?>>A-</option>
                        <option value="B+" <?php echo ($tiposanguineo == "B+") ? "selected" : null; ?>>B+</option>
                        <option value="B-" <?php echo ($tiposanguineo == "B-") ? "selected" : null; ?>>B-</option>
                        <option value="AB+" <?php echo ($tiposanguineo == "AB+") ? "selected" : null; ?>>AB+</option>
                        <option value="AB-" <?php echo ($tiposanguineo == "AB-") ? "selected" : null; ?>>AB-</option>
                        <option value="O+" <?php echo ($tiposanguineo == "O+") ? "selected" : null; ?>>O+</option>
                        <option value="O-" <?php echo ($tiposanguineo == "O-") ? "selected" : null; ?>>O-</option>
                    </select>
                </div>
                <div>
                    <label for="alergias_doencas">Alergias ou Doenças: </label>
                    <textarea name="alergias_doencas" id="alergias_doencas" cols="30"
                        rows="10"><?php echo $alergiadoencas ?></textarea>
                    <label for="alergias_doencas">*Se não sabe pode deixar vazio</label>
                </div>
                <div>
                    <label for="plano_de_saude">Plano de saúde: </label>
                    <input type="text" name="plano_de_saude" id="plano_de_saude" value="<?php echo $planodesaude ?>">
                    <label for="plano_de_saude">*Se não tiver pode deixar vazio</label>
                </div>
                <div>
                    <label for="altura">Altura*: </label>
                    <input type="number" name="altura" id="altura" min="0" max="3" step="any"
                        value="<?php echo $altura?>" required>
                </div>
                <div><button id='mostra-peso' type="button">Atualizar peso</button></div>
                <div id='label_peso'>
                    <div>
                        <label for="peso">Peso*: </label>
                        <input type="number" name="peso" id="peso" min="1" max="500" step="any">
                    </div>
                    <div>
                        <label for="data_peso">Data da Pesagem: </label>
                        <input type="date" name="data_peso" id="data_peso">
                        <label for="data_peso">*Se deixar vazio o campo, ele enviará a data de atual</label>
                    </div>
                </div>
                <div><button id='mostra-pressao' type="button">Atualizar pressão</button></div>
                <div id='label_pressao'>
                    <div>
                        <label for="pressao">Pressão: </label>
                        <input type="text" name="pressao" id="pressao">
                        <label for="pressao">ex:120/60</label>
                    </div>
                    <div>
                        <label for="data_pressao">Data da Pressão: </label>
                        <input type="date" name="data_pressao" id="data_pressao">
                        <label for="data_peso">*Se deixar vazio o campo, ele enviará a data de atual</label>
                    </div>
                </div>
            </fieldset>
            <div>
                <label for="imagemUpload">Foto de Perfil: </label>
                <input type="file" name="imagemUpload" value="" accept="image/png ,image/jpeg">
            </div>
            <div>
                <button type="submit">Atualizar</button>
            </div>
        </form>
    </main>
    <script src="JS/formulario.js"></script>
</body>

</html>