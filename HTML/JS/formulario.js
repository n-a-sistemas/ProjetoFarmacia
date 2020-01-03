$(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: 'http://localhost:8080/ProjetoFarmacia/PHP/estado.php',
        dataType: 'html',
        // Antes de carregar os registros, mostra para o usuário que está
        // sendo carregado.
        beforeSend: function (xhr) {
            $('#estados').attr('disabled', 'disabled');
            $('#estados').html('<option value="">Carregando...</option>');
        },
        // Após carregar, coloca a lista dentro do select de estados.
        success: function (data) {
            // Adiciona o retorno no campo, habilita e da foco
            $('#estados').html('<option value="hint_estados">Selecione um estado</option>');
            $('#estados').append(data);
            $('#estados').removeAttr('disabled').focus();
        }
    });
    $.ajax({
        type: 'POST',
        url: 'http://localhost:8080/ProjetoFarmacia/PHP/cidade.php',
        dataType: 'html',
        // Antes de carregar os registros, mostra para o usuário que está
        // sendo carregado.
        beforeSend: function (xhr) {
            $('#cidades').attr('disabled', 'disabled');
            $('#cidades').html('<option value="">Carregando...</option>');
        },
        // Após carregar, coloca a lista dentro do select de cidades.
        success: function (data) {
            // Adiciona o retorno no campo, habilita e da foco
            $('#cidades').html('<option value="hint_cidades">Selecione uma cidade</option>');
            $('#cidades').append(data);
            $('#cidades').removeAttr('disabled').focus();
        }
    });
    $('#estados').change(function () {
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8080/ProjetoFarmacia/PHP/cidade.php',
            dataType: 'html',
            data: { 'estado': $('#estados').val() },
            // Antes de carregar os registros, mostra para o usuário que está
            // sendo carregado.
            beforeSend: function (xhr) {
                $('#cidades').attr('disabled', 'disabled');
                $('#cidades').html('<option value="">Carregando...</option>');
            },
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
});