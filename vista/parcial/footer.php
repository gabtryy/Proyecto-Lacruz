
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Activar el sidebar si está definido
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si el sidebar existe
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        
        if (sidebar && sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                document.querySelector('.main-content').classList.toggle('sidebar-active');
            });
        }
        
        // Verificar si hay datos en la tabla
        const tableBody = document.querySelector('tbody');
        if (tableBody && tableBody.children.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center">No hay clientes registrados</td></tr>';
        }
    });
</script>
</body>
</html>
