const BS_STYLE = ["primary", "secondary", "success", "danger", "warning", "info", "light", "dark"];
const PRIMARY = 0;
const SECONDARY = 1;
const SUCCESS = 2;
const DANGER = 3;
const WARNING = 4;
const INFO = 5;
const LIGHT = 6;
const DARK = 7;

var close_alert_box = true;
$(document).ready(function (){
    $("#alert_box").click(function () {
        $(".alert").alert('close');
        $(".alert").on('closed.bs.alert', function () {
            if (close_alert_box) {
                $("#alert_box").css("visibility", "collapse");
            }
            close_alert_box = true;
        });
    });
    var mensaje="esto es una prueba:<br>Al contrario del pensamiento popular, el texto de Lorem Ipsum no es simplemente texto aleatorio. Tiene sus raices en una pieza cl´sica de la literatura del Latin, que data del año 45 antes de Cristo, haciendo que este adquiera mas de 2000 años de antiguedad. Richard McClintock, un profesor de Latin de la Universidad de Hampden-Sydney en Virginia, encontró una de las palabras más oscuras de la lengua del latín, 'consecteur', en un pasaje de Lorem Ipsum, y al seguir leyendo distintos textos del latín, descubrió la fuente indudable. Lorem Ipsum viene de las secciones 1.10.32 y 1.10.33 de 'de Finnibus Bonorum et Malorum' (Los Extremos del Bien y El Mal) por Cicero, escrito en el año 45 antes de Cristo. Este libro es un tratado de teoría de éticas, muy popular durante el Renacimiento. La primera linea del Lorem Ipsum, 'Lorem ipsum dolor sit amet..', viene de una linea en la sección 1.10.32";
    $("#alert_side").append(customAlert("estilo primario(no hay)<br>" + mensaje));
    $("#alert_side").append(customAlert("estilo secundario(no hay)<br>" + mensaje,SECONDARY));
    $("#alert_side").append(customAlert("estilo \"success\"<br>" + mensaje,SUCCESS));
    $("#alert_side").append(customAlert("estilo \"danger\"<br>" + mensaje,DANGER));
    $("#alert_side").append(customAlert("estilo \"warning\"<br>" + mensaje,WARNING));
    $("#alert_side").append(customAlert("estilo \"info\"<br>" + mensaje,INFO));
    $("#alert_side").append(customAlert("estilo \"light\"(no hay)<br>" + mensaje,LIGHT));
    $("#alert_side").append(customAlert("estilo \"dark\"(no hay)<br>" + mensaje,DARK));
});

function customAlert(mensaje, estyle = PRIMARY, dismiss = true, confirm = false, funcionOk = null, dataOk=null, funcionNo=null){
    if (dismiss) {
        dismisible = " alert-dismissible";
    }else{
        dismisible = "";
    }
    
    var alerta = $('<div/>',{
        class:"alert alert-"+BS_STYLE[estyle]+dismisible+" show fade in",
        role:"alert"
    }).append('<b>' + mensaje + '</b>');
    if (confirm) {
        $("<button/>",{
             type:"button",
             class:"cncl btn btn-danger btn-xs",
             'aria-label':"Close",
             'data-dismiss':"alert"
        }).appendTo(alerta).html("CANCELAR").click(funcionNo);
        alerta.append("&nbsp;&nbsp;");
        $("<button/>",{
             type:"button",
             class:"accpt btn btn-success btn-xs",
             'aria-label':"Close",
             'data-dismiss':"alert"
        }).appendTo(alerta).html("ACEPTAR").click(function(){funcionOk(dataOk);});
    }
    if(dismiss){
        $("<button/>",{
             type:"button",
             class:"close",
             'data-dismiss':"alert",
             'aria-label':"Close"
        }).append('<span aria-hidden="true">&times;</span>').appendTo(alerta);
    }
    return alerta;
}