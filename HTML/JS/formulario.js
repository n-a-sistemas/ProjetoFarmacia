$(document).ready(function(){
    $.getJSON('cidade.json', function (data) {
        $("#estados").change(function () {				
            var uf = $(this).attr("value");
            var cidades = data;
            var options_cidades = '';
            
            for(var i = 0; i < cidades.length; i++){
                if($cidade[i].uf == uf){
                    options_cidades += "<option value=" + $cidade[i].id + " class='cidade'>" + $cidade[i].nome + "</option>";
                }
            }
            $("#cidades").html(options_cidades);
        });
        /*
        var bands = data.bands;

        for (i = 0; i < bands.length; i++) {
            saida += '<div class="row">';
            saida += '<div class="col-lg-4 band-img">';
            saida += '<img src="' + bands[i].picture + '" alt="' + bands[i].name + '" title="' + bands[i].name + '">';
            saida += '</div>';
            saida += '</div>';
        }

        document.getElementById('tela').innerHTML = saida;		
        */
    });
})