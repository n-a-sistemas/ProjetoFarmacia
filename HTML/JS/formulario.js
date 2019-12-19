$(document).ready(function() {
    $('#estados').change(function() {
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8080/ProjetoFarmacia/PHP/cidade.php',
            dataType: 'html',
            data: {'estado': $('#estados').val()},
            // Antes de carregar os registros, mostra para o usuário que está
            // sendo carregado.
            beforeSend: function(xhr) {
                $('#cidades').attr('disabled', 'disabled');
                $('#cidades').html('<option value="">Carregando...</option>');
            },
            // Após carregar, coloca a lista dentro do select de cidades.
            success: function(data) {
                if ($('#estados').val() != "") {
                    // Adiciona o retorno no campo, habilita e da foco
                    $('#cidades').html('<option value="">Selecione</option>');
                    $('#cidades').append(data);
                    $('#cidades').removeAttr('disabled').focus();
                } else {
                    $('#cidades').html('<option value="">Selecione um estado</option>');
                    $('#cidades').attr('disabled', 'disabled');
                }
            }
        });
    });
});