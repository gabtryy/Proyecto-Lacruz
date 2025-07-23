document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-editar-proveedor').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            fetch(`index.php?c=proveedores&m=obtenerProveedorAjax&id_proveedores=${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('id_proveedores').value = data.id_proveedores;
                    document.getElementById('nombre_editar').value = data.nombre;
                    document.getElementById('telefono_editar').value = data.telefono;
                    document.getElementById('direccion_detalle_editar').value = data.calle;
                    document.getElementById('email_editar').value = data.correo;

                    // Estado
                    document.getElementById('estado_editar').value = data.id_estado;

                    // Bloquea municipio y ciudad
                    const municipioSelect = document.getElementById('municipio_editar');
                    const ciudadSelect = document.getElementById('ciudad_editar');
                    municipioSelect.disabled = true;
                    ciudadSelect.disabled = true;

                    // Carga municipios y selecciona el correcto
                    fetch(`index.php?c=proveedores&m=obtenerU&id_estado=${data.id_estado}`)
                        .then(res => res.json())
                        .then(municipios => {
                            municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                            municipios.forEach(m => {
                                municipioSelect.innerHTML += `<option value="${m.id_municipio}" ${m.id_municipio == data.id_municipio ? 'selected' : ''}>${m.nombre}</option>`;
                            });
                            // Carga ciudades y selecciona la correcta
                            fetch(`index.php?c=proveedores&m=obtenerC&id_municipio=${data.id_municipio}`)
                                .then(res => res.json())
                                .then(ciudades => {
                                    ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                                    ciudades.forEach(c => {
                                        ciudadSelect.innerHTML += `<option value="${c.id_ciudad}" ${c.id_ciudad == data.id_ciudad ? 'selected' : ''}>${c.nombre}</option>`;
                                    });
                                });
                        });

                    // Muestra el modal
                    const modal = new bootstrap.Modal(document.getElementById('editarProveedorModal'));
                    modal.show();
                });
        });
    });

    // Cuando cambia el estado, habilita municipio y ciudad y recarga opciones
    document.getElementById('estado_editar').addEventListener('change', function() {
        const estadoId = this.value;
        const municipioSelect = document.getElementById('municipio_editar');
        const ciudadSelect = document.getElementById('ciudad_editar');
        if (estadoId) {
            municipioSelect.disabled = false;
            fetch(`index.php?c=proveedores&m=obtenerU&id_estado=${estadoId}`)
                .then(res => res.json())
                .then(municipios => {
                    municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                    municipios.forEach(m => {
                        municipioSelect.innerHTML += `<option value="${m.id_municipio}">${m.nombre}</option>`;
                    });
                    ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                    ciudadSelect.disabled = true;
                });
        } else {
            municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
            municipioSelect.disabled = true;
            ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
            ciudadSelect.disabled = true;
        }
    });

    // Cuando cambia el municipio, habilita ciudad y recarga opciones
    document.getElementById('municipio_editar').addEventListener('change', function() {
        const municipioId = this.value;
        const ciudadSelect = document.getElementById('ciudad_editar');
        if (municipioId) {
            ciudadSelect.disabled = false;
            fetch(`index.php?c=proveedores&m=obtenerC&id_municipio=${municipioId}`)
                .then(res => res.json())
                .then(ciudades => {
                    ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                    ciudades.forEach(c => {
                        ciudadSelect.innerHTML += `<option value="${c.id_ciudad}">${c.nombre}</option>`;
                    });
                });
        } else {
            ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
            ciudadSelect.disabled = true;
        }
    });
});