function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden'); // Alterna la clase 'hidden' para mostrar/ocultar la barra lateral

    // Si la barra lateral se está mostrando, asegúrate de que la sección de contactos esté visible
    if (!sidebar.classList.contains('hidden')) {
        showContacts();
    }
}

function showContacts() {
    var privacySettings = document.getElementById('privacy-settings');
    var chatSettings = document.getElementById('chat-settings');

    // Oculta las secciones de configuración de privacidad y chat
    privacySettings.style.display = 'none';
    chatSettings.style.display = 'none';

    // Asegúrate de que la lista de contactos esté visible
    var contactList = document.getElementById('contact-list');
    contactList.style.display = 'block';
}

// Aquí van tus funciones existentes
function toggleSettings() {
    var settings = document.getElementById('settings');
    settings.classList.toggle('hidden');
}

function showPrivacyOptions() {
    var privacyOptions = document.getElementById('privacy-options');
    privacyOptions.style.display = 'block';
}

function toggleMessageSettings() {
    var contactList = document.getElementById('contact-list');
    var privacySettings = document.getElementById('privacy-settings');
    var searchBar = document.getElementById('search-bar');
    if (contactList.style.display === 'none') {
        contactList.style.display = 'block';
        privacySettings.style.display = 'none';
        searchBar.style.display = 'flex';
    } else {
        contactList.style.display = 'none';
        privacySettings.style.display = 'flex';
        searchBar.style.display = 'none';
    }
}

function openChat() {
    var contactList = document.getElementById('contact-list');
    var chatSettings = document.getElementById('chat-settings');
    var searchBar = document.getElementById('search-bar');
    var settingsIcon = document.getElementById('settings-icon'); // Obtén el ícono de configuración
    contactList.style.display = 'none';
    chatSettings.style.display = 'flex';
    searchBar.style.display = 'none';

    // Oculta el ícono de configuración
    settingsIcon.style.display = 'none';
}

function toggleChatSettings() {
    var contactList = document.getElementById('contact-list');
    var chatSettings = document.getElementById('chat-settings');
    var searchBar = document.getElementById('search-bar');
    var settingsIcon = document.getElementById('settings-icon'); // Obtén el ícono de configuración
    if (contactList.style.display === 'none') {
        contactList.style.display = 'block';
        chatSettings.style.display = 'none';
        searchBar.style.display = 'flex';
        // Muestra el ícono de configuración
        settingsIcon.style.display = 'block';
    } else {
        contactList.style.display = 'none';
        chatSettings.style.display = 'flex';
        searchBar.style.display = 'none';

        // Oculta el ícono de configuración
        settingsIcon.style.display = 'none';
    }
}
function showChatOptions(event) {
    event.stopPropagation(); // Evita el cierre inmediato
    var chatOptions = document.getElementById('chat-options');
    chatOptions.style.display = 'block'; // Muestra el menú
    chatOptions.style.left = event.pageX + 'px'; // Ajusta la posición en X
    chatOptions.style.top = event.pageY + 'px'; // Ajusta la posición en Y
}


function deleteConversation() {
    var chatMessages = document.getElementById('chat-messages');
    chatMessages.innerHTML = ''; // Elimina todos los mensajes
    hideChatOptions(); // Oculta el menú de opciones
}

function hideChatOptions() {
    var chatOptions = document.getElementById('chat-options');
    chatOptions.style.display = 'none';
}


document.addEventListener('click', function(event) {
    var chatOptions = document.getElementById('chat-options');
    if (chatOptions.style.display === 'block' && !chatOptions.contains(event.target)) {
        chatOptions.style.display = 'none'; // Cierra el menú si se hace clic fuera
    }
});


//Settings 
function toggleSettingsDropdown() {
    var settingsDropdown = document.getElementById("settings-dropdown");
    if (settingsDropdown.style.display === "block") {
        settingsDropdown.style.display = "none";
    } else {
        settingsDropdown.style.display = "block";
    }
}

window.onclick = function(event) {
    var settingsDropdown = document.getElementById("settings-dropdown");
    if (!event.target.matches('.fa-cog')) {
        if (settingsDropdown.style.display === "block") {
            settingsDropdown.style.display = "none";
        }
    }
}

//Profile

function toggleDropdown() {
    var dropdown = document.getElementById("userDropdown");
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
}

document.addEventListener('click', function(event) {
    var isClickInside = document.querySelector('.user-menu').contains(event.target);
    var dropdown = document.getElementById("userDropdown");

    if (!isClickInside) {
        dropdown.style.display = "none";
    }
});
