<?php
    session_start();
    unset($_SESSION["id_qrcode"]);
    $erro = "";
    $alerta = "";
    if(isset($_SESSION['erro_cadastro'])){
        $erro = $_SESSION['erro_cadastro'];
    }
    if(isset($_SESSION['alert_imagem'])){
        $alerta = $_SESSION['alert_imagem'];
    }
    if($erro == "" && $alerta == ""){
        session_unset();
        session_destroy();
    }
    $session = "erro_cadastro";
    $session_alert = "alert_imagem";
    $page = 'cadastro.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Cadastro</title>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="JS/jquery-3.4.1.min.js"></script>
    <script src="JS/cadastro.js"></script>
    <script type="text/javascript" src="JS/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/estilos.css" />
    <link rel="stylesheet" href="CSS/cadastro.css" />
    <link rel="icon" href="PHP/uploads/logo.png" />
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
                <form class="form-horizontal" role="form" action="PHP/insert_formulario.php" method="POST"
                    enctype="multipart/form-data" onsubmit="return validaFormulario();">
                    <fieldset>
                        <label for="alerta">Campos marcados com <span class="ast font-weight-bold">*</span>
                            são obrigatórios.</label>

                        <legend>Dados pessoais</legend>

                        <div class="form-group required">
                            <label for="nome" class="col-auto control-label font-weight-bold">Nome Completo</label>

                            <div class="col-auto">
                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome"
                                    required>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label for="email" class="col-auto control-label font-weight-bold">Email</label>

                            <div class="col-auto">
                                <input type="email" name="email" id="email" onblur="confirmaEmail()"
                                    class="form-control" placeholder="Email" required>
                            </div>

                            <label for="email" id="errorEmail"></label>
                        </div>

                        <div class="form-group required">
                            <label for="senha" class="col-auto control-label font-weight-bold">Senha</label>

                            <div class="col-auto">
                                <input type="password" name="senha" id="senha" minlength="5" class="form-control"
                                    placeholder="Senha" required>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label for="confirmacao" class="col-auto control-label font-weight-bold">Confirmar
                                senha</label>

                            <div class="col-auto">
                                <input type="password" name="confirmacao" id="confirmacao" minlength="5"
                                    onblur="confirmaSenha()" class="form-control"
                                    placeholder="Digite novamente sua senha" required>
                            </div>

                            <label for="confirmacao" id="errorSenha"></label>
                        </div>

                        <fieldset class="form-group required mb-3">
                            <legend class="control-label font-weight-bold">Sexo</legend>

                            <div class="col-auto custom-control custom-radio">
                                <div class="col-auto">
                                    <input class="custom-control-input" type="radio" name="sexo" id="Masculino"
                                        value="Masculino">
                                    <label class="custom-control-label" for="Masculino">Masculino</label>
                                </div>

                                <div class="col-auto">
                                    <input class="custom-control-input" type="radio" name="sexo" id="Feminino"
                                        value="Feminino">
                                    <label class="custom-control-label" for="Feminino">Feminino</label>
                                </div>

                                <div class="col-auto">
                                    <input class="custom-control-input" type="radio" name="sexo" id="Outros"
                                        value="Outros">
                                    <label class="custom-control-label" for="Outros">Outros</label>
                                </div>
                            </div>
                        </fieldset>

                        <div class="form-group required">
                            <label for="data_nascimento" class="col-auto control-label font-weight-bold">Data de
                                Nascimento</label>

                            <div class="col-auto">
                                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label for="cpf" class="col-auto control-label font-weight-bold">CPF</label>

                            <div class="col-auto">
                                <input type="text" name="cpf" id="cpf" minlength="14" maxlength="14"
                                    onblur="confirmaCPF()" class="form-control" placeholder="CPF"
                                    data-mask="000.000.000-00" required>
                            </div>

                            <label for="cpf" class="col-auto text-muted">ex:111.222.333-44</label>
                        </div>

                        <div class="form-group required">
                            <label for="tel" class="col-auto control-label font-weight-bold">Telefone</label>

                            <div class="col-auto">
                                <input type="tel" name="tel" id="tel" minlength="14" maxlength="14"
                                    onblur="confirmaTelefone('tel')" class="form-control" placeholder="Telefone"
                                    data-mask="(00)00000-0000" required>
                            </div>

                            <label for="tel" class="col-auto text-muted">ex:(16)91111-4444</label>
                        </div>
                        <div class="form-group required">
                            <label for="contato_emergencia" class="col-auto control-label font-weight-bold">Contato de
                                Emergência</label>
                            <div class="col-auto">
                                <input type="tel" name="contato_emergencia" id="contato_emergencia" minlength="14"
                                    maxlength="14" onblur="confirmaTelefone('contato_emergencia')" class="form-control"
                                    data-mask="(00)00000-0000" placeholder="Contato de Emergência" required>
                            </div>
                            <label for="contato_emergencia" class="col-auto text-muted">ex:(16)91111-4444</label>
                        </div>
                    </fieldset>
                    <fieldset class="form-group required">
                        <legend>Endereço</legend>
                        <div class="form-group">
                            <label for="cep" class="col-auto control-label font-weight-bold">CEP</label>
                            <div class="col-auto">
                                <input type="text" name="cep" id="cep" minlength="9" maxlength="9" class="form-control"
                                    data-mask="00000-000" placeholder="CEP" required>
                            </div>
                            <label for="cep" class="col-auto text-muted">ex:91111-111</label>
                        </div>
                        <div class="form-group required">
                            <label for="estados" class="col-auto control-label font-weight-bold">Estados</label>
                            <div class="col-auto">
                                <select class="form-control col-auto control-label" name="estados" id="estados"
                                    required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="cidades" class="col-auto control-label font-weight-bold">Cidades</label>
                            <div class="col-auto">
                                <select class="form-control col-auto control-label" name="cidades" id="cidades" disabled
                                    required>
                                    <option value="hint_cidades">Selecione uma cidade</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="endereco" class="col-auto control-label font-weight-bold">Endereço</label>
                            <div class="col-auto">
                                <input type="text" name="endereco" id="endereco" class="form-control"
                                    placeholder="Endereço" required>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Dados sobre sua saúde</legend>
                        <div class="form-group required">
                            <label for="tipo_sanguineo" class="col-auto control-label font-weight-bold">Tipo
                                Sanguíneo</label>
                            <div class="col-auto">
                                <select class="form-control col-auto control-label" name="tipo_sanguineo"
                                    id="tipo_sanguineo" required>
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
                        </div>
                        <div class="form-group">
                            <label class="col-auto control-label font-weight-bold" for="alergias_doencas">Alergias ou
                                Doenças</label>
                            <div class="col-auto">
                                <textarea class="form-control" name="alergias_doencas" id="alergias_doencas" cols="30"
                                    rows="10"></textarea>
                            </div>
                            <label class="col-auto control-label text-muted" for="alergias_doencas">Opcional</label>
                        </div>
                        <div class="form-group">
                            <label class="col-auto control-label font-weight-bold" for="plano_de_saude">Plano de
                                saúde</label>
                            <div class="col-auto">
                                <input class="form-control" type="text" name="plano_de_saude" id="plano_de_saude">
                            </div>
                            <label class="col-auto control-label text-muted" for="plano_de_saude">Opcional</label>
                        </div>
                        <div class="form-group required">
                            <label class="col-auto control-label font-weight-bold" for="altura">Altura</label>
                            <div class="col-auto">
                                <input class="form-control" type="text" name="altura" id="altura" min="0" max="3"
                                    data-mask="0.00" step="any" required>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-auto control-label font-weight-bold" for="peso">Peso</label>
                            <div class="col-auto">
                                <input class="form-control" type="text" name="peso" id="peso" data-mask-reverse="true"
                                    data-mask="000.00" step="any" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-auto control-label font-weight-bold" for="data_peso">Data da
                                Pesagem</label>
                            <div class="col-auto">
                                <input class="form-control" type="date" name="data_peso" id="data_peso">
                            </div>
                            <label class="col-auto control-label text-muted" for="data_peso">Opcional</label>
                        </div>
                        <div class="form-group">
                            <label class="col-auto control-label font-weight-bold" for="pressao">Pressão</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="pressao" id="pressao" data-mask="000/000">
                            </div>
                            <label class="col-auto control-label text-muted" for="pressao">Opcional, ex:120/60</label>
                        </div>
                        <div class="form-group">
                            <label class="col-auto control-label font-weight-bold" for="data_pressao">Data da
                                Pressão</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="date" name="data_pressao" id="data_pressao">
                            </div>
                            <label class="col-auto control-label text-muted" for="data_peso">Opcional</label>
                        </div>
                        <div class="container form-group">
                            <label class="col-auto control-label font-weight-bold p-0" for="imagemUpload">Foto de
                                Perfil</label>
                            <div class="col-auto custom-file">
                                <input class="form-control custom-file-input" type="file" name="imagemUpload"
                                    value="Procurar..." accept="image/png ,image/jpeg">
                                <label class="custom-file-label" for="customFile">Envie uma imagem de perfil</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </main>
        </div>
    </div>
    <script src="JS/Mascaras/js/jquery.mask.min.js"></script>
    <script src="JS/formulario.js"></script>
</body>

</html>