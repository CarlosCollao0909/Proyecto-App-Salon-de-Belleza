document.addEventListener('DOMContentLoaded', () => {
    mostrarAlerta();
    mostrarConfirmacionEliminar();
});

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

$(document).ready(function () {
    $('#myTable').DataTable({
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