function impressao() {
    document.body.style.visibility = 'hidden';
    window.print();
    window.close();
    document.body.style.visibility = 'visible';
}
function dados(divID) {
    //pega o HTML de toda tag Body
    var oldPage = document.body.innerHTML;

    /*
    //pega o Html da DIV
    var divElements = document.getElementById(divID).innerHTML;

    //Alterna o body 
    document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body>";
    */
    
    var butoes = document.getElementsByTagName('button');
    for(var i = 0; i < butoes.length; i++){
        butoes[i].style.visibility = "hidden";
    }
    /*
    var qrcode = document.getElementsByClassName('printable');
    qrcode.style.visibility = "hidden";
    */
    //Imprime
    window.print();
    document.body.style.visibility = 'visible';
    //Retorna o conteudo original da página. 
    document.body.innerHTML = oldPage;
    
    for(var i = 0; i < butoes.length; i++){
        butoes[i].style.visibility = "visible";
    }
    //qrcode.style.visibility = "visible";
    window.close();
    
}