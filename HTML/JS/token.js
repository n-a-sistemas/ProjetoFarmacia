$(document).ready(function(){
    $("#btn-enviar-1").click(function(){
        $("#primeira-parte").hide();
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8080/ProjetoFarmacia/PHP/token.php',
            dataType: 'html',
            data: { 'email': $('#email').val() },
            // Após carregar, coloca a lista dentro do select de cidades.
            success: function (data) {
                if ($('#estados').val() != "") {
                    // Adiciona o retorno no campo, habilita e da foco
                    $('#cidades').html('<option value="hint_cidades">Selecione uma cidade</option>');
                    $('#cidades').append(data);
                    $('#cidades').removeAttr('disabled').focus();
                } else {
                    $('#cidades').html('<option value="">Selecione um estado</option>');
                    $('#cidades').attr('disabled', 'disabled');
                }
            }
        });
    });
})