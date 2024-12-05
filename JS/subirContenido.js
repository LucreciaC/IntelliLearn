document.addEventListener('DOMContentLoaded', function () {
    const createButton = document.getElementById('createButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const videoOption = document.querySelector('.video-option');
    const videoUpload = document.getElementById('videoUpload');

    // Mostrar/ocultar el menú desplegable
    createButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');
    });

    // Abrir selector de archivos al hacer clic en VIDEO
    videoOption.addEventListener('click', function () {
        videoUpload.click();
    });

    // Manejar el archivo seleccionado
    videoUpload.addEventListener('change', function () {
        const file = videoUpload.files[0];
        if (file) {
            alert(`Has seleccionado el video: ${file.name}`);
            // Aquí puedes manejar el archivo, como subirlo al servidor
        }
    });
});





