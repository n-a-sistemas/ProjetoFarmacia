$(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: 'http://localhost:8080/ProjetoFarmacia/HTML/parts/tabela_emails.php',
        dataType: 'html',
        data: { 'ativo': 1 },
        // Antes de carregar os registros, mostra para o usuário que está
        // sendo carregado.
        beforeSend: function (xhr) {
            $('#tbody').html('<tr><td colspan="5">Carregando...</td></tr>');
        },
        // Após carregar, coloca a lista dentro do select de cidades.
        success: function (data) {
            // Adiciona o retorno no campo, habilita e da foco
            $('#tbody').empty();;
            $('#tbody').append(data);
        }
    });
    $('#ativo').change(function () {
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8080/ProjetoFarmacia/HTML/parts/tabela_emails.php',
            dataType: 'html',
            data: { 'ativo': $('#ativo').val() },
            // Antes de carregar os registros, mostra para o usuário que está
            // sendo carregado.
            beforeSend: function (xhr) {
                $('#tbody').html('<tr><td colspan="5">Carregando...</td></tr>');
            },
            // Após carregar, coloca a lista dentro do select de cidades.
            success: function (data) {
                if ($('#ativo').val() != "") {
                    // Adiciona o retorno no campo, habilita e da foco
                    $('#tbody').empty();
                    $('#tbody').append(data);
                }
            }
        });
    });
});