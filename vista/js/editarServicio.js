document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-editar');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const servicioId = this.value;
            
            fetch(`index.php?c=ServicioControlador&m=editar&id=${servicioId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(servicio => {
                console.log('Datos recibidos:', servicio);
    
                if (servicio.error) {
                    alert(servicio.error);
                    return;
                }

                const setValue = (id, value) => {
                    const element = document.getElementById(id);
                    if (element) element.value = value || '';
                };

                setValue('id_servicio', servicio.id_servicio);
                setValue('nombre', servicio.nombre);
                setValue('descripcion', servicio.descripcion);
                setValue('precio_base', servicio.precio_base);
                setValue('id_unidad_medida', servicio.id_unidad_medida);

                setTimeout(() => {
                    const editModal = new bootstrap.Modal(document.getElementById('editarServicioModal'));
                    editModal.show();
                }, 100);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cargar los datos del servicio: ' + error.message);
            });
        });
    });
});
