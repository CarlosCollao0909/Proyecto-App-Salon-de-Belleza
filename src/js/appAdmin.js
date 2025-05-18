document.addEventListener('DOMContentLoaded', () => {
    iniciarApp();
});

const iniciarApp = () => {
    mostrarAlerta();
    mostrarConfirmacionEliminar();
    iniciarDatatables('myTable');
    cambiarEstadoBotones();
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
    }
}

const mostrarConfirmacionEliminar = () => {
    const forms = document.querySelectorAll('.table__formulario');

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

        if(resultado.resultado) {
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