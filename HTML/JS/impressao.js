function impressao() {
    var conteudo = document.getElementById('barcode').innerHTML;
    var telaImpressao = window.open('');

    telaImpressao.document.write(conteudo);
    telaImpressao.window.print();

    telaImpressao.window.close();
}