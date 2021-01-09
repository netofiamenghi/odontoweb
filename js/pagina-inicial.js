document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridDay,timeGridWeek,dayGridMonth,listMonth'
        },
        businessHours: {
            // days of week. an array of zero-based day of week integers (0=Sunday)
            daysOfWeek: [1, 2, 3, 4, 5], // Segunda - Sexta
            startTime: '08:00',
            endTime: '20:00',
        },
        businessHours: {
            // days of week. an array of zero-based day of week integers (0=Sunday)
            daysOfWeek: [6], // Segunda - Sexta
            startTime: '08:00',
            endTime: '12:00',
        },
        hiddenDays: [0],
        minTime: '08:00:00',
        maxTime: '20:00:00',
        slotDuration: '01:00:00',
        slotEventOverlap: false,
        defaultView: 'timeGridDay',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        events: '../agendamento/listar-agendamento.php',
        extraParams: function() {
            return {
                cachebuster: new Date().valueOf()
            };
        },
        eventClick: function(info) {
            $('#btnapagar').attr("href", "../agendamento/apagar-agendamento.php?id=" + info.event.id);
            info.jsEvent.preventDefault();
            $('#visualizar #id').text(info.event.id);
            $('#visualizar #id').val(info.event.id);
            $('#visualizar #title').text(info.event.title);
            $('#visualizar #start').text(info.event.start.toLocaleString());
            $('#visualizar #inicio').val(info.event.start.toLocaleString());
            $('#visualizar #end').text(info.event.end.toLocaleString());
            $('#visualizar #termino').val(info.event.end.toLocaleString());
            $('#visualizar').modal('show');
        },
        selectable: true,
        select: function(info) {
            $('#cadastrar #inicio').val(info.start.toLocaleString());
            $('#cadastrar #termino').val(info.end.toLocaleString());
            $('#cadastrar').modal('show');
        }
    });
    calendar.render();
});

//Mascara para o campo data e hora
function DataHora(evento, objeto) {
    var keypress = (window.event) ? event.keyCode : evento.which;
    campo = eval(objeto);
    if (campo.value == '00/00/0000 00:00:00') {
        campo.value = "";
    }

    caracteres = '0123456789';
    separacao1 = '/';
    separacao2 = ' ';
    separacao3 = ':';
    conjunto1 = 2;
    conjunto2 = 5;
    conjunto3 = 10;
    conjunto4 = 13;
    conjunto5 = 16;
    if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
        if (campo.value.length == conjunto1)
            campo.value = campo.value + separacao1;
        else if (campo.value.length == conjunto2)
            campo.value = campo.value + separacao1;
        else if (campo.value.length == conjunto3)
            campo.value = campo.value + separacao2;
        else if (campo.value.length == conjunto4)
            campo.value = campo.value + separacao3;
        else if (campo.value.length == conjunto5)
            campo.value = campo.value + separacao3;
    } else {
        event.returnValue = false;
    }
}

$(document).ready(function() {
    $("#addAgendamento").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "../agendamento/cadastrar-agendamento.php",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(retorna) {
                if (retorna['sit']) {
                    // $("#msg-cad").html(retorna['msg']);
                    location.reload();
                } else {
                    $("#msg-cad").html(retorna['msg']);
                }
            }
        })
    });

    $("#editAgendamento").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "../agendamento/alterar-agendamento.php",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(retorna) {
                if (retorna['sit']) {
                    // $("#msg-cad").html(retorna['msg']);
                    location.reload();
                } else {
                    $("#msg-cad").html(retorna['msg']);
                }
            }
        })
    });

    $("#addPaciente").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "../paciente/inserir-paciente.php",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(retorna) {
                $("#msg-cad").html(retorna['msg']);
            }
        })
    });

    $('.btn-editar').on("click", function() {
        $('.visagendamento').slideToggle();
        $('.formedit').slideToggle();
    });

    $('.btn-cancelar').on("click", function() {
        $('.visagendamento').slideToggle();
        $('.formedit').slideToggle();
    });

    $('.btn-form-inserir').on("click", function() {
        $('#cad-agendamento').slideToggle();
        $('#cad-paciente').slideToggle();
    });

    $('.btn-form-voltar').on("click", function() {
        $('#cad-agendamento').slideToggle();
        $('#cad-paciente').slideToggle();
        $("#addPaciente").get(0).reset();
        $("#msg-cad").html("");
    });


});