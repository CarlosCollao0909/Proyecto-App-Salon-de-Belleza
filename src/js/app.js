let paso = 1;
const pasoInicial = 1;
const pasoFinal = 4;

//objeto para almacenar los datos de la cita
const cita = {
    usuarioID: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicio: {
        id: '',
        nombre: '',
        precio: ''
    }
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
    consultarAPIHorarios(); //consulta la API para obtener los horarios
    obtenerIDCliente(); //añade el id del cliente al objeto cita
    obtenerNombreCliente(); //añade el nombre del cliente al objeto cita
    seleccionarFecha(); //añade la fecha de la cita al objeto
    mostrarOcultarMetodoPago(); //muestra o oculta el codigo QR o el total a pagar
    mostrarResumen(); //mostrar el resumen de la cita
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
    console.log(cita);
};

const consultarAPIHorarios = async () => {
    try {
        const url = 'http://localhost:3000/api/horarios';
        const resultado = await fetch(url);
        const horarios = await resultado.json();
        mostrarHorarios(horarios);
    } catch (error) {
        console.log(error);
    }
}

const mostrarHorarios = (horarios) => {
    horarios.forEach(horario => {
        const { id, horaInicio, horaFin } = horario;
        const opcion = document.createElement('OPTION');
        opcion.value = id;
        opcion.textContent = `${horaInicio} - ${horaFin}`;
        document.querySelector('#horarios').appendChild(opcion);
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
        }
    })
}

// const seleccionarHora = () => {
//     const horaInput = document.querySelector('#hora');
//     horaInput.addEventListener('input', (e) => {
//         const horaCita = e.target.value;
//         const hora = horaCita.split(':')[0];
//         if (hora < 9 || hora >= 21) {
//             e.target.value = '';
//             mostrarAlerta('Hora no válida', 'error', '.formulario');
//         } else {
//             cita.hora = e.target.value;
//             console.log(cita);
//         }
//     });
// }

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

const mostrarOcultarMetodoPago = () => {
    const metodoPago = document.querySelectorAll('input[name="pago"]');
    const qrDiv = document.querySelector('#pagos__qr');
    console.log(qrDiv)

    metodoPago.forEach((metodo) => {
        metodo.addEventListener('click', (e) => {
            if (e.target.value === 'efectivo') {
                qrDiv.innerHTML = '<p class="text-center">Presiona el boton siguiente para continuar</p>';
            } else {
                qrDiv.innerHTML = '<img src="https://imgs.search.brave.com/D50OptkHpIjaXVvVNkXV_aQvQ3YojODOJWBnmL_OT-4/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMTM5/NzUzNzQyNS9lcy9m/b3RvL3FyLWJhcmNv/ZGUtZm9yLWRhdGEt/bGFiZWxpbmcuanBn/P3M9NjEyeDYxMiZ3/PTAmaz0yMCZjPUlI/dlFsZ1l6em5maUFC/QnlCU3NoRE9VRjZu/NTlqZzNFUVh4bnhj/SE55SjA9" alt="QR">';
            }
        })
    })
}

const mostrarResumen = () => {
    const resumen = document.querySelector('.contenido-resumen');
    //limpiar el contenido del resumen
    while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    //validar campos vacios (object.values) muestra y accede a los campos del objeto
    if (Object.values(cita).includes('')) {
        // console.log('faltan datos o servicios');
        mostrarAlerta('Faltan datos de los servicios, fecha u hora', 'error', '.contenido-resumen', false);
        return;
    }
    //formatear el div de resumen
    const { nombre, fecha, hora, servicio } = cita; //destructuring a cita

    //headin para el resumen (servicio)
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Servicio'
    resumen.appendChild(headingServicios);

    const contenedorServicio = document.createElement('DIV');
    contenedorServicio.classList.add('contenedor-servicio');

    const nombreServicio = document.createElement('P');
    nombreServicio.innerHTML = `<span>Servicio Solicitado:</span> ${servicio.nombre}`;

    const precioServicio = document.createElement('P');
    precioServicio.innerHTML = `<span>Precio:</span> Bs.${servicio.precio}`

    contenedorServicio.appendChild(nombreServicio);
    contenedorServicio.appendChild(precioServicio);

    resumen.appendChild(contenedorServicio);


    //headin para el resumen (datos de la cita)
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de los Datos de la Cita'
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`

    //formatear la fecha en español
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2; //+2 por el cambio de horario
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));
    // console.log(fechaUTC)

    const opciones = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }
    const fechaFormateada = fechaUTC.toLocaleDateString('es-BO', opciones);
    // console.log(fechaFormateada);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora}`

    //boton para crear nueva cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Confirmar Cita';
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    resumen.appendChild(botonReservar);
}

const reservarCita = async () => {
    const { usuarioID, fecha, hora, servicios } = cita;

    //obtener los id de los servicios seleccionados
    const ServiciosID = servicios.map(servicio => servicio.id);

    const datos = new FormData();
    datos.append('usuarioID', usuarioID);
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('servicios', ServiciosID);

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
    }

    // console.log([...datos]);
}