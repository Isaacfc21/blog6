$(document).ready(function() {
    $("#busca").keyup(function() {
        var busca = $(this).val();

        if (busca.length > 0) {
            $.ajax({
                url: $('form').attr('data-url-busca'),
                method: 'POST',
                data: { 'busca': busca },
                success: function(resultado) {
                    // Se a resposta contiver a classe de "nenhum resultado"
                    if (resultado.includes('nenhum-resultado')) {
                        $('#buscaResultado').html(
                            '<div class="alert alert-warning mb-0">Nenhum Resultado Encontrado</div>'
                        ).show();
                    } else {
                        $('#buscaResultado').html(
                            "<div class='card'><div class='card-body'><ul class='list-group list-group-flush'>" + resultado + "</ul></div></div>"
                        ).show();
                    }
                }
            });
        } else {
            $('#buscaResultado').hide();
        }
    });
});
