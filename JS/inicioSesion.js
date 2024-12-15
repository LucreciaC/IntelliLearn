document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita el envío tradicional del formulario

    const formData = new FormData(this); // Captura los datos del formulario
    const loadingIndicator = document.getElementById('loading');
    loadingIndicator.style.display = 'block'; // Muestra el indicador de carga

    fetch('http://localhost/IntelliLearn/PHP/iniciarSesion.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        loadingIndicator.style.display = 'none'; // Ocultar indicador de carga
        if (data.trim() === "Inicio de sesión exitoso") {
            // Redirigir al usuario si el inicio fue exitoso
            window.location.href = 'http://localhost/IntelliLearn/HTML/lecciones.html';
        } else {
            // Mostrar error
            alert(data);
        }
    })
    .catch(error => {
        loadingIndicator.style.display = 'none';
        console.error("Error en la petición:", error);
        alert("Ocurrió un error al procesar la solicitud.");
    });
});
