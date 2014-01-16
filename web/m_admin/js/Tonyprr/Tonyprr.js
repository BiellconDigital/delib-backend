var Tonyprr = {
    version : "1.5.0",
    autor : "Antonio P. Ramos Rafael"
};
var timeSegSesion;

function iniTimeSession() {
    timeSegSesion = window.setTimeout(closeSessionInac,900000); // 5 segundos
}
function stopTimeSession() {
    window.clearTimeout(timeSegSesion);
    timeSegSesion = window.setTimeout(closeSessionInac,900000); // 15 minutos = 900000  20 min = 1200000
}


