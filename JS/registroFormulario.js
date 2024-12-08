document.getElementById('registroFormulario').addEventListener('submit', function (e) {
    e.preventDefault(); // Evitar el envío tradicional del formulario

    const formData = new FormData(this); // Crear un objeto FormData con los datos del formulario

    fetch('guardar.php', { // Cambiar a la ruta de tu archivo PHP
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Procesar la respuesta como texto
    .then(data => {
        alert(data); // Mostrar el mensaje recibido del servidor
    })
    .catch(error => {
        console.error('Error:', error); // Manejar errores
    });
});
