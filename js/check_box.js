const REGEX_TEXTO = /((([0-z\s\-Á-ú]+)[\t]){5}([0-9]{1,2}\/){2}[0-9]{4}\t[0-zÁ-ú]+(\t[0,1]){4}\n)+/g;

$(document).ready(function(){
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
    }else{
        console.log("adios");
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