/* global FECHA_HORA_EXCEL, FECHA_HORA_SQL, FECHA_SQL, FECHA_EXCEL */

var user;
$(document).ready(function () {
    gestionar_almacenar(false);
    if ($("#usuarios").length) {
        $("#usuarios").change(function () {
            semireset();
            $("#almacenar").data("usuario", $(this).val());
        });
    } else {
        $("#almacenar").data("usuario", $("#usuario").html());
    }
    $("#seleccion").change(calcular_fin);
    $("#f_ini").change(calcular_fin);
    $("#almacenar").click(almacenar);
    $("#buscar").click(consultar_vacaciones);
});

function borrar(){
    $(".borrar").click(function(){
        borrar_vacaciones($(this).data("data"));
    });
}

function calcular_fin() {
    var dias = parseInt($("#seleccion").val());
    if (dias === 1) {
        $(".solo_dia").addClass("oculto");
    } else {
        $(".solo_dia").removeClass("oculto");
    }
    var fini = $("#f_ini").val();
    if (isEmpty(fini)) {
        $("#f_fin").remove();
        $(".f_fin_contenedor").append("<input id='f_fin' class='form-control disabled-black' type='date' readonly=''/>");
        $("#f_ini").removeClass("outlinedred");
        $("#dias").val(0);
    } else {
        $("#dias").val(dias);
        $("#f_fin").val(sumar_dias(fini, dias - 1));
        comprobar_fecha($("#almacenar").data("usuario"), $("#f_ini").val(), $("#f_fin").val());
    }
}

function gestionar_almacenar(estado) {
    $("#almacenar").attr("disabled", !estado);
}

function semireset() {
    $("#seleccion").val(7).selectpicker("refresh");
    $("#f_ini").val("");
    calcular_fin();
}

function reset() {
    $("#usuarios").val("").selectpicker("refresh");
    semireset();
    gestionar_almacenar(false);
}

function almacenar() {
    var login = $(this).data("usuario");
    var f_ini = $("#f_ini").val();
    var f_fin = $("#f_fin").val();
    $.ajax({
        url: "ajax/AJAX_vacaciones_guardar.php",
        type: 'POST',
        cache: false,
        data: {
            login: login,
            f_ini: f_ini,
            f_fin: f_fin
        },
        success: function (data, textStatus, jqXHR) {
            data = JSON.parse(data);
            if (!isEmpty(data)) {
                console.log(data);
                //alert("error");
            } else {
                //alert("ok");
                reset();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}

function comprobar_fecha(login, f_ini, f_fin) {
    $.ajax({
        url: "ajax/AJAX_vacaciones_comprobar_fechas.php",
        type: 'POST',
        cache: false,
        data: {
            login: login,
            f_ini: f_ini,
            f_fin: f_fin
        },
        success: function (data, textStatus, jqXHR) {
            data = JSON.parse(data);
            console.log(data);
            if (!isEmpty(data)) {
                if (Array.isArray(data)) {
                    $("#f_ini").addClass("outlinedred");
                    $("#f_fin").addClass("outlinedred");
                    gestionar_almacenar(false);
                } else {
                    console.log(data);
                    //alerta
                }
            }else{
                $("#f_ini").removeClass("outlinedred");
                $("#f_fin").removeClass("outlinedred");
                gestionar_almacenar(true);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}

function consultar_vacaciones(){
    var login = $("#almacenar").data("usuario");
    console.log(login);
    var fecha = $("#year").val();
    var tipo = $("#tipo").val();
    $.ajax({
        url: "ajax/AJAX_vacaciones_consultar.php",
        type: 'POST',
        cache: false,
        data: {
            login: login,
            fecha: fecha,
            tipo: tipo
        },
        success: function (data, textStatus, jqXHR) {
            $(".tabla > tbody").html("");
            data = JSON.parse(data);
            if (!isEmpty(data)) {
                if (Array.isArray(data)) {
                    for (var i = 0; i < data.length; i++) {
                        $(".tabla .tcuerpo").append(consulta(data[i]));
                        $(".borrar:last").data("data",data[i]);
                    }
                    if (!isEmpty(login)) {
                        $(".col_login").css("display", "none");
                    }
                    borrar();
                    $(".consulta").show();
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}

function consulta(obj){
    var fila = $("<tr/>",{class:obj.estado});
    var fecha_g = '-';
    var butt = "";
    if (obj.fecha_gestion!=='-') {
        fecha_g = formatear_fecha(obj.fecha_gestion, FECHA_HORA_EXCEL, FECHA_HORA_SQL);
    }else{
        butt = "<button class='btn btn-danger btn-xs mybutt borrar'>Borrar</button>";
    }
    var fecha_f = '-';
    if (obj.fecha_fin !== obj.fecha_ini) {
        fecha_f = formatear_fecha(obj.fecha_fin, FECHA_EXCEL, FECHA_SQL);
    }
    fila.append("<td class='cel col_login'>"+obj.login+"</td>");
    fila.append("<td class='cel col_fecha_solicitud'>"+formatear_fecha(obj.fecha_solicitud, FECHA_HORA_EXCEL, FECHA_HORA_SQL)+"</td>");
    fila.append("<td class='cel col_fecha_ini'>"+formatear_fecha(obj.fecha_ini, FECHA_EXCEL, FECHA_SQL)+"</td>");
    fila.append("<td class='cel col_fecha_fin'>"+fecha_f+"</td>");
    fila.append("<td class='cel col_estado estado_"+obj.estado+"'><span class='badge'>"+obj.estado+"</span></td>");
    fila.append("<td class='cel col_fecha_gestion'>"+fecha_g+"</td>");
    fila.append("<td class='cel col_usuario_gestiona'>"+obj.usuario_gestiona+"</td>");
    fila.append("<td class='cel col_borrar'>"+butt+"</td>");
    fila.append("<td class='cel col_compensar'></td>");
    return fila;
}

function borrar_vacaciones(obj){
    $.ajax({
        url: "ajax/AJAX_vacaciones_borrar.php",
        type: 'POST',
        cache: false,
        data:{
            login: obj.login,
            fsol: obj.fecha_solicitud,
            fini: obj.fecha_ini,
            ffin: obj.fecha_fin
        },
        success: function (data, textStatus, jqXHR) {
            console.log(data);
            consultar_vacaciones();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            
        }
    });
}

