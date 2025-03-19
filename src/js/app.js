let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

document.addEventListener('DOMContentLoaded', () => {
    iniciarApp();
});

const iniciarApp = () => {
    mostrarSeccion(); //muestra y oculta las secciones
    tabs(); //cambia la seccion cuando se presionen los tabs
    botonesPaginador(); //agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();
}

const mostrarSeccion = () => {
    //ocultar la seccion anterior
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }
    //seleccionar la seccion con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    //quitar la clase de activo del tab anterior
    const tabAnterior = document.querySelector('.tabs .activo');
    if(tabAnterior) {
        tabAnterior.classList.remove('activo');
    }

    //resaltar el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('activo');
}

const tabs = () => {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach( (boton) => {
        boton.addEventListener('click', (e) => {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
        });
    });
}

const botonesPaginador = () => {
    const siguiente = document.querySelector('#siguiente');
    const anterior = document.querySelector('#anterior');

    if(paso === 1) {
        anterior.classList.add('ocultarBoton');
        siguiente.classList.remove('ocultarBoton');
    } else if(paso === 3) {
        anterior.classList.remove('ocultarBoton');
        siguiente.classList.add('ocultarBoton');
    } else {
        anterior.classList.remove('ocultarBoton');
        siguiente.classList.remove('ocultarBoton');
    }

    mostrarSeccion();
}

const paginaSiguiente = () => {
    const siguiente = document.querySelector('#siguiente');
    if(paso >= pasoFinal) return;
    siguiente.addEventListener('click', () => {
        paso++;
        botonesPaginador();
    });
}

const paginaAnterior = () => {
    const anterior = document.querySelector('#anterior');
    anterior.addEventListener('click', () => {
        if(paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    });
}