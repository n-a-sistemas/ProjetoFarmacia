<?php
    $json = file_get_contents("http://localhost:8080/ProjetoFarmacia/PHP/estado.php");
    $estados = json_decode($json);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
    <link rel="stylesheet" href="CSS/cadastro.css">
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/cadastro.js"></script>
</head>
<body>
    
    <form action="../PHP/insert_formulario.php" method="POST" enctype="multipart/form-data" onsubmit="return validaFormulario();">
        <div>
            <h2>Formulário para cadastro</h2>
        </div>
        <div>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" >
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" onblur="confirmaEmail()" >
            <label for="email" id="erroEmail"></label>
        </div>
        <div>
            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" minlength="5">
        </div>
        <div>
            <label for="confirmacao">Digite novamente sua senha: </label>
            <input type="password" name="confirmacao" id="confirmacao" minlength="5" onblur="confirmaSenha()" >
            <label for="confirmacao" id="erroSenha"></label>
        </div>
        <fieldset>
            <legend>Sexo: </legend>
            <input type="radio" name="sexo" id="Masculino">
            <label for="Masculino">Masculino</label>
            <input type="radio" name="sexo" id="Feminino" checked>
            <label for="Feminino">Feminino</label>
            <input type="radio" name="sexo" id="Outros">
            <label for="Outros">Outros</label>
        </fieldset>
        <div>
            <label for="data_nascimento">Data de Nascimento: </label>
            <input type="date" name="data_nascimento" id="data_nascimento" >
        </div>
        <div>
            <label for="cpf">CPF: </label>
            <input type="text" name="cpf" id="cpf" onblur="confirmaCPF()">
            <label for="cpf">ex:111.222.333-44</label>
        </div>
        <div>
            <label for="estados">Estados: </label>
            <select name="estados" id="estados">
                <option value="hint_estados">Selecione Aqui</option>
                <?php include('parts/criar_options_estados.php'); ?>
            </select>
        </div>
        <div>
            <label for="cidades">Cidades: </label>
            <select name="cidades" id="cidades" disabled>
                <option value="hint_cidades">Selecione Aqui</option>
            </select>
        </div>
        <div>
            <label for="endereco">Endereço: </label>
            <input type="text" name="endereco" id="endereco">
        </div>
        <div>
            <label for="cep">CEP: </label>
            <input type="text" name="cep" id="cep">
        </div>
        <div>
            <label for="tel">Telefone: </label>
            <input type="tel" name="tel" id="tel" maxlength="14" minlength="11" onblur="confirmaTelefone('tel')">
            <label for="tel">ex:(16)91111-4444</label>
        </div>
        <div>
            <label for="contato_emergencia">Contato de Emergência: </label>
            <input type="tel" name="contato_emergencia" id="contato_emergencia" maxlength="14" minlength="11" onblur="confirmaTelefone('contato_emergencia')">
            <label for="contato_emergencia">ex:(16)91111-4444</label>
        </div>
        <div>
            <label for="altura">Altura: </label>
            <input type="number" name="altura" id="altura" min="0" max="3" step="any" >
        </div>
        <div>
            <label for="tipo_sanguineo">Tipo Sanguineo: </label>
            <select name="tipo_sanguineo" id="tipo_sanguineo">
                <option value="hint" selected>Selecione aqui</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
        </div>
        <div>
            <label for="alergias_doencas">Alergias ou Doenças: </label>
            <textarea name="alergias_doencas" id="alergias_doencas" cols="30" rows="10" ></textarea>
        </div>
        <div>
            <label for="plano_de_saude">Plano de saúde: </label>
            <input type="text" name="plano_de_saude" id="plano_de_saude" >
        </div>
        <div>
            <label for="peso">Peso: </label>
            <input type="number" name="peso" id="peso" min="1" max="500" step="any" >
        </div>
        <div>
            <label for="pressao">Pressão: </label>
            <input type="text" name="pressao" id="pressao" >
        </div>
        <div>
            <label for="imagemUpload">Foto de Perfil: </label>
            <input type="file" name="imagemUpload" value="Procurar..." accept="image/png ,image/jpeg">
        </div>
        <div>
            <button type="submit">Cadastrar</button>
        </div>
    </form>
    <script src="JS/formulario.js"></script>
</body>
</html>