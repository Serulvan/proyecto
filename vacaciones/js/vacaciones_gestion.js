/* global FECHA_HORA_EXCEL, FECHA_HORA_SQL */

$(document).ready(function(){
    $("#buscar").data("drwho",$("#usuario").html()).click(buscar);
});

function buscar(){
    var login = $("#usuarios").val();
    var departamento = $("#departamento").val();
    var turno = $("#turno").val();
    var gestion = $("#gestion").val();
    var tipo = $("#tipo").val();
    var f_ini = $("#f_ini").val();
    var f_fin = $("#f_fin").val();
    var f_ini_s = $("#f_ini_s").val();
    var f_fin_s = $("#f_fin_s").val();
    var f_ini_g = $("#f_ini_g").val();
    var f_fin_g = $("#f_fin_g").val();
    $.ajax({
        url: "ajax/AJAX_vacaciones_consultar_gestionar.php",
        type: "POST",
        cache: false,
        data:{
            login: login,
            departamento: departamento,
            turno: turno,
            gestion: gestion,
            tipo: tipo,
            f_ini: f_ini,
            f_fin: f_fin,
            f_ini_s: f_ini_s,
            f_fin_s: f_fin_s,
            f_ini_g: f_ini_g,
            f_fin_g: f_fin_g
        },
        success: function (data, textStatus, jqXHR) {
            $(".tcuerpo").html("");
            data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                $(".tcuerpo").append(fila(data[i]));
                $("tr:last").data("data", data[i]);
            }
            activar_btn_gestion();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
            //error
        }
    });
}

function activar_btn_gestion(){
    $(".btn-gest").click(function(){
        gestionar($(this).closest('tr').data("data"), $(this).attr("class").indexOf("g-conf"));
    });
    $(".btn-desgest").click(function(){
        desgestionar($(this).closest('tr').data("data"));
    });
}

function fila(obj){
    var fg = "-";
    if (obj.fecha_gestion!=="-") {
        fg = formatear_fecha(obj.fecha_gestion,FECHA_HORA_EXCEL,FECHA_HORA_SQL);
    }
    var estado = "";
    var degest = "<button class='btn btn-light btn-xs btn-desgest btn-square-icon far fa-trash-alt'></button>";
    switch (obj.estado) {
        case "CONFIRMADO":
            estado = "<span class='badge CONFIRMADO'>CONFIRMADO</badge>";
            break;
        case "RECHAZADO":
            estado = "<span class='badge RECHAZADO'>RECHAZADO</badge>";
            break;
        case "PENDIENTE":
             estado = "<button class='btn btn-success btn-xs btn-gest btn-square-icon fas fa-check g-conf'></button>";
             estado += "<button class='btn btn-danger btn-xs btn-gest btn-square-icon fas fa-times g-rech'></button>";
             degest = '';
            break;
    }
    
    var $fila = $("<tr/>");
    $fila.append($("<td/>").addClass("cel col_login").html(obj.login));
    $fila.append($("<td/>").addClass("cel col_nombre").html(obj.nombre.toString().toLowerCase()));
    $fila.append($("<td/>").addClass("cel col_apellidos").html(obj.apellidos.toString().toLowerCase()));
    $fila.append($("<td/>").addClass("cel col_fecha_antiguedad").html(formatear_fecha(obj.fecha_antiguedad)));
    $fila.append($("<td/>").addClass("cel col_departamento").html(obj.departamento.toString().toLowerCase()));
    $fila.append($("<td/>").addClass("cel col_categoria").html(obj.categoria.toString().toLowerCase()));
    $fila.append($("<td/>").addClass("cel col_turno").html(obj.turno.toString().toLowerCase()));
    $fila.append($("<td/>").addClass("cel col_fecha_ini").html(formatear_fecha(obj.fecha_ini)));
    $fila.append($("<td/>").addClass("cel col_fecha_fin").html(formatear_fecha(obj.fecha_fin)));
    $fila.append($("<td/>").addClass("cel col_fecha_solicitud").html(formatear_fecha(obj.fecha_solicitud,FECHA_HORA_EXCEL,FECHA_HORA_SQL)));
    $fila.append($("<td/>").addClass("cel col_estado").html(estado));
    $fila.append($("<td/>").addClass("cel col_degest").html(degest));
    $fila.append($("<td/>").addClass("cel col_fecha_gestion").html(fg));
    $fila.append($("<td/>").addClass("cel col_usuario_gestiona").html(obj.usuario_gestiona));
    $fila.append($("<td/>").addClass("cel col_compensar"));
    return $fila;
}

function gestionar(obj, tipo){
    $.ajax({
        url: "ajax/AJAX_vacaciones_gestionar.php",
        type: 'POST',
        cache: false,
        data:{
            drwho: $("#buscar").data("drwho"),
            tipo: tipo,
            login: obj.login,
            fecha_solicitud: obj.fecha_solicitud,
            fecha_ini: obj.fecha_ini,
            fecha_fin: obj.fecha_fin
        },
        success: function (data, textStatus, jqXHR) {
            data = JSON.parse(data);
            if (data==='1') {
                buscar();
            }else{
                console.log(data);
                //error
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //error
        }
    });
}

function desgestionar(obj, tipo){
    $.ajax({
        url: "ajax/AJAX_vacaciones_desgestionar.php",
        type: 'POST',
        cache: false,
        data:{
            login: obj.login,
            fecha_solicitud: obj.fecha_solicitud,
            fecha_ini: obj.fecha_ini,
            fecha_fin: obj.fecha_fin
        },
        success: function (data, textStatus, jqXHR) {
            data = JSON.parse(data);
            if (data==='1') {
                buscar();
            }else{
                console.log(data);
                //error
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //error
        }
    });
}