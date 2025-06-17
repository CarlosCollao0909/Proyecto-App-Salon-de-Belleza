document.addEventListener('DOMContentLoaded', () => {
    iniciarApp();
});

const iniciarApp = () => {
    mostrarAlerta();
    mostrarConfirmacionEliminar();
    iniciarDatatables('myTable');
    cambiarEstadoBotones();
    mostrarVistaPreviaQR();
    irArriba();
    mostrarFullCalendar();
    // graficos chart.js
    cargarGraficoMensual();
    cargarGraficoDiario();
    cargarGraficoServicios();
    cargarGraficoClientes();
    cargarGraficoHorarios();
    // Validaciones de campos
    validarCamposServicio();
}

const limpiarParametroURL = (parametro) => {
    const url = new URL(window.location.href);
    url.searchParams.delete(parametro);
    window.history.replaceState({}, document.title, url.pathname);
}
const mostrarAlerta = () => {
    const parametroURL = new URLSearchParams(window.location.search);
    if (parametroURL.get('servicio_creado') === '1') {
        Swal.fire({
            icon: 'success',
            title: 'Servicio creado',
            text: 'El nuevo servicio fue registrado correctamente.',
            confirmButtonText: 'OK'
        }).then(() => {
            // Eliminar el parámetro de la URL sin recargar
            limpiarParametroURL('servicio_creado');
        });
    } else if (parametroURL.get('servicio_actualizado') === '1') {
        Swal.fire({
            icon: 'success',
            title: 'Servicio actualizado',
            text: 'El servicio fue actualizado correctamente.',
            confirmButtonText: 'OK'
        }).then(() => {
            limpiarParametroURL('servicio_actualizado');
        });
    } else if (parametroURL.get('servicio_eliminado') === '1') {
        Swal.fire({
            icon: 'success',
            title: 'Servicio eliminado',
            text: 'El servicio fue eliminado correctamente.',
            confirmButtonText: 'OK'
        }).then(() => {
            limpiarParametroURL('servicio_eliminado');
        });
    } else if (parametroURL.get('forma_pago_actualizada') === '1') {
        Swal.fire({
            icon: 'success',
            title: 'Forma de pago actualizada',
            text: 'La forma de pago fue actualizada correctamente.',
            confirmButtonText: 'OK'
        }).then(() => {
            limpiarParametroURL('forma_pago_actualizada');
        });
    } else if (parametroURL.get('cita_actualizada') === '1') {
        Swal.fire({
            icon: 'success',
            title: 'Cita actualizada',
            text: 'El estado de la cita fue actualizado correctamente.',
            confirmButtonText: 'OK'
        }).then(() => {
            limpiarParametroURL('cita_actualizada');
        });
    }
}

const mostrarConfirmacionEliminar = () => {
    const forms = document.querySelectorAll('.table__formulario');

    if (forms.length === 0) return;

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Detiene el envío del formulario

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Envío manual solo si se confirma
                }
            });
        });
    });
}

const iniciarDatatables = (tablaID) => {
    $(document).ready(function () {
        if (!$(`#${tablaID}`).length) return; // Verificar si existe
        $(`#${tablaID}`).DataTable({
            columns: [
                {
                    type: 'string',
                },
                {
                    type: 'string',
                },
                {
                    type: 'string',
                }
            ],
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.3.0/i18n/es-ES.json',
                lengthLabels: {
                    '-1': 'Todos'
                }
            },
            lengthMenu: [5, 10, 15, 25, 30, -1]
        });
    });
}

const cambiarEstadoBotones = () => {
    const botones = document.querySelectorAll(".btn-toggle-estado");

    //validar que existan los botones
    if (botones.length === 0) return;

    botones.forEach((boton) => {
        boton.addEventListener("click", () => cambiarEstadoHorarios(boton));
    });
}

