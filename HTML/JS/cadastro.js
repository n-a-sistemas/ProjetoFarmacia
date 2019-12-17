function confirmaSenha() {
    var senha = document.getElementById("senha").value;
    var confirmacao = document.getElementById("confirmacao").value;
    var erroSenha = document.getElementById("erroSenha");
    var erroText = "As senhas não se correspodem";
    erroSenha.style.color = "red";

    if (senha.length < 5) {
        erroSenha.innerHTML = "A senha deve ter no minimo 5 caracteres";
    }
    else if (senha != confirmacao) {
        alert(erroText);
        erroSenha.innerHTML = erroText;
    }
    else {
        erroSenha.innerHTML = "";
    }
}

function confirmaEmail() {
    var email = document.getElementById("email");
    var erroEmail = document.getElementById("erroEmail");
    usuario = email.value.substring(0, email.value.indexOf("@"));
    dominio = email.value.substring(email.value.indexOf("@") + 1, email.value.length);
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
    }
    else {
        erroEmail.innerHTML = "Email inválido";
        erroEmail.style.color = "red";
        alert("E-mail invalido");
    }
}

function confirmaTelefone() {
    var tel = document.getElementById("tel").value;
    if (tel.length < 1 && tel.length > 14) {

    }
}

function validaFormulario() {
    var msg = "";
    var autorizacao = false;

    //Validação do campo nome
    var nome = document.getElementById("nome").value;
    if (nome.length < 1) {
        msg += "\r\n- Preencha o campo nome";
    }

    //Validação do campo email
    var email = document.getElementById("email").value;
    var erroEmail = document.getElementById("erroEmail");
    if (email == "") {
        msg += "\r\n- Preencha o campo email";
    }
    else if (erroEmail.innerHTML != "") {
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
    else if (erroSenha.innerHTML != "") {
        msg += "\r\n- Corrija os campo senha e/ou de confirmação";
    }

    //Validação do campo de data de nascimento
    var data = document.getElementById("data_nascimento").value;
    if (data == "") {
        msg += "\r\n- Preencha o campo data de nascimento";
    }

    //Validação do campo telefone
    var tel = document.getElementById("tel").value;
    if (tel.length < 1) {
        msg += "\r\n- Preencha o campo telefone";
    }
    else if (tel.length < 14 || tel.length > 14) {
        msg += "\r\n- Siga o exemplo no campo a frente";
    }

    //Validação do campo altura
    var altura = document.getElementById("altura").value;
    if (altura < 1) {
        msg += "\r\n- Preencha o campo altura";
    }
    else if (altura > 3) {
        msg += "\r\n- Preencha o campo altura com um valor abaixo de 3";
    }

    //Validação do campo tipo sanguineo
    var sanguineo = document.getElementById("tipo_sanguineo").value;
    if (sanguineo == "hint") {
        msg += "\r\n- Escolha uma opção no campo tipo sanguineo";
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