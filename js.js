const contador = {
    fechaInicio: null,
    fechaFin: null,
    valorInicio: null,
    valorFin: null,
    periodo_dia: 1000, // valor por defecto
    periodo_noche: 500, // valor por defecto

    tiempoTotal: this.fechaFin.getTime() - this.fechaInicio.getTime(),
    tiempoTranscurrido: this.fechaActual.getTime() - this.fechaInicio.getTime(),
    progresoTiempo: this.tiempoTranscurrido / this.tiempoTotal,
    valorActual: this.valorInicio + (this.valorFin - this.valorInicio) * this.progresoTiempo,


    es_de_dia: function () {
        const hora_actual = new Date().getHours();
        return hora_actual >= 6 && hora_actual < 18;
    },

    ejecutar_con_intervalo: function (tiempo, funcion) {
        setInterval(funcion, tiempo);
    },

    generar_numero_aleatorio: function () {
        return Math.floor(Math.random() * 10) + 1;
    },

    estrategia: function () {
        return this.es_de_dia() ? this.periodo_dia : this.periodo_noche;
    },

    renderizarHtml: function (elemento) {
        // aquí quiero renderizar un contador
    }
};