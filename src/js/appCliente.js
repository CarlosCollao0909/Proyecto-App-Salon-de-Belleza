let paso = 1;
const pasoInicial = 1;
const pasoFinal = 4;
let intervaloHorarios = null;
let intervaloPrecioServicio = null;

//objeto para almacenar los datos de la cita
const cita = {
    usuarioID: '',
    nombre: '',
    fecha: '',
    formaPago: '',
    servicio: {
        id: '',
        nombre: '',
        precio: ''
    },
    horario: {
        id: '',
        horarioSeleccionado: ''
    },
    comprobante: null
}


document.addEventListener('DOMContentLoaded', () => {
    iniciarApp();
});

const iniciarApp = () => {
    mostrarSeccion(); //muestra y oculta las secciones
    tabs(); //cambia la seccion cuando se presionen los tabs
    botonesPaginador(); //agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();
    consultarAPIServicios(); //consulta la API para obtener los servicios
    obtenerIDCliente(); //añade el id del cliente al objeto cita
    obtenerNombreCliente(); //añade el nombre del cliente al objeto cita
    seleccionarFecha(); //añade la fecha de la cita al objeto
    seleccionarHorario(); //añade el id del horario al objeto cita
    mostrarOcultarFormaPago(); //muestra o oculta el codigo QR o el total a pagar
}

const mostrarSeccion = () => {
    //ocultar la seccion anterior
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }
    //seleccionar la seccion con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    //quitar la clase de activo del tab anterior
    const tabAnterior = document.querySelector('.tabs .activo');
    if (tabAnterior) {
        tabAnterior.classList.remove('activo');
    }

    //resaltar el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('activo');
}

