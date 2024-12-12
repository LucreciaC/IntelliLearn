document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault(); // Evitar el envío tradicional del formulario

    // Mostrar el indicador de carga
    const loadingIndicator = document.getElementById('loading');
    loadingIndicator.style.display = 'block';

    const formData = new FormData(this); // Crear un objeto FormData con los datos del formulario

    fetch('http://localhost/Intellilearn/PHP/iniciarSesion.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        loadingIndicator.style.display = 'none'; // Ocultar el indicador de carga
        if (data === "Inicio de sesión exitoso") {
            window.location.href = 'http://localhost/Intellilearn/HTML/lecciones.html';
        } else {
            alert(data);
        }
    })
    .catch(error => {
        loadingIndicator.style.display = 'none'; // Ocultar el indicador de carga en caso de error
        console.error('Error:', error);
    });
});
