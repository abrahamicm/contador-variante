// Obtener elementos del DOM
const corefixContador = document.querySelector('.corefix-contador');

// Obtener los atributos del elemento
const startDate = corefixContador.getAttribute('data-startdate');
const endDate = corefixContador.getAttribute('data-enddate');
const startValue = Number(corefixContador.getAttribute('data-startvalue'));
const endValue = Number(corefixContador.getAttribute('data-endvalue'));
const periodDay = corefixContador.getAttribute('data-periodday');
const periodNight = corefixContador.getAttribute('data-periodnight');

// Calcular el valor inicial del contador
const interValue = endValue - startValue;
let currentValue = Math.floor(Number(startValue) + interValue * calcularProgreso(startDate, endDate));

// Función para mostrar el valor actual en el HTML
const mostrarHtml = function (value) {
    const elms = document.querySelectorAll('.corefix-contador-mostrar');
    elms.forEach((x) => (x.innerHTML = formatNumber(value)));
}
mostrarHtml(currentValue>0?currentValue:startValue);



// Función para determinar si es de día o de noche
const esDia = () => { return new Date().getHours() >= 6 && new Date().getHours() < 18; }

// Función para generar un número aleatorio entre 1 y 10
const generarNumeroAleatorio = () => Math.floor(Math.random() * 10) + 1;

// Función para obtener el periodo de actualización del contador
const getPeriod = function () {
    return esDia() ? periodDay * 1000 : periodNight * 1000;
};

// Función principal que actualiza el contador
let timeoutId;

function actualizarContador() {
    const fechaActual = new Date();
    if (fechaActual >= new Date(startDate) && fechaActual <= new Date(endDate)) {
        currentValue += generarNumeroAleatorio();
        mostrarHtml(currentValue);
        if (currentValue > endValue) {
            mostrarHtml(endValue);
            clearTimeout(timeoutId);
            timeoutId = null;
        } else {
            timeoutId = setTimeout(actualizarContador, getPeriod());
        }
    }
}
function formatNumber (num, separator=',')  {
    let numStr = num.toString();
    let groups = [];
    while (numStr.length > 0) {
      groups.unshift(numStr.slice(-3));
      numStr = numStr.slice(0, -3);
    }
    return groups.join(separator);
  };

// Función para calcular el progreso entre dos fechas
function calcularProgreso(fechaInicial, fechaFinal) {
    const fechaInicialObj = new Date(fechaInicial);
    const fechaFinalObj = new Date(fechaFinal);
    const milisegundosTotales = fechaFinalObj.getTime() - fechaInicialObj.getTime();
    const milisegundosTranscurridos = Date.now() - fechaInicialObj.getTime();
    const progreso = Math.min(milisegundosTranscurridos / milisegundosTotales, 1);
    return progreso;
}

// Iniciar la actualización del contador
actualizarContador();
