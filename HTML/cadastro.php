<?php
    session_start();
    session_unset();
    session_destroy();
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

    <header>
        <h1>Formulário para cadastro</h1>
    </header>
    
    <?php include("./parts/navegacao.php"); ?>

    <main>
        <form action="../PHP/insert_formulario.php" method="POST" enctype="multipart/form-data" onsubmit="return validaFormulario();">
            <p>*Campos de preenchimento obrigatório.</p>
            <fieldset>
                <legend>Dados pessoais</legend>
                <div>
                    <label for="nome">Nome*: </label>
                    <input type="text" name="nome" id="nome" required>
                </div>
                <div>
                    <label for="email">Email*: </label>
                    <input type="email" name="email" id="email" onblur="confirmaEmail()" required>
                    <label for="email" id="errorEmail"></label>
                </div>
                <div>
                    <label for="senha">Senha*: </label>
                    <input type="password" name="senha" id="senha" minlength="5" required>
                </div>
                <div>
                    <label for="confirmacao">Digite novamente sua senha*: </label>
                    <input type="password" name="confirmacao" id="confirmacao" minlength="5" onblur="confirmaSenha()" required>
                    <label for="confirmacao" id="errorSenha"></label>
                </div>
                <fieldset>
                    <legend>Sexo*: </legend>
                    <input type="radio" name="sexo" id="Masculino" value="Masculino">
                    <label for="Masculino">Masculino</label>
                    <input type="radio" name="sexo" id="Feminino" value="Feminino">
                    <label for="Feminino">Feminino</label>
                    <input type="radio" name="sexo" id="Outros" value="Outros">
                    <label for="Outros">Outros</label>
                </fieldset>
                <div>
                    <label for="data_nascimento">Data de Nascimento*: </label>
                    <input type="date" name="data_nascimento" id="data_nascimento" required>
                </div>
                <div>
                    <label for="cpf">CPF*: </label>
                    <input type="text" name="cpf" id="cpf" minlength="14" maxlength="14" onblur="confirmaCPF()" required>
                    <label for="cpf">ex:111.222.333-44</label>
                </div>
                
                <div>
                    <label for="tel">Telefone*: </label>
                    <input type="tel" name="tel" id="tel" minlength="14" maxlength="14" onblur="confirmaTelefone('tel')" required>
                    <label for="tel">ex:(16)91111-4444</label>
                </div>
                <div>
                    <label for="contato_emergencia">Contato de Emergência*: </label>
                    <input type="tel" name="contato_emergencia" id="contato_emergencia" minlength="14" maxlength="14" onblur="confirmaTelefone('contato_emergencia')" required>
                    <label for="contato_emergencia">ex:(16)91111-4444</label>
                </div>
            </fieldset>
            <fieldset>
                <legend>Endereço</legend>
                <div>
                    <label for="cep">CEP*: </label>
                    <input type="text" name="cep" id="cep" minlength="9" maxlength="9" required>
                    <label for="cep">ex:91111-111</label>
                </div>
                <div>
                    <label for="estados">Estados*: </label>
                    <select name="estados" id="estados" required>
                    </select>
                </div>
                <div>
                    <label for="cidades">Cidades*: </label>
                    <select name="cidades" id="cidades" disabled required>
                        <option value="hint_cidades">Selecione uma cidade</option>
                    </select>
                </div>
                <div>
                    <label for="endereco">Endereço*: </label>
                    <input type="text" name="endereco" id="endereco" required>
                </div>
            </fieldset>
            <fieldset>
                <legend>Dados sobre sua saúde</legend>
                <div>
                    <label for="tipo_sanguineo">Tipo Sanguíneo*: </label>
                    <select name="tipo_sanguineo" id="tipo_sanguineo" required>
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
                    <textarea name="alergias_doencas" id="alergias_doencas" cols="30" rows="10"></textarea>
                    <label for="alergias_doencas">*Se não sabe pode deixar vazio</label>
                </div>
                <div>
                    <label for="plano_de_saude">Plano de saúde: </label>
                    <input type="text" name="plano_de_saude" id="plano_de_saude">
                    <label for="plano_de_saude">*Se não tiver pode deixar vazio</label>
                </div>
                <div>
                    <label for="altura">Altura*: </label>
                    <input type="number" name="altura" id="altura" min="0" max="3" step="any" required>
                </div>
                <div>
                    <label for="peso">Peso*: </label>
                    <input type="number" name="peso" id="peso" min="1" max="500" step="any" required>
                </div>
                <div>
                    <label for="data_peso">Data da Pesagem: </label>
                    <input type="date" name="data_peso" id="data_peso">
                    <label for="data_peso">*Se deixar vazio o campo, ele enviará a data de atual</label>
                </div>
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
            </fieldset>
            <div>
                <label for="imagemUpload">Foto de Perfil: </label>
                <input type="file" name="imagemUpload" value="Procurar..." accept="image/png ,image/jpeg">
            </div>
            <div>
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </main>
    <script src="JS/formulario.js"></script>
</body>
</html>