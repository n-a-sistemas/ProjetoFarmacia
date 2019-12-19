function confirmaSenha() {
    var senha = document.getElementById("senha").value;
    var confirmacao = document.getElementById("confirmacao").value;
    var erroSenha = document.getElementById("erroSenha");
    var erroText = "As senhas não se correspodem";
    erroSenha.style.color = "red";

    if(senha != "" && confirmacao != ""){
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
}

function confirmaEmail() {
    var email = document.getElementById("email");
    var erroEmail = document.getElementById("erroEmail");
    usuario = email.value.substring(0, email.value.indexOf("@"));
    dominio = email.value.substring(email.value.indexOf("@") + 1, email.value.length);
    if(email.value != ""){
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
}

function confirmaTelefone(id) {
    var tel = document.getElementById(id).value;
    var erro = "";
    if(tel != ""){
        if ((tel.length == 14) &&
            (tel.search("(") == 0) &&
            (tel.search(")") == 3) &&
            (tel.search("-") == 9)){
            erro = "";
        }
        else{
            erro = "Utilize o exemplo ao lado da caixa de texto";
            alert(erro);
        }
    }
}

function confirmaCPF(){
    var cpf = document.getElementById("cpf").value;
    if(cpf != ""){
        var Soma = 0;
        var Resto;
        var i = 0;
        var msg = "";
        cpf = cpf.replace(".", "");
        cpf = cpf.replace(".", "");
        cpf = cpf.replace("-", "");
        alert(cpf);
        if (cpf == "00000000000"){
            msg = "CPF invalido";
        }
        else{
            for (i=1; i<=9; i++){
                Soma = Soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
            } 
            Resto = (Soma * 10) % 11;
            
            if ((Resto == 10) || (Resto == 11)){
                Resto = 0;
            }  
            if (Resto != parseInt(cpf.substring(9, 10)) ){
                msg = "CPF invalido";
            }
            else{
                Soma = 0;
                for (i = 1; i <= 10; i++){
                    Soma = Soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
                }
                Resto = (Soma * 10) % 11;
            
                if ((Resto == 10) || (Resto == 11)){
                    Resto = 0;
                }
                if (Resto != parseInt(cpf.substring(10, 11) ) ) {
                    msg = "CPF invalido";
                }
                msg = "";
            }
        }
        if(msg != ""){
            alert(msg);
        }        
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