const cambiarEstadoHorarios = async (boton) => {
    const horarioID = boton.dataset.id;
    const estadoActual = boton.dataset.estado; // 0 o 1
    const estadoNuevo = estadoActual === "0" ? "1" : "0";

    try {
        const url = '/api/horarios/estado';
        const datos = new FormData();
        datos.append('id', horarioID);
        datos.append('estado', estadoNuevo);

        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if (resultado.resultado) {
            const icono = boton.querySelector('i');
            boton.dataset.estado = estadoNuevo;
            boton.textContent = estadoNuevo === "1" ? "Deshabilitar" : "Habilitar";
            boton.classList.toggle("table__accion--deshabilitar", estadoNuevo === "1");
            boton.classList.toggle("table__accion--habilitar", estadoNuevo === "0");
            boton.prepend(icono);

            //cambiar icono
            icono.classList.toggle("fa-eye-slash", estadoNuevo === "1");
            icono.classList.toggle("fa-eye", estadoNuevo === "0");

            Swal.fire({
                icon: 'success',
                title: 'Estado cambiado',
                text: 'El estado del horario fue cambiado correctamente.',
                confirmButtonText: 'OK'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error al cambiar el estado',
                text: resultado.mensaje || 'No se pudo cambiar el estado del horario.',
                confirmButtonText: 'OK'
            });
        }
    } catch (error) {
        console.log(error);
        Swal.fire({
            icon: 'error',
            title: 'Error al cambiar el estado',
            text: 'No se pudo cambiar el estado del horario.',
            confirmButtonText: 'OK'
        });
    }
}

const mostrarVistaPreviaQR = () => {
    const inputImagenQR = document.querySelector('#imagenQR');
    const imagenPreview = document.querySelector('.formulario-admin__imagen');
    const preview = document.querySelector('#preview');

    //validar que exista el input tipo file
    if (!inputImagenQR) return;

    // Evento para cuando se selecciona un archivo
    inputImagenQR.addEventListener('change', function () {
        const archivoSeleccionado = this.files[0];

        if (archivoSeleccionado) {
            // objeto FileReader
            const fileReader = new FileReader();

            // Configurar el evento para cuando termine de leer
            fileReader.addEventListener('load', function () {
                // Establecer la fuente de la imagen como la URL de datos
                imagenPreview.src = this.result;

                // Mostrar la imagen (en caso de que estuviera oculta)
                imagenPreview.style.display = 'block';
                preview.style.display = 'none';
            });

            // Leer el archivo como URL de datos
            fileReader.readAsDataURL(archivoSeleccionado);
        } else {
            // Si no hay archivo seleccionado, ocultar la imagen
            imagenPreview.src = '';
            imagenPreview.style.display = 'none';
            preview.style.display = 'block';
        }
    });

    // Comprobación inicial: si la imagen ya tiene un src (por ejemplo, al editar)
    if (!imagenPreview.getAttribute('src') || imagenPreview.getAttribute('src') === '') {
        imagenPreview.style.display = 'none';
    }
}

const irArriba = () => {
    const btnIrArriba = document.querySelector('.ir-arriba');
    const contenedorScroll = document.querySelector('.dashboard__contenido'); // Ajusta al contenedor que hace scroll

    btnIrArriba.addEventListener('click', () => {
        console.log('Subiendo...');
        contenedorScroll.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    contenedorScroll.addEventListener('scroll', () => {
        if (contenedorScroll.scrollTop > 100) {
            btnIrArriba.style.display = 'block';
        } else {
            btnIrArriba.style.display = 'none';
        }
    });
};


const mostrarFullCalendar = () => {
    const calendario = document.querySelector('#calendario');
    if (!calendario) return;

    let calendar = new FullCalendar.Calendar(calendario, {
        initialView: 'dayGridMonth',
        height: 'auto',
        showNonCurrentDates: false,
        fixedWeekCount: false,
        headerToolbar: {
            left: 'dayGridMonth,timeGridWeek',
            center: 'title',
            right: 'prev,next'
        },
        buttonText: {
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },
        locale: 'es',
        selectable: true,
        selectMirror: true,
        unselectAuto: true,
        dayMaxEvents: 1,
        moreLinkClick: 'popover',
        moreLinkText: (num) => `+${num} más`,
        dateClick: (info) => {
            const fechaSeleccionada = encodeURIComponent(info.dateStr);
            consultarAPICitasPorDia(fechaSeleccionada);
        },
        // Función para personalizar la apariencia de los eventos
        eventDidMount: function (info) {
            const fechaCita = new Date(info.event.start);
            const fechaHoy = new Date();
            fechaHoy.setHours(0, 0, 0, 0);

            // Remover colores por defecto
            info.el.style.backgroundColor = 'transparent';
            info.el.style.borderColor = 'transparent';

            // Aplicar clases CSS según si la cita es pasada o futura
            if (fechaCita < fechaHoy) {
                info.el.style.backgroundColor = '#f93a3a';
                info.el.style.color = '#FFFFFF';
            } else {
                info.el.style.backgroundColor = '#66cc33';
                info.el.style.color = '#FFFFFF';
            }
        }
    });

    calendar.render();

    // Agregar leyenda después de renderizar el calendario
    agregarLeyenda();

    // Mostrar las citas del día actual por defecto
    const fechaActual = new Date().toLocaleDateString('en-CA');
    consultarAPICitasPorDia(fechaActual);

    // Consultar todas las citas al cargar el calendario
    consultarAPICitas(calendar);
}

// Función para agregar la leyenda de colores
const agregarLeyenda = () => {
    const contenedorCalendario = document.querySelector('.contenedor-calendario');
    if (!contenedorCalendario) return;

    // Verificar si ya existe la leyenda
    if (document.querySelector('.calendario-leyenda')) return;

    const leyenda = document.createElement('div');
    leyenda.className = 'calendario-leyenda';
    leyenda.innerHTML = `
        <div class="calendario-leyenda__item">
            <div class="color-indicator color-indicator--pasado"></div>
            <span>Citas Pasadas</span>
        </div>
        <div class="calendario-leyenda__item">
            <div class="color-indicator color-indicator--futuro"></div>
            <span>Citas Futuras</span>
        </div>
    `;

    contenedorCalendario.appendChild(leyenda);
}

const consultarAPICitas = async (calendar) => {
    try {
        const url = 'http://localhost:3000/api/citas_admin';
        const resultado = await fetch(url);
        const citas = await resultado.json();
        console.log('Citas obtenidas:', citas);

        if (calendar) {
            const eventos = citas.map(cita => ({
                title: cita.cliente,
                start: cita.fecha,
                allDay: true,
                // No definir color aquí, se manejará en eventDidMount
            }));
            calendar.removeAllEvents();
            calendar.addEventSource(eventos);

            console.log('Eventos añadidos al calendario:', eventos);
        }

    } catch (error) {
        console.error('Error al consultar la API de citas:', error);
    }
}

const consultarAPICitasPorDia = async (fecha) => {
    try {
        const url = `http://localhost:3000/api/citas_admin?fecha=${fecha}`;
        const resultado = await fetch(url);
        const citas = await resultado.json();
        console.log('Citas obtenidas para la fecha:', fecha, citas);

        mostrarCitas(citas, fecha);
    } catch (error) {
        console.error('Error al consultar la API de citas por día:', error);
    }
}

const mostrarCitas = (citas, fecha) => {
    const contenedor = document.querySelector('#citas');
    contenedor.innerHTML = '';

    if (!citas || citas.length === 0) {
        contenedor.innerHTML = `
            <div class="no-citas">
                <div class="no-citas__icon">📅</div>
                <h3 class="no-citas__mensaje">No se encontraron citas para la fecha seleccionada.</h3>
            </div>`;
        return;
    }

    // Agregar header
    const header = document.createElement('h3');
    header.className = 'citas-header';
    header.textContent = `Citas para la fecha: ${fecha}`;
    contenedor.appendChild(header);

    citas.forEach(cita => {
        const citaCard = document.createElement('div');
        citaCard.className = 'cita-card';

        citaCard.innerHTML = `
            <div class="cita-card__header">
                <div class="cita-card__cliente">${cita.cliente}</div>
                <div class="cita-card__horario">${cita.horario}</div>
            </div>
            
            <div class="cita-card__detalles">
                <div class="cita-card__detalle-item">
                    <span class="label">Servicio</span>
                    <span class="valor valor--capitalize">${(cita.servicio).toLowerCase()}</span>
                </div>
                
                <div class="cita-card__detalle-item">
                    <span class="label">Precio</span>
                    <span class="valor valor--precio">Bs. ${cita.precio}</span>
                </div>
                
                <div class="cita-card__detalle-item">
                    <span class="label">Estado</span>
                    <span class="valor">
                        <span class="cita-card__estado cita-card__estado--${cita.estado}">${cita.estado}</span>
                    </span>
                </div>
                
                <div class="cita-card__detalle-item">
                    <span class="label">Forma de pago</span>
                    <span class="valor valor--capitalize">${(cita.formaPago).toLowerCase()}</span>
                </div>
                
                <div class="cita-card__detalle-item">
                    <span class="label">Email</span>
                    <span class="valor">${cita.email}</span>
                </div>
                
                <div class="cita-card__detalle-item">
                    <span class="label">Teléfono</span>
                    <span class="valor">${cita.telefono}</span>
                </div>
            </div>
            
            ${cita.comprobantePago ? `
                <div class="cita-card__comprobante">
                    <p><strong>Comprobante:</strong></p>
                    <img src="/images/comprobantes/${cita.comprobantePago}" alt="Comprobante de pago">
                </div>
            ` : ''}

            ${cita.estado === 'confirmada' ? `
                <div class="cita-card__accion">
                    <form action="/admin/citas/editar" method="POST">
                        <input type="hidden" name="id" value="${cita.id}">
                        <button type="submit" class="cita-card__boton">Marcar como Finalizada</button>
                    </form>
                </div>
            `: ''}
        `;

        contenedor.appendChild(citaCard);
    });
};

// Funciones para cargar gráficos con Chart.js
const cargarGraficoMensual = async () => {
    const res = await fetch('/api/reportes/ingresos_mensuales');
    const data = await res.json();
    const labels = data.map(item => item.mes);
    const valores = data.map(item => item.total_ingresos);

    if (!document.getElementById("graficoMensual")) return;    new Chart(document.getElementById("graficoMensual"), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Ingresos por mes',
                data: valores,
                backgroundColor: 'rgba(66, 133, 244, 0.7)',
                borderColor: 'rgba(66, 133, 244, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

const cargarGraficoDiario = async () => {
    const res = await fetch('/api/reportes/ingresos_diarios');
    const data = await res.json();
    const labels = data.map(item => item.fecha);
    const valores = data.map(item => item.total_ingresos);

    if (!document.getElementById("graficoDiario")) return;    new Chart(document.getElementById("graficoDiario"), {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Ingresos por día',
                data: valores,
                fill: {
                    target: 'origin',
                    above: 'rgba(52, 168, 83, 0.1)'
                },
                borderColor: 'rgba(52, 168, 83, 0.8)',
                tension: 0.3,
                pointRadius: 5,
                pointBackgroundColor: 'rgba(52, 168, 83, 1)'
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

const cargarGraficoServicios = async () => {
    const res = await fetch('/api/reportes/servicios_solicitados');
    const data = await res.json();
    const labels = data.map(item => item.servicio);
    const valores = data.map(item => item.cantidad);

    if (!document.getElementById("graficoServicios")) return;

    new Chart(document.getElementById("graficoServicios"), {
        type: 'pie',
        data: {
            labels,
            datasets: [{
                label: 'Cantidad de veces Solicitado',
                data: valores,
                backgroundColor: [
                    'rgba(66, 133, 244, 0.8)',
                    'rgba(219, 68, 55, 0.8)',
                    'rgba(244, 180, 0, 0.8)',
                    'rgba(52, 168, 83, 0.8)',
                    'rgba(156, 39, 176, 0.8)',
                    'rgba(3, 169, 244, 0.8)',
                    'rgba(255, 152, 0, 0.8)',
                    'rgba(0, 150, 136, 0.8)'
                ],
                borderColor: 'white',
                borderWidth: 2
            }]
        }
    });
}

const cargarGraficoClientes = async () => {
    const res = await fetch('/api/reportes/clientes_frecuentes');
    const data = await res.json();
    const labels = data.map(item => item.cliente);
    const valores = data.map(item => item.cantidad_citas);

    if (!document.getElementById("graficoClientes")) return;    new Chart(document.getElementById("graficoClientes"), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Citas Agendadas por Cliente',
                data: valores,
                backgroundColor: 'rgba(219, 68, 55, 0.7)',
                borderColor: 'rgba(219, 68, 55, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

const cargarGraficoHorarios = async () => {
    const res = await fetch('/api/reportes/horarios_demandados');
    const data = await res.json();
    const labels = data.map(item => item.horario);
    const valores = data.map(item => item.cantidad);

    if (!document.getElementById("graficoHorarios")) return;    new Chart(document.getElementById("graficoHorarios"), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Cantidad de citas por horario',
                data: valores,
                backgroundColor: 'rgba(244, 180, 0, 0.7)',
                borderColor: 'rgba(244, 180, 0, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}


//validaciones campos servicio
const validarCamposServicio = () => {
    const nombre = document.getElementById('nombre');
    const precio = document.getElementById('precio');

    //Limitar nombre a letras y espacios, convertir a mayúsculas
    nombre.addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '').toUpperCase();
    });

    // Solo permitir números y punto decimal, limitar a 999.99
    precio.addEventListener('input', function () {
        // Solo números y un punto
        this.value = this.value.replace(/[^0-9.]/g, '');

        // Solo un punto decimal
        const partes = this.value.split('.');
        if (partes.length > 2) {
            this.value = partes[0] + '.' + partes[1];
        }

        // Limitar a dos decimales
        if (partes[1] && partes[1].length > 2) {
            this.value = partes[0] + '.' + partes[1].substring(0, 2);
        }

        // Limitar a 999.99
        if (parseFloat(this.value) > 999.99) {
            this.value = '';
        }
    });
}