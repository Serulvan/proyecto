/* global FECHA_SQL, FECHA_EXCEL */
const REGEX_TEXTO = /((([0-9A-Za-zÀ-ÖÙ-öù-ÿ\s\-]+)[\t]){5}([0-9]{1,2}\/){2}[0-9]{4}\t[0-9A-Za-zÀ-ÖÙ-öù-ÿ\s\-]+(\t[0,1]){4}\n)+/g;
const REGEX_INPUT_TEXT = /[0-9A-Za-zÀ-ÖÙ-öù-ÿ\s\-]+/g;

$(document).ready(function(){
    activar_nueva_fila_text();
    $("#pegado_especial").bind("input", entrada_texto);
    $(".almacenar").click(leer_datos);
    //$(".almacenar").click(clear);
});

function entrada_texto(){
    var selector = $(this);
    var texto = $(this).val();
    if (check_input_text(selector, REGEX_TEXTO)) {
        $(this).removeClass("outlinedred");
        arr=texto.trim().split(/\n/g);
        for (var i = 0; i < arr.length; i++) {
            arr[i]= arr[i].split(/\t/g);
        }
        for (var i = 0; i < arr.length; i++) {
            rellenar(arr[i]);
            $("#form_gest_usu").append(nueva_fila());
        }
        if (parseInt($("#form_gest_usu > .controles").length)>5) {
            $("#insercion_pie").show();
        }
        activar_nueva_fila_text();
    }else{
        $(this).addClass("outlinedred");
    }
    $(this).val("");
}

function activar_nueva_fila_text(){
    $("#form_gest_usu > .controles:last .texto").on("input", check_fila_ultima);
}

function rellenar(arr){
    $(".login:last").val(arr[0]);
    $(".nombre:last").val(arr[1]);
    $(".apellidos:last").val(arr[2]);
    $(".categoria:last").val(arr[3]);
    $(".departamento:last").val(arr[4]);
    $(".fecha_ant:last").val(formatear_fecha(arr[5], FECHA_SQL, FECHA_EXCEL));
    $(".turno:last").val(arr[6]);
    if (arr[7] === '1') {
        $(".ins_vac:last").attr('checked', true);
    }
    
    if (arr[8] === '1') {
        $(".ges_vac:last").attr('checked', true);
    }
    
    if (arr[9] === '1') {
        $(".anu_vac:last").attr('checked', true);
    }
    
    if (arr[10] === '1') {
        $(".reportes:last").attr('checked', true);
    }
}

function nueva_fila(){
    var id = parseInt($("#form_gest_usu > .controles").length) + 1;
    var $fila = $("<div/>").addClass("controles");
    var $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='login"+id+"'>Login.</label>"));
    $elemento.append($("<input type='text' id='login"+id+"' class='form-control login texto'/>"));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='nombre"+id+"'>Nombre.</label>"));
    $elemento.append($("<input type='text' id='nombre"+id+"' class='form-control nombre texto'/>"));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='apellidos"+id+"'>Apellidos.</label>"));
    $elemento.append($("<input type='text' id='apellidos"+id+"' class='form-control apellidos texto'/>"));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='categoria"+id+"'>Categoría.</label>"));
    $elemento.append($("<input type='text' id='categoria"+id+"' class='form-control categoria texto'/>"));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='departamento"+id+"'>Departamento.</label>"));
    $elemento.append($("<input type='text' id='departamento"+id+"' class='form-control departamento texto'/>"));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='fecha_ant"+id+"'>Fecha de Antigüedad.</label>"));
    $elemento.append($("<input type='date' id='fecha_ant"+id+"' class='form-control fecha_ant texto'/>"));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='turno"+id+"'>Turno.</label>"));
    $elemento.append($("<input type='text' id='turno"+id+"' class='form-control turno texto'/>"));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    var $bchbox = $("<div/>").addClass("custom-checkbox custom-control");
    $bchbox.append($("<input type='checkbox' id='ins_vac"+id+"' class='custom-control-input ins_vac'/>"));
    $bchbox.append($("<label for='ins_vac"+id+"' class='custom-control-label'>Insertar Vacaciones.</label>"));
    $elemento.append($bchbox);
    
    $bchbox = $("<div/>").addClass("custom-checkbox custom-control");
    $bchbox.append($("<input type='checkbox' id='ges_vac"+id+"' class='custom-control-input ges_vac'/>"));
    $bchbox.append($("<label for='ges_vac"+id+"' class='custom-control-label'>Gestionar Vacaciones.</label>"));
    $elemento.append($bchbox);
    
    $bchbox = $("<div/>").addClass("custom-checkbox custom-control");
    $bchbox.append($("<input type='checkbox' id='anu_vac"+id+"' class='custom-control-input anu_vac'/>"));
    $bchbox.append($("<label for='anu_vac"+id+"' class='custom-control-label'>Anular Vacaciones.</label>"));
    $elemento.append($bchbox);
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $bchbox = $("<div/>").addClass("custom-checkbox custom-control");
    $bchbox.append($("<input type='checkbox' id='reportes"+id+"' class='custom-control-input reportes'/>"));
    $bchbox.append($("<label for='reportes"+id+"' class='custom-control-label'>Reportes.</label>"));
    $elemento.append($bchbox);
    $fila.append($elemento);
    
    return $fila;
}

function check_fila_ultima(){
    if (!check_input_text($(this), REGEX_INPUT_TEXT)) {
        $(this).addClass("outlinedred");
    }else{
        $(this).removeClass("outlinedred");
    }
    var max = $("#form_gest_usu > .controles:last .texto").length;
    for (var i = 0; i < max; i++) {
        if (isEmpty($($("#form_gest_usu > .controles:last .texto")[i]).val()) || !check_input_text($("#form_gest_usu > .controles:last .texto")[i], REGEX_INPUT_TEXT)) {
            return;
        }
    }
    $("#form_gest_usu").append(nueva_fila());
    activar_nueva_fila_text();
    if (parseInt($("#form_gest_usu > .controles").length)>5) {
        $("#insercion_pie").show();
    }
}

function leer_fila($fila){
    var arrfila = new Array();
    arrfila[0] = $fila.find(".login").val();
    arrfila[1] = $fila.find(".nombre").val();
    arrfila[2] = $fila.find(".apellidos").val();
    arrfila[3] = $fila.find(".categoria").val();
    arrfila[4] = $fila.find(".departamento").val();
    arrfila[5] = $fila.find(".fecha_ant").val();
    arrfila[6] = $fila.find(".turno").val();
    arrfila[7] = recojer_chbox($fila.find(".ins_vac"));
    arrfila[8] = recojer_chbox($fila.find(".ges_vac"));
    arrfila[9] = recojer_chbox($fila.find(".anu_vac"));
    arrfila[10] = recojer_chbox($fila.find(".reportes"));
    return arrfila;
}

function leer_datos(){
    var max = $("#form_gest_usu > .controles:not(:last) input[type=text]").length;
    var arr = $("#form_gest_usu > .controles:not(:last) input[type=text]");
    if (max===0) {
        return;
    }
    var texto, textarr;
    var salir = false;
    
    for (var i = 0; i < max; i++) {
        selector = arr[i];
        if (!check_input_text(selector,REGEX_INPUT_TEXT)) {
            $(selector).addClass("outlinedred");
            salir = true;
        }
    }
    
    if (salir) {
        return;
    }
    var data = new Array();
    max = $("#form_gest_usu > .controles").length-1;
    for (var i = 0; i < max; i++) {
        data[i] = leer_fila($($("#form_gest_usu > .controles")[i]));
    }
    almacenar_datos(data);
}

function recojer_chbox(selector){
    if (selector.is(":checked")) {
        return 1;
    }else{
        return 0;
    }
}

function almacenar_datos(arr){
    $.ajax({
        url: "ajax/AJAX_insertar_usuarios.php",
        type: 'POST',
        cache: false,
        data: {
            arr: arr
        },
        success: function (data, textStatus, jqXHR) {
            if (data!=='1') {
                console.log(data);
                //error
            }else{
                clear();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}

function check_input_text(selector, regexpr){
    var texto = $(selector).val();
    var textarr = texto.match(regexpr);
    return texto.search(regexpr) === 0 && textarr.length===1 && textarr[0] === texto;
}

function clear() {
    $("#form_gest_usu").html("");
    $("#form_gest_usu").append(nueva_fila());
    activar_nueva_fila_text();
    $("#insercion_pie").hide();
}