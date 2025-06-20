document.addEventListener('DOMContentLoaded', () => {
    iniciarApp();
});

const iniciarApp = () => {
    validarCamposCrearCuenta();
    mostrarConfirmacionCancelar();
}

const validarCamposCrearCuenta = () => {
    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const telefono = document.getElementById('telefono');
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    if (!nombre || !apellido || !telefono || !email || !password) return;

    // Validar NOMBRE - solo letras, convertir a mayúsculas
    nombre.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '').toUpperCase();
    });

    // Validar APELLIDO - solo letras, convertir a mayúsculas
    apellido.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '').toUpperCase();
    });

    // Validar TELÉFONO - solo números, máximo 10 dígitos
    telefono.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 8) {
            this.value = this.value.substring(0, 8);
        }
    });

    // Validar EMAIL - minúsculas, prevenir espacios
    email.addEventListener('keydown', function(e) {
        if (e.key === ' ') {
            e.preventDefault();
        }
    });
    
    email.addEventListener('input', function() {
        this.value = this.value.toLowerCase();
    });
}

// alerta para cancelar la cita
const mostrarConfirmacionCancelar = () => {
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
                confirmButtonText: 'Sí, cancelar cita',
                cancelButtonText: 'No, volver'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Envío manual solo si se confirma
                }
            });
        });
    });
}