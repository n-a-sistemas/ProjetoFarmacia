
    document.onload = function imageOption() {

    var conteudo = document.getElementById("impressao").src = "../PHP/<?php echo $img;?>";   
    var telaImpressao = window.open('about:blank');

    telaImpressao.document.write(conteudo);
    telaImpressao.window.print();
    telaImpressao.window.close();
    }