const tabs = () => {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach((boton) => {
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

    if (paso === 1) {
        anterior.classList.add('ocultarBoton');
        siguiente.classList.remove('ocultarBoton');
    } else if (paso === 4) {
        anterior.classList.remove('ocultarBoton');
        siguiente.classList.add('ocultarBoton');
        mostrarResumen(); //validar que los datos del objeto cita esten llenos (para el resumen)
    } else {
        anterior.classList.remove('ocultarBoton');
        siguiente.classList.remove('ocultarBoton');
    }

    mostrarSeccion();
}

const paginaSiguiente = () => {
    const siguiente = document.querySelector('#siguiente');
    if (paso >= pasoFinal) return;
    siguiente.addEventListener('click', () => {
        paso++;
        botonesPaginador();
    });
}

const paginaAnterior = () => {
    const anterior = document.querySelector('#anterior');
    anterior.addEventListener('click', () => {
        if (paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    });
}

const consultarAPIServicios = async () => {
    try {
        const url = 'http://localhost:3000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

const mostrarServicios = (servicios) => {
    servicios.forEach(servicio => {
        const { id, nombre, precio } = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `Bs. ${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id; //resultado: data-id-servicio=id
        servicioDiv.onclick = () => {
            seleccionarServicio(servicio);
        };

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);

    });
}

const seleccionarServicio = (servicio) => {
    // console.log(servicio);
    const { id, nombre, precio } = servicio;
    // Identificar el div del servicio que fue clickeado
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
    // Si el servicio clickeado ya está seleccionado, deseleccionarlo
    if (cita.servicio.id === id) {
        cita.servicio.id = ''; // Limpiar el servicio seleccionado
        divServicio.classList.remove('seleccionado');
    } else {
        // Eliminar la selección de cualquier servicio previamente seleccionado
        if (cita.servicio.id) {
            const divServicioPrevio = document.querySelector(`[data-id-servicio="${cita.servicio.id}"]`);
            if (divServicioPrevio) {
                divServicioPrevio.classList.remove('seleccionado');
            }
        }
        // Seleccionar el nuevo servicio
        cita.servicio.id = id;
        cita.servicio.nombre = nombre;
        cita.servicio.precio = precio;
        divServicio.classList.add('seleccionado');
    }
};

const consultarAPIHorarios = async () => {
    console.log(cita.fecha)
    try {
        const url = `http://localhost:3000/api/horarios?fecha=${cita.fecha}`;
        const resultado = await fetch(url);
        const horarios = await resultado.json();
        mostrarHorarios(horarios);
    } catch (error) {
        console.log(error);
    }
}

const mostrarHorarios = (horarios) => {
    const select = document.querySelector('#horarios');

    // Limpiar opciones anteriores
    while (select.firstChild) {
        select.removeChild(select.firstChild);
    }

    // Agregar opción por defecto
    const opcionDefault = document.createElement('OPTION');
    opcionDefault.textContent = '-- Selecciona un horario --';
    opcionDefault.disabled = true;
    opcionDefault.selected = true;
    select.appendChild(opcionDefault);

    // Si no hay horarios disponibles
    if (horarios.length === 0) {
        const opcion = document.createElement('OPTION');
        opcion.textContent = 'No hay horarios disponibles';
        opcion.disabled = true;
        select.appendChild(opcion);
        return;
    }

    // Agregar los nuevos horarios
    horarios.forEach(horario => {
        const { id, horaInicio, horaFin } = horario;
        const opcion = document.createElement('OPTION');
        opcion.value = id;
        opcion.textContent = `${horaInicio} - ${horaFin}`;
        select.appendChild(opcion);
    });
};


const seleccionarHorario = () => {
    const horariosSelect = document.querySelector('#horarios');
    horariosSelect.addEventListener('change', (e) => {
        cita.horario.id = parseInt(e.target.selectedOptions[0].value);
        cita.horario.horarioSeleccionado = e.target.selectedOptions[0].text;
    });
}

const obtenerIDCliente = () => {
    const idInput = document.querySelector('#id').value;
    cita.usuarioID = idInput;
}

const obtenerNombreCliente = () => {
    const nombreInput = document.querySelector('#nombre').value;
    cita.nombre = nombreInput;
}

const seleccionarFecha = () => {
    const fechaInput = document.querySelector('#fecha');
    fechaInput.addEventListener('input', (e) => {
        const dia = new Date(e.target.value).getUTCDay(); //getUTCDay devuelve 0=domingo, 1=lunes, ... , 6=sabado

        if ([0].includes(dia)) {
            e.target.value = '';
            // console.log('Dias domingo no atendemos');
            mostrarAlerta('No hay atención domingo', 'error', '.formulario');
        } else {
            // console.log(e.target.value);
            cita.fecha = e.target.value;
            consultarAPIHorarios(); //consulta la API para obtener los horarios

            // limpiar intervalo
            if (intervaloHorarios) {
                clearInterval(intervaloHorarios);
            }

            intervaloHorarios = setInterval(() => {
                consultarAPIHorarios();
            }, 15000);

        }
    });

    const selectHorarios = document.querySelector('#horarios');
    if (!cita.fecha) {
        const opcionMensaje = document.createElement('OPTION');
        opcionMensaje.textContent = 'Selecciona una fecha para ver los horarios disponibles';
        opcionMensaje.disabled = true;
        selectHorarios.appendChild(opcionMensaje);
    }
}

/* const validarFecha = () => {
    const fechaInput = document.querySelector('#fecha');
    fechaInput.addEventListener('input', (e) => {
        const fechaIngresada = fechaInput.value;
        const fechaActual = new Date();
        fechaActual.setDate(fechaActual.getDate() + 1);

        const fechaMinima = fechaActual.toISOString().split('T')[0];

        console.log(`fechaingresada: ${fechaIngresada} y fechaminima: ${fechaMinima} ${fechaIngresada < fechaMinima}`);

        if(fechaIngresada < fechaMinima) {
            console.log('entra');
            e.target.value = '';
            mostrarAlerta('No se puede seleccionar dias anteriores', 'error');
        } else {
            console.log('no entra');
        }
    });
} */

const mostrarAlerta = (mensaje, tipo, elemento, desapareceAlerta = true) => {
    //prevenir que se muestre la alerta multiples veces
    const alertaPrevia = document.querySelector('.alerta');
    if (alertaPrevia) {
        alertaPrevia.remove();
    };

    //crear la alerta en un div
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);
    const referenciaElemento = document.querySelector(elemento);
    referenciaElemento.appendChild(alerta);

    if (desapareceAlerta) {
        //borrar alerta despues de 2.5s
        setTimeout(() => {
            alerta.remove();
        }, 2500);
    }
}

const mostrarOcultarFormaPago = () => {
    const metodoPago = document.querySelectorAll('input[name="pago"]');
    const infoDiv = document.querySelector('#informacion__pago');
    const urlQr = infoDiv.dataset.qrUrl;

    metodoPago.forEach((metodo) => {
        metodo.addEventListener('click', (e) => {
            infoDiv.innerHTML = '';
            if (e.target.value === '1') {
                cita.formaPago = e.target.value;
                const parrafoIndicativo = document.createElement('P');
                parrafoIndicativo.classList.add('text-center');
                parrafoIndicativo.textContent = 'Presiona el boton siguiente para continuar';
                infoDiv.appendChild(parrafoIndicativo);
            } else if (e.target.value === '2') {
                cita.formaPago = e.target.value;
                
                const parrafoIndicativo = document.createElement('P');
                parrafoIndicativo.classList.add('text-center', 'parrafo__indicativo');
                parrafoIndicativo.textContent = '';
                if (Object.values(cita.servicio).includes('')) {
                    mostrarAlerta('Por favor selecciona un servicio para visualizar el código QR', 'error', '.informacion__pago', false);
                    e.target.checked = false;
                } else {
                    parrafoIndicativo.textContent = 'Escanea el codigo QR desde tu aplicacion del banco para pagar el costo del servicio: ';
                    const span = document.createElement('SPAN');
                    span.textContent = `Bs. ${cita.servicio.precio}`;
                    // TODO: ver la manera de actualizar el precio si el servicio cambia
                    if (intervaloPrecioServicio) {
                        clearInterval(intervaloPrecioServicio);
                    }
                    intervaloPrecioServicio = setInterval(() => {
                        span.textContent = `Bs. ${cita.servicio.precio}`;
                    }, 3000);

                    parrafoIndicativo.appendChild(span);
                    infoDiv.appendChild(parrafoIndicativo);

                    const campoFileDiv = document.createElement('DIV');
                    campoFileDiv.classList.add('campo__file');

                    const labelInputFile = document.createElement('LABEL');
                    labelInputFile.setAttribute('for', 'comprobante');
                    labelInputFile.classList.add('label__file');
                    labelInputFile.textContent = 'Subir el comprobante';

                    const iconoUpload = document.createElement('I');
                    iconoUpload.classList.add('fa-solid', 'fa-upload');
                    labelInputFile.appendChild(iconoUpload);

                    campoFileDiv.appendChild(labelInputFile);

                    const inputFile = document.createElement('INPUT');
                    inputFile.type = 'file';
                    inputFile.accept = 'image/jpg, image/jpeg, image/png';
                    inputFile.name = 'qr';
                    inputFile.id = 'comprobante';
                    inputFile.classList.add('input__file');
                    inputFile.addEventListener('change', (e) => {
                        console.log(e.target.files[0]);
                        cita.comprobante = e.target.files[0];
                    });

                    campoFileDiv.appendChild(inputFile);
                    infoDiv.appendChild(campoFileDiv);
                    const imagenQr = document.createElement('IMG');
                    imagenQr.src = `../../images/QR/${urlQr}`;
                    infoDiv.appendChild(imagenQr);
                }
            }
        })

    })
}

const mostrarResumen = () => {
    console.log(cita);
    const resumen = document.querySelector('.contenido-resumen');
    //limpiar el contenido del resumen
    while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    //validar campos vacios (object.values) muestra y accede a los campos del objeto
    if (Object.values(cita).includes('') || Object.values(cita.servicio).includes('') || Object.values(cita.horario).includes('')) {
        mostrarAlerta('Faltan datos de los servicios, fecha, horario o forma de pago', 'error', '.contenido-resumen', false);
        return;
    }

    if (cita.formaPago === '2') {
        if (!cita.comprobante) {
            mostrarAlerta('Falta el comprobante de pago', 'error', '.contenido-resumen', false);
            return;
        }
    }

    //formatear el div de resumen
    const { nombre, fecha, horario, servicio } = cita; //destructuring a cita

    //formatear la fecha en español
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2; //+2 por el cambio de horario
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));

    const opciones = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }
    const fechaFormateada = fechaUTC.toLocaleDateString('es-BO', opciones);

    // Heading para el resumen 
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de los Datos de la Cita';
    headingCita.classList.add('resumen-heading');
    resumen.appendChild(headingCita);

    // línea debajo del título
    const decorador = document.createElement('DIV');
    decorador.classList.add('resumen-decorador');
    resumen.appendChild(decorador);

    const contenedorResumen = document.createElement('DIV');
    contenedorResumen.classList.add('contenedor-resumen');
    resumen.appendChild(contenedorResumen);

    // información personal
    const infoPersonal = document.createElement('DIV');
    infoPersonal.classList.add('resumen-seccion');

    const nombreCliente = document.createElement('DIV');
    nombreCliente.classList.add('resumen-campo');
    nombreCliente.innerHTML = `
        <div class="resumen-icono resumen-icono-usuario"></div>
        <div class="resumen-info">
            <span class="resumen-etiqueta">Nombre:</span>
            <p class="resumen-valor">${nombre}</p>
        </div>
    `;

    const fechaCita = document.createElement('DIV');
    fechaCita.classList.add('resumen-campo');
    fechaCita.innerHTML = `
        <div class="resumen-icono resumen-icono-calendario"></div>
        <div class="resumen-info">
            <span class="resumen-etiqueta">Fecha:</span>
            <p class="resumen-valor">${fechaFormateada}</p>
        </div>
    `;

    const horarioCita = document.createElement('DIV');
    horarioCita.classList.add('resumen-campo');
    horarioCita.innerHTML = `
        <div class="resumen-icono resumen-icono-reloj"></div>
        <div class="resumen-info">
            <span class="resumen-etiqueta">Hora:</span>
            <p class="resumen-valor">${horario.horarioSeleccionado}</p>
        </div>
    `;

    infoPersonal.appendChild(nombreCliente);
    infoPersonal.appendChild(fechaCita);
    infoPersonal.appendChild(horarioCita);
    contenedorResumen.appendChild(infoPersonal);

    // separador
    const separador = document.createElement('DIV');
    separador.classList.add('resumen-separador');
    contenedorResumen.appendChild(separador);

    // servicios
    const infoServicio = document.createElement('DIV');
    infoServicio.classList.add('resumen-seccion');

    const servicioCita = document.createElement('DIV');
    servicioCita.classList.add('resumen-campo');
    servicioCita.innerHTML = `
        <div class="resumen-icono resumen-icono-tijeras"></div>
        <div class="resumen-info">
            <span class="resumen-etiqueta">Servicio:</span>
            <p class="resumen-valor">${servicio.nombre}</p>
        </div>
    `;

    const infoPago = document.createElement('DIV');
    infoPago.classList.add('resumen-campo', 'resumen-pago');
    infoPago.innerHTML = `
        <div class="resumen-icono resumen-icono-tarjeta"></div>
        <div class="resumen-info-contenedor">
            <div class="resumen-info-pago">
                <span class="resumen-etiqueta">Total:</span>
                <p class="resumen-valor resumen-valor-precio">Bs. ${servicio.precio}</p>
            </div>
            <div class="resumen-info-pago">
                <span class="resumen-etiqueta">Forma de Pago:</span>
                <p class="resumen-valor">${cita.formaPago === '1' ? 'Efectivo' : 'QR'}</p>
            </div>
        </div>
    `;

    infoServicio.appendChild(servicioCita);
    infoServicio.appendChild(infoPago);
    contenedorResumen.appendChild(infoServicio);

    // Contenedor de botón
    const contenedorAcciones = document.createElement('DIV');
    contenedorAcciones.classList.add('resumen-acciones');

    // Botón para crear nueva cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton', 'boton-confirmar');
    botonReservar.textContent = 'Confirmar Cita';
    botonReservar.onclick = reservarCita;
    contenedorAcciones.appendChild(botonReservar);

    resumen.appendChild(contenedorAcciones);
}

const reservarCita = async () => {
    const { usuarioID, fecha, horario, servicio, formaPago } = cita;

    const datos = new FormData();
    datos.append('usuarioID', usuarioID);
    datos.append('fecha', fecha);
    datos.append('horarioID', horario.id);
    datos.append('servicioID', servicio.id);
    datos.append('formaPagoID', formaPago);

    if (formaPago === '2') {
        datos.append('imagenComprobante', cita.comprobante);
    }

    try {
        //peticion hacia la api
        const url = 'http://localhost:3000/api/citas';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        console.log(resultado.resultado);

        //mostrar alerta de confirmacion de cita
        if (resultado.resultado) {
            Swal.fire({
                icon: "success",
                title: "Cita creada",
                text: "La cita se ha creado correctamente",
            }).then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            });
        }

    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error...",
            text: "Hubo un error al guardar la cita",
        });
        console.log(error);
    }

    // console.log([...datos]);
}