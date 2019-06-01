$(document).ready(function (){
    $("#baja").click(baja_usuario);
    
    $('#usuarios').change(function(){
        $("#baja").attr("disabled", false);
    });
});

function baja_usuario(){
    var drwho = $('#usuarios').val();
    $.ajax({
        url: "ajax/AJAX_baja_usuario.php",
        type: 'POST',
        cache: false,
        data: {
            drwho: drwho
        },
        success: function (data, textStatus, jqXHR) {
            if (data === '1') {
                recargar_usuarios($('#usuarios'));
            }else{
                console.log(data);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}

function recargar_usuarios(selector) {
    $.ajax({
        url: "ajax/AJAX_consultar_usuarios.php",
        type: 'POST',
        cache: false,
        success: function (data, textStatus, jqXHR) {
            data = JSON.parse(data);
            $(selector).html(data).selectpicker("refresh");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}