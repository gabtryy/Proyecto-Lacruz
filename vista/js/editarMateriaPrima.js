document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-editar');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const materiaId = this.value;
            
            fetch(`index.php?c=MateriaPrimaControlador&m=editar&id=${materiaId}`, {
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
            .then(materia => {
                console.log('Datos recibidos:', materia);
    
                if (materia.error) {
                    alert(materia.error);
                    return;
                }

                document.getElementById('edit_id_materia').value = materia.id_materia;
                document.getElementById('edit_nombre').value = materia.nombre || '';
                document.getElementById('edit_medida').value = materia.medida || '';
                document.getElementById('edit_stock').value = materia.stock || '';
                
                const proveedorSelect = document.getElementById('edit_proveedores');
                if (proveedorSelect) {
                    for (let i = 0; i < proveedorSelect.options.length; i++) {
                        if (proveedorSelect.options[i].value == materia.id_proveedores) {
                            proveedorSelect.options[i].selected = true;
                            break;
                        }
                    }
                }

                const editModal = new bootstrap.Modal(document.getElementById('editarMateriaModal'));
                editModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cargar los datos de la materia prima: ' + error.message);
            });
        });
    });
});