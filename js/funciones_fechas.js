/* global moment */

const FECHA_EXCEL = 'DD/MM/YYYY';
const FECHA_HORA_EXCEL = 'DD/MM/YYYY HH:mm:ss';
const FECHA_AGRUPACION = 'YYYYMMDDHHmmss';
const FECHA_SQL = 'YYYY-MM-DD';
const FECHA_HORA_SQL = 'YYYY-MM-DD HH:mm:ss';
const CURRENT_YEAR = moment().year();
const MESES = ["error", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];

//patron en mayúsculas: DD/MM/YYYY, YYYY-MM-DD
function comparar_fechas(fpeq, fgra, formato) {
    if (isEmpty(formato)) {
        formato = FECHA_SQL;
    }
    fpeq = moment(fpeq, formato);
    fgra = moment(fgra, formato);
    //en la resta el mas grande primero
    return parseInt(fgra.diff(fpeq, 'days'));
}
//origen/destino en mayúsculas: DD/MM/YYYY, YYYY-MM-DD
function formatear_fecha(fecha, destino, origen) {
    if (isEmpty(origen)) {
        origen = FECHA_SQL;
    }
    if (isEmpty(destino)) {
        destino = FECHA_EXCEL;
    }
    return moment(fecha, origen).format(destino);
}

function obtener_year(fecha, formato) {
    if (isEmpty(formato)) {
        formato = FECHA_SQL;
    }
    return moment(fecha, formato).format('YYYY');
}

function sumar_dias(fecha, dias, formato) {
    if (isEmpty(formato)) {
        formato = FECHA_SQL;
    }
    return moment(fecha, formato).add(dias, 'days').format(formato);
}