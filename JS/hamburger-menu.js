function toggleMenu() {
    // Cambiar la visibilidad del menú
    document.getElementById('navbarMobile').classList.toggle('active');
    document.getElementById('overlay').classList.toggle('active');
}

function showSubMenu(menuId) {
    // Ocultar todos los submenús
    const subMenus = document.querySelectorAll('.navbarMobile');
    subMenus.forEach(menu => {
        if (menu.id !== 'navbarMobile') {
            menu.style.display = 'none'; // Ocultar submenús
        }
    });
    // Mostrar el submenú seleccionado
    document.getElementById(menuId).style.display = 'block';
}

function showMainMenu() {
    // Mostrar el menú principal
    document.getElementById('navbarMobile').style.display = 'block';
    const subMenus = document.querySelectorAll('.navbarMobile');
    subMenus.forEach(menu => {
        if (menu.id !== 'navbarMobile') {
            menu.style.display = 'none'; // Ocultar submenús
        }
    });
}
