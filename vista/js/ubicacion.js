document.addEventListener('DOMContentLoaded', function() {
    const estadoSelect = document.getElementById('estado');
    const municipioSelect = document.getElementById('municipio');
    const ciudadSelect = document.getElementById('ciudad');

  
    estadoSelect.addEventListener('change', function() {
        if(this.value) {
            fetch(`index.php?c=clientes&m=obtenerU&id_estado=${this.value}`)
                .then(response => response.json())
                .then(data => {
                    municipioSelect.innerHTML = '<option value="" selected disabled>Seleccione un municipio</option>';
                    
                    data.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio.id_municipio;
                        option.textContent = municipio.nombre;
                        municipioSelect.appendChild(option);
                    });
                    
                    municipioSelect.disabled = false;
                    ciudadSelect.innerHTML = '<option value="" selected disabled>Primero seleccione un municipio</option>';
                    ciudadSelect.disabled = true;
                })
                .catch(error => console.error('Error:', error));
        }
    });


    municipioSelect.addEventListener('change', function() {
        if(this.value) {
            fetch(`index.php?c=clientes&m=obtenerC&id_municipio=${this.value}`)
                .then(response => response.json())
                .then(data => {
                    ciudadSelect.innerHTML = '<option value="" selected disabled>Seleccione una ciudad</option>';
                    
                    data.forEach(ciudad => {
                        const option = document.createElement('option');
                        option.value = ciudad.id_ciudad;
                        option.textContent = ciudad.nombre;
                        ciudadSelect.appendChild(option);
                    });
                    
                    ciudadSelect.disabled = false;
                })
                .catch(error => console.error('Error:', error));
        }
    });
});