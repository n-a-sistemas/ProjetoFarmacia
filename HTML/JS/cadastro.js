$(document).ready(function () {
    $("#mostra-pressao").click(function () {
        $("#label_pressao").toggle();
    });
    $("#mostra-peso").click(function () {
        $("#label_peso").toggle();
    });
});

function confirmaSenha() {
    var errorSenha = document.getElementById("errorSenha");
    var senha = document.getElementById("senha");
    var errorText = "As senhas não se correspodem";
    var error = validarSenha();

    if (error == "menor") {
        errorSenha.innerHTML = "A senha deve ter no minimo 5 caracteres";
    }
    else if (error == "diferente") {
        alert(errorText);
        errorSenha.innerHTML = errorText;
        errorSenha.style.color = "red";
        senha.focus();
    }
    else {
        errorSenha.innerHTML = "";
        errorSenha.style.color = "black";
    }
}

function validarEmail() {
    var email = document.getElementById("email");
    usuario = email.value.substring(0, email.value.indexOf("@"));
    dominio = email.value.substring(email.value.indexOf("@") + 1, email.value.length);
    if (email.value != "") {
        if ((usuario.length >= 1) &&
            (dominio.length >= 3) &&
            (usuario.search("@") == -1) &&
            (dominio.search("@") == -1) &&
            (usuario.search(" ") == -1) &&
            (dominio.search(" ") == -1) &&
            (dominio.search(".") != -1) &&
            (dominio.indexOf(".") >= 1) &&
            (dominio.lastIndexOf(".") < dominio.length - 1)) {
            return false;
        }
        else {
            return true;
        }
    }
}

function validarSenha() {
    var senha = document.getElementById("senha").value;
    var confirmacao = document.getElementById("confirmacao").value;
    if (senha != "" && confirmacao != "") {
        if (senha.length < 5) {
            return "menor";
        }
        else if (senha != confirmacao) {
            return "diferente";
        }
        else { return ""; }
    }
}

function confirmaEmail() {
    var errorEmail = document.getElementById("errorEmail");
    var email = document.getElementById("email");
    var error = validarEmail();
    if (error) {
        errorEmail.innerHTML = "Email inválido";
        errorEmail.style.color = "red";
        alert("E-mail invalido");
        email.focus();
    }
    else {
        errorEmail.innerHTML = "";
        errorEmail.style.color = "black";
    }
}

function confirmaTelefone(id) {
    var tel = document.getElementById(id).value;
    if (tel != "") {
        if ((tel.length != 14) ||
            (tel.indexOf("(") != 0) ||
            (tel.indexOf(")") != 3) ||
            (tel.indexOf("-") != 9)) {
            alert("Utilize o exemplo ao lado da caixa de texto");
            tel.focus();
        }
    }
}

function confirmaCPF() {
    var cpf = document.getElementById("cpf").value;
    if (cpf != "") {
        if (cpf.length == 14) {
            var Soma = 0;
            var Resto;
            var i = 0;
            var msg = "";
            cpf = cpf.replace(".", "");
            cpf = cpf.replace(".", "");
            cpf = cpf.replace("-", "");
            if (cpf == "00000000000" || cpf.length != 11) {
                msg = "CPF invalido";
            }
            else {
                for (i = 1; i <= 9; i++) {
                    Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
                }
                Resto = (Soma * 10) % 11;

                if ((Resto == 10) || (Resto == 11)) {
                    Resto = 0;
                }
                if (Resto != parseInt(cpf.substring(9, 10))) {
                    msg = "CPF invalido";
                }
                else {
                    Soma = 0;
                    for (i = 1; i <= 10; i++) {
                        Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
                    }
                    Resto = (Soma * 10) % 11;

                    if ((Resto == 10) || (Resto == 11)) {
                        Resto = 0;
                    }
                    if (Resto != parseInt(cpf.substring(10, 11))) {
                        msg = "CPF invalido";
                    }
                }
            }
            if (msg != "") {
                alert(msg);
                cpf.focus();
            }
        }
        else {
            alert("Utilize o exemplo ao lado da caixa de texto");
            cpf.focus();
        }
    }
}

function validaFormularioCompleto() {
    var msg = "";
    var autorizacao = false;

    //Validação do campo nome
    var nome = document.getElementById("nome").value;
    if (nome == "" || nome == null || nome.length < 3) {
        msg += "\r\n- Preencha o campo nome";
    }

    //Validação do campo email
    var email = document.getElementById("email").value;
    var error = validarEmail();
    if (email == "") {
        msg += "\r\n- Preencha o campo email";
    }
    else if (error) {
        msg += "\r\n- Corrija o campo email";
    }

    //Validação dos campos senha e confirma senha 
    var senha = document.getElementById("senha").value;
    var confirmacao = document.getElementById("confirmacao").value;
    var error = validarSenha();
    if (senha == "") {
        msg += "\r\n- Preencha o campo senha";
    }
    else if (confirmacao == "") {
        msg += "\r\n- Preencha o campo de confirmação";
    }
    else if (error == "diferente") {
        msg += "\r\n- Corrija os campo senha e/ou de confirmação";
    }

    //Validação do campo sexo
    var sexo = document.getElementsByName("sexo");
    var escolhaSexo = -1;
    for (var i = sexo.lenght - 1; i > -1; i--) {
        if (sexo[i].checked) {
            escolhaSexo = i;
        }
    }
    if (escolhaSexo == -1) {
        msg += "\r\n- Escolha o seu sexo";
        sexo[0].focus();
    }

    //Validação do campo de data de nascimento
    var data = document.getElementById("data_nascimento").value;
    if (data == "") {
        msg += "\r\n- Preencha o campo data de nascimento";
    }

    //Validação do campo telefone e campo contato
    var tel = document.getElementById("tel").value;
    if (tel == "") {
        msg += "\r\n- Preencha o campo telefone";
    }
    else if ((tel.length != 14) ||
        (tel.indexOf("(") != 0) ||
        (tel.indexOf(")") != 3) ||
        (tel.indexOf("-") != 9)) {
        msg += "\r\n- Siga o exemplo de telefone no campo a frente";
    }
    var contato = document.getElementById("contato_emergencia").value;
    if (contato == "") {
        msg += "\r\n- Preencha o campo contato de emergência";
    }
    else if ((contato.length != 14) ||
        (contato.indexOf("(") != 0) ||
        (contato.indexOf(")") != 3) ||
        (contato.indexOf("-") != 9)) {
        msg += "\r\n- Siga o exemplo de contato no campo a frente";
    }

    //Validação do campo endereço
    var endereco = document.getElementById("endereco").value;
    if (endereco == "") {
        msg += "\r\n- Preencha o campo endereço";
    }

    //Validação do campo altura
    var altura = document.getElementById("altura").value;
    if (altura == "") {
        msg += "\r\n- Preencha o campo altura";
    }
    else if (altura > 3) {
        msg += "\r\n- Preencha o campo altura com um valor abaixo de 3";
    }

    //Validação do campo tipo sanguineo, do campo estado e do campo cidade
    var sanguineo = document.getElementById("tipo_sanguineo").value;
    if (sanguineo == "hint" || sanguineo == "") {
        msg += "\r\n- Escolha uma opção no campo tipo sanguineo";
    }
    var estado = document.getElementById("estados").value;
    if (estado == "hint_estados" || estado == "") {
        msg += "\r\n- Escolha um estado";
    }
    var cidade = document.getElementById("cidades").value;
    if (cidade == "hint_cidades" || cidade == "") {
        msg += "\r\n- Escolha uma cidade";
    }

    //Validação do campo cpf e do campo cep
    var cpf = document.getElementById("cpf").value;
    if (cpf == "") {
        msg += "\r\n- Preencha o campo cpf";
    }
    else if (cpf.length != 14) {
        msg += "\r\n- Siga o exemplo de cpf no campo a frente";
    }
    var cep = document.getElementById("cep").value;
    if (cep == "") {
        msg += "\r\n- Preencha o campo cep";
    }
    else if ((cep.length != 9) || (cep.indexOf("-") != 5)) {
        msg += "\r\n- Siga o exemplo de cep no campo a frente";
    }

    //Validação do campo peso
    var peso = document.getElementById("peso").value;
    if (peso == "") {
        msg += "\r\n- Preencha o campo peso";
    }

    //Validação do campo pressão
    var pressao = document.getElementById("pressao").value;
    if (pressao == "") {
        if(pressao.indexOf("/") != -1){
            msg += "\r\n- Siga o exemplo de pressão no campo a frente";
        }
    }

    //Teste final para saber se vai validar o formulário
    if (msg == "") {
        autorizacao = true;
    }
    else {
        alert("Verifique os seguintes campos:" + msg);
    }
    return autorizacao;
}