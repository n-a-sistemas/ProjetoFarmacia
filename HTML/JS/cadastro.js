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

function validaFormulario(){
    var msg = "";
    var autorizacao = false;

    //Validação do campo nome
    var nome = document.getElementById("nome").value;
    if(nome.length < 1){
        msg += "\r\n- Preencha o campo nome";
    }

    if(msg == ""){
        autorizacao = true;
    }
    else{
        alert("Verifique os seguintes campos:" + msg);
    }
    return autorizacao;
}