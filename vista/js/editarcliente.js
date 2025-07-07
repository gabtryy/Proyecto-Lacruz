document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-editar-cliente').forEach(btn => {
        btn.addEventListener('click', function() {
            const rif = this.getAttribute('data-rif');
            fetch(`index.php?c=clientes&m=obtenerClienteAjax&rif=${rif}`)
                .then(res => res.json())
                .then(data => {
                    // Llena los campos del modal
                    document.getElementById('rif_editar').value = data.rif;
                    document.getElementById('nombre_editar').value = data.nombre_cliente;
                    document.getElementById('apellido_editar').value = data.apellido_cliente;
                    document.getElementById('telefono_editar').value = data.telefono;
                    document.getElementById('direccion_detalle_editar').value = data.calle;
                    document.getElementById('email_editar').value = data.correo;

                    // Selecciona estado
                    const estadoSelect = document.getElementById('estado_editar');
                    estadoSelect.value = data.id_estado;

                    // Bloquea municipio y ciudad
                    const municipioSelect = document.getElementById('municipio_editar');
                    const ciudadSelect = document.getElementById('ciudad_editar');
                    municipioSelect.disabled = true;
                    ciudadSelect.disabled = true;

                    // Carga municipios y selecciona el correcto
                    fetch(`index.php?c=clientes&m=obtenerU&id_estado=${data.id_estado}`)
                        .then(res => res.json())
                        .then(municipios => {
                            municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                            municipios.forEach(m => {
                                municipioSelect.innerHTML += `<option value="${m.id_municipio}" ${m.id_municipio == data.id_municipio ? 'selected' : ''}>${m.nombre}</option>`;
                            });
                            // Carga ciudades y selecciona la correcta
                            fetch(`index.php?c=clientes&m=obtenerC&id_municipio=${data.id_municipio}`)
                                .then(res => res.json())
                                .then(ciudades => {
                                    ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                                    ciudades.forEach(c => {
                                        ciudadSelect.innerHTML += `<option value="${c.id_ciudad}" ${c.id_ciudad == data.id_ciudad ? 'selected' : ''}>${c.nombre}</option>`;
                                    });
                                });
                        });

                    // Muestra el modal
                    const modal = new bootstrap.Modal(document.getElementById('editarClienteModal'));
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
            fetch(`index.php?c=clientes&m=obtenerU&id_estado=${estadoId}`)
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
            fetch(`index.php?c=clientes&m=obtenerC&id_municipio=${municipioId}`)
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

    // Habilita selects antes de enviar el formulario
    document.getElementById('formEditarCliente').addEventListener('submit', function(e) {
        document.getElementById('municipio_editar').disabled = false;
        document.getElementById('ciudad_editar').disabled = false;
    });
});