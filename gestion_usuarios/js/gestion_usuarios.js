/* global FECHA_SQL, FECHA_EXCEL */

const REGEX_TEXTO = /((([0-z\s\-Á-ú]+)[\t]){5}([0-9]{1,2}\/){2}[0-9]{4}\t[0-zÁ-ú]+(\t[0,1]){4}\n)+/g;

$(document).ready(function(){
    for (var i = 0; i < 10; i++) {
        $("#form_gest_usu").append(nueva_fila());
    }
    
    $(".chbox").change(alternar_chbox);
    $("#pegado_especial").bind("input", entrada_texto);
});

function entrada_texto(){
    var texto = $(this).val();
    $(this).val("");
    var arr = texto.match(REGEX_TEXTO);
    if (texto.search(REGEX_TEXTO) === 0 && arr.length===1 && arr[0] === texto) {
        $(this).removeClass("outlinedred");
        arr=texto.trim().split(/\n/g);
        for (var i = 0; i < arr.length; i++) {
            arr[i]= arr[i].split(/\t/g);
        }
        for (var i = 0; i < arr.length; i++) {
            $("#form_gest_usu .controles:last");
        }
    }else{
        $(this).addClass("outlinedred");
    }
}

function alternar_chbox(){
    if($(this).is(":checked")){
        console.log(true);
    }else{
        console.log(false);
    }
}

function nueva_fila(arr){
    if (isEmpty(arr)) {
        arr = ["","","","","","","","","",""];
    }
    
    if (arr[5]!==""){
        arr[5] = formatear_fecha(arr[5], FECHA_SQL, FECHA_EXCEL);
    }
    
    var id = parseInt($("#form_gest_usu > .controles").length) + 1;
    var $fila = $("<div/>").addClass("controles");
    var $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='login"+id+"'>Login.</label>"));
    $elemento.append($("<input type='text' id='login"+id+"' class='form-control'/>").val(arr[0]));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='nombre"+id+"'>Nombre.</label>"));
    $elemento.append($("<input type='text' id='nombre"+id+"' class='form-control'/>").val(arr[1]));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='apellidos"+id+"'>Apellidos.</label>"));
    $elemento.append($("<input type='text' id='apellidos"+id+"' class='form-control'/>").val(arr[2]));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='categoria"+id+"'>Categoría.</label>"));
    $elemento.append($("<input type='text' id='categoria"+id+"' class='form-control'/>").val(arr[3]));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='departamento"+id+"'>Departamento.</label>"));
    $elemento.append($("<input type='text' id='departamento"+id+"' class='form-control'/>").val(arr[4]));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='fecha_ant"+id+"'>Fecha de Antigüedad.</label>"));
    $elemento.append($("<input type='date' id='fecha_ant"+id+"' class='form-control'/>").val(arr[5]));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $elemento.append($("<label for='turno"+id+"'>Turno.</label>"));
    $elemento.append($("<input type='text' id='turno"+id+"' class='form-control'/>").val(arr[6]));
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    var $bchbox = $("<div/>").addClass("custom-checkbox custom-control");
    $bchbox.append($("<input type='checkbox' id='ins_vac"+id+"' class='custom-control-input'/>"));
    $bchbox.append($("<label for='ins_vac"+id+"' class='custom-control-label'>Insertar Vacaciones.</label>"));
    $elemento.append($bchbox);
    
    $bchbox = $("<div/>").addClass("custom-checkbox custom-control");
    $bchbox.append($("<input type='checkbox' id='ges_vac"+id+"' class='custom-control-input'/>"));
    $bchbox.append($("<label for='ges_vac"+id+"' class='custom-control-label'>Gestionar Vacaciones.</label>"));
    $elemento.append($bchbox);
    
    $bchbox = $("<div/>").addClass("custom-checkbox custom-control");
    $bchbox.append($("<input type='checkbox' id='anu_vac"+id+"' class='custom-control-input'/>"));
    $bchbox.append($("<label for='anu_vac"+id+"' class='custom-control-label'>Anular Vacaciones.</label>"));
    $elemento.append($bchbox);
    $fila.append($elemento);
    
    $elemento = $("<div/>").addClass("c_elemento");
    $bchbox = $("<div/>").addClass("custom-checkbox custom-control");
    $bchbox.append($("<input type='checkbox' id='reportes"+id+"' class='custom-control-input'/>"));
    $bchbox.append($("<label for='reportes"+id+"' class='custom-control-label'>Reportes.</label>"));
    $elemento.append($bchbox);
    $fila.append($elemento);
    
    return $fila;
}