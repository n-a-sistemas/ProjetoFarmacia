function confirmaSenha(){
    var senha = document.getElementById("senha").value;
    var confirmacao = document.getElementById("confirmacao").value;
    var erroSenha = document.getElementById("erroSenha");
    var erroText = "As senhas não se correspodem";

    if(senha != confirmacao){
        alert(erroText);
        erroSenha.innerHTML = erroText;
        erroSenha.style.color = "red";
    }
    else{
        erroSenha.innerHTML = "";
    }
}

function confirmaEmail(){
    var email = document.getElementById("email").value;
    var erroEmail = document.getElementById("erroEmail");
    var msg = "";
    if(email.length < 1){
        msg += "- Preencheu o campo email";
    }

    var a = email.search("@");
    if(a == -1){
        msg += ", - Incluiu '@' no campo de email";
    }
    if(msg != ""){
        erroEmail.innerHTML = "Verifique se você: " + msg;
        erroEmail.style.color = "red";
    }
}

function validaFormulario(){
    var msg = "";
    var autorizacao = false;

    //Validação do campo nome
    var nome = document.getElementById("nome").value;
    if(nome.length < 1){
        msg += "\r\n- Preencha o campo nome";
    }

    //Validação do campo email
    var email = document.getElementById("email").value;
    if(nome.length < 1){
        msg += "\r\n- Preencha o campo email";
    }

    var a = email.search("@");
    if(a == -1){
        msg += "Inclua '@' no campo de email";
    }

    //Teste final para saber se vai validar o formulário
    if(msg == ""){
        autorizacao = true;
    }
    else{
        alert("Verifique os seguintes campos:" + msg);
    }
    return autorizacao;
}