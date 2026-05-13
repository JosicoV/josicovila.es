document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('toggle-sidebar');
    const searchInput = document.getElementById('blog-search-input'); // Nuevo
    const searchResultsContainer = document.getElementById('search-results'); // Nuevo
    
    const body = document.body;
    // const sidebar = document.getElementById('blog-sidebar'); // No se usa directamente aquí

    // Comprobar si todos los elementos necesarios existen
    if (!toggleButton || !body || !searchInput || !searchResultsContainer) {
        console.error("No se encontraron todos los elementos necesarios para el sidebar y/o buscador.");
        // Podrías querer deshabilitar la funcionalidad si falta algo,
        // pero por ahora solo mostramos el error.
        return;
    }

    // Función para actualizar el botón
    function updateToggleButton() {
        if (body.classList.contains('sidebar-hidden')) {
            toggleButton.innerHTML = '&gt;';
            toggleButton.title = "Mostrar menú";
        } else {
            toggleButton.innerHTML = '&lt;';
            toggleButton.title = "Ocultar menú";
        }
    }

    toggleButton.addEventListener('click', () => {
        body.classList.toggle('sidebar-hidden');
        updateToggleButton(); // Actualizar texto/icono del botón
        // Guardar estado en localStorage
        if (body.classList.contains('sidebar-hidden')) {
            localStorage.setItem('sidebarState', 'hidden');
        } else {
            localStorage.removeItem('sidebarState');
        }
    });

    // Estado inicial al cargar la página
    const isSmallScreen = window.innerWidth <= 768;
    if (isSmallScreen) {
        body.classList.add('sidebar-hidden');
        localStorage.removeItem('sidebarState');
    } else if (localStorage.getItem('sidebarState') === 'hidden') {
        body.classList.add('sidebar-hidden');
    }
    // Actualizar el botón al cargar la página
    updateToggleButton();

    // --- NUEVO: Lógica del Buscador AJAX ---
if (searchInput && searchResultsContainer) {
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.trim();

        if (searchTerm.length < 2) { // Buscar solo si hay al menos 2 caracteres
            searchResultsContainer.innerHTML = ''; // Limpiar resultados si es muy corto
            searchResultsContainer.style.display = 'none'; // Ocultar contenedor
            return;
        }

        // Hacer la petición AJAX
        fetch(`/api/BLOG_inc/includes/ajax.search.php?term=${encodeURIComponent(searchTerm)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(results => {
                searchResultsContainer.innerHTML = ''; // Limpiar resultados anteriores
                if (results.length > 0) {
                    const ul = document.createElement('ul');
                    results.forEach(post => {
                        const li = document.createElement('li');
                        const a = document.createElement('a');
                        a.href = `/blog/${post.slug}/`; // Usar URL amigable
                        a.textContent = post.title;
                        li.appendChild(a);
                        ul.appendChild(li);
                    });
                    searchResultsContainer.appendChild(ul);
                    searchResultsContainer.style.display = 'block'; // Mostrar contenedor
                } else {
                    searchResultsContainer.innerHTML = '<p>No se encontraron resultados.</p>';
                    searchResultsContainer.style.display = 'block'; // Mostrar mensaje
                }
            })
            .catch(error => {
                console.error('Error en la búsqueda AJAX:', error);
                searchResultsContainer.innerHTML = '<p>Error al buscar.</p>';
                searchResultsContainer.style.display = 'block';
            });
    });
}
// --- FIN NUEVO: Lógica del Buscador AJAX ---


});

