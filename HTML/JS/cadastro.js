function confirmaSenha() {
    var senha = document.getElementById("senha").value;
    var confirmacao = document.getElementById("confirmacao").value;
    var erroSenha = document.getElementById("erroSenha");
    var erroText = "As senhas não se correspodem";

    if (senha != "" && confirmacao != "") {
        if (senha.length < 5) {
            erroSenha.innerHTML = "A senha deve ter no minimo 5 caracteres";
        }
        else if (senha != confirmacao) {
            alert(erroText);
            erroSenha.innerHTML = erroText;
            erroSenha.style.color = "red";
        }
        else {
            erroSenha.innerHTML = "";
            erroSenha.style.color = "black";
        }
    }
}

function confirmaEmail() {
    var email = document.getElementById("email");
    var erroEmail = document.getElementById("erroEmail");
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
            erroEmail.innerHTML = "";
            erroEmail.style.color = "black";
        }
        else {
            erroEmail.innerHTML = "Email inválido";
            erroEmail.style.color = "red";
            alert("E-mail invalido");
        }
    }
}

function confirmaTelefone(id) {
    var tel = document.getElementById(id).value;
    var erro = "";
    if (tel != "") {
        if ((tel.length == 14) &&
            (tel.indexOf("(") == 0) &&
            (tel.indexOf(")") == 3) &&
            (tel.indexOf("-") == 9)) {
            erro = "";
        }
        else {
            erro = "Utilize o exemplo ao lado da caixa de texto";
            alert(erro);
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
            }
        }
        else {
            alert("Utilize o exemplo ao lado da caixa de texto");
        }
    }
}

function validaFormulario() {
    var msg = "";
    var autorizacao = false;

    //Validação do campo nome
    var nome = document.getElementById("nome").value;
    if (nome == "") {
        msg += "\r\n- Preencha o campo nome";
    }

    //Validação do campo email
    var email = document.getElementById("email").value;
    var erroEmail = document.getElementById("erroEmail");
    if (email == "") {
        msg += "\r\n- Preencha o campo email";
    }
    else if (erroEmail.innerHTML == "Email inválido" || erroEmail.style.color == "red") {
        msg += "\r\n- Corrija o campo email";
    }

    //Validação dos campos senha e confirma senha 
    var senha = document.getElementById("senha").value;
    var confirmacao = document.getElementById("confirmacao").value;
    var erroSenha = document.getElementById("erroSenha");
    if (senha == "") {
        msg += "\r\n- Preencha o campo senha";
    }
    else if (confirmacao == "") {
        msg += "\r\n- Preencha o campo de confirmação";
    }
    else if (erroSenha.innerHTML == "As senhas não se correspodem" || erroSenha.style.color == "red") {
        msg += "\r\n- Corrija os campo senha e/ou de confirmação";
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
             (tel.indexOf("-") != 9)){
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
    if (sanguineo == "hint") {
        msg += "\r\n- Escolha uma opção no campo tipo sanguineo";
    }
    var estado = document.getElementById("estados").value;
    if (estado == "hint_estados") {
        msg += "\r\n- Escolha um estado";
    }
    var cidade = document.getElementById("cidades").value;
    if (cidade == "hint_cidades") {
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
    else if (cep.length != 9 || cep.indexOf("-") != 6) {
        msg += "\r\n- Siga o exemplo de cep no campo a frente";
    }

    //Validação do campo alergias ou doenças e do campo plano de saúde
    var alergias_doencas = document.getElementById("alergias_doencas").value;
    if (alergias_doencas == "") {
        msg += "\r\n- Preencha o campo alergias ou doenças";
    }
    var plano = document.getElementById("plano_de_saude").value;
    if (plano == "") {
        msg += "\r\n- Preencha o campo plano de saúde";
    }

    //Validação do campo peso e do campo data da pesagem
    var peso = document.getElementById("peso").value;
    if (peso == "") {
        msg += "\r\n- Preencha o campo peso";
    }
    /*
    var data_peso = document.getElementById("data_peso").value;
    if (data_peso == "") {
        msg += "\r\n- Preencha o campo data da pesagem";
    }
    */

    /*
    //Validação do campo pressão e do campo data da pressão
    var pressao = document.getElementById("pressao").value;
    if (pressao == "") {
        msg += "\r\n- Preencha o campo pressao";
    }
    var data_pressao = document.getElementById("data_pressao").value;
    if (data_pressao == "") {
        msg += "\r\n- Preencha o campo data da pressão";
    }
    */

    //Teste final para saber se vai validar o formulário
    if (msg == "") {
        autorizacao = true;
    }
    else {
        alert("Verifique os seguintes campos:" + msg);
    }
    return autorizacao;
}