$(document).ready(function() {
    $('#pesquisa-paciente').keyup(function() {
        var pesquisa = $(this).val();

        if (pesquisa != '') {
            var dados = {
                palavra: pesquisa
            }
            $.post('../paciente/pesquisa-paciente.php', dados, function(retorno) {
                $('.paciente').html(retorno);
            });
        } else {
            $('.paciente').html("Nenhum paciente encontrado!");
        }
    });

    $(document).on('click', '.item-paciente', function() {
        var txt = $(this).text().trim().split(" - ");
        $('#paciente').val(txt[2]);
        $('#nomepaciente').val(txt[0] + ' - CPF: ' + txt[1]);
    });

});