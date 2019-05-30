$(document).ready(function (){
    rellenar();
    
    $('#vacac').click(function (){
        siguiente("vacaciones/vacaciones.php", 0);
    });
    
    $('#in_va').click(function (){
        siguiente("vacaciones/vacaciones.php", 1);
    });
    
    $('#ge_va').click(function (){
        window.location.href = "vacaciones/vacaciones_gestion.php";
    });
    
    $('#al_us').click(function (){
        window.location.href = "gestion_usuarios/gestion_usuarios.php";
    });
    
    $('#ba_us').click(function (){
        window.location.href = "gestion_usuarios/baja_usuarios.php";
    });
});

function siguiente(url, tipo){
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        data:{
            tipo: tipo
        },
        success: function (data, textStatus, jqXHR) {
            window.location.href = url;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            
        }
    });
}

function rellenar(){
    var gris = "<div class='menu-elemento-general submenu-elemento gris'></div>";
    while ($(".submenu > div").length<16) {
        $(".submenu").append(gris);
    }
}