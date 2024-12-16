document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(".search-container input");
    const searchButton = document.querySelector(".search-container img");

    // Diccionario con los nombres de los cursos y sus rutas
    const cursos = {
        "frontend": "http://localhost/Intellilearn/HTML/desarrolloFrontend.html",
        "backend": "http://localhost/Intellilearn/HTML/desarrolloBackend.html",
        "full stack": "http://localhost/Intellilearn/HTML/desarrolloFullStack.html",
        "diseño web": "http://localhost/Intellilearn/HTML/diseñoDiseñoWeb.html",
        "wordpress": "http://localhost/Intellilearn/HTML/diseñoWordPress.html",
        "pixel art": "http://localhost/Intellilearn/HTML/diseñoPixelArt.html",
        "marketing digital": "http://localhost/Intellilearn/HTML/marketingMarketingDigital.html",
        "youtube marketing": "http://localhost/Intellilearn/HTML/marketingYoutubeMarketing.html",
        "estrategias de marketing": "http://localhost/Intellilearn/HTML/marketingEstrategiasMarketing.html",
        "freelancing": "http://localhost/Intellilearn/HTML/negociosFreelancing.html",
        "liderazgo": "http://localhost/Intellilearn/HTML/negociosLiderazgo.html",
        "estrategias de negocios": "http://localhost/Intellilearn/HTML/negociosEstrategiasNegocios.html"
    };

    // Evento al hacer clic en la imagen de búsqueda
    searchButton.addEventListener("click", function () {
        const cursoBuscado = searchInput.value.trim().toLowerCase(); // Limpia y normaliza el input
        
        if (cursoBuscado in cursos) {
            // Si el curso existe, redirige al HTML correspondiente
            window.location.href = cursos[cursoBuscado];
        } else {
            // Mensaje de error si el curso no existe
            alert("El curso \"" + searchInput.value + "\" no existe. Por favor, intenta con otro nombre.");
        }
    });

    // Evento al presionar Enter en el input
    searchInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            searchButton.click(); // Simula clic en la imagen de búsqueda
        }
    });
});
