        const menuStructure = {
            main: `
                
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li class="separator"></li>
                    <li><a href="#" class="bold">Explorar cursos</a></li>
                    <li><a href="#" onclick="toggleSubMenu('development')" class="with-arrow">Desarrollo <span class="arrow">→</span></a></li>
                    <li><a href="#" onclick="toggleSubMenu('design')" class="with-arrow">Diseño <span class="arrow">→</span></a></li>
                    <li><a href="#" onclick="toggleSubMenu('marketing')" class="with-arrow">Marketing <span class="arrow">→</span></a></li>
                    <li><a href="#" onclick="toggleSubMenu('business')" class="with-arrow">Negocios <span class="arrow">→</span></a></li>
                    <li class="separator"></li>
                    <li><a href="/PAGES/sobrenosotros.html">Sobre nosotros</a></li>
                    <li><a href="/PAGES/IniciarSesion.html">Iniciar Sesión</a></li>
                    <li><a href="/PAGES/Registrarse.html">Registrarme</a></li>
                </ul>
            `,
            explore: `
                <button class="back-btn" onclick="showMainMenu()">← Volver</button>
                <div class="explore-title">Explorar cursos</div>
                <ul>
                    <li><a href="#" onclick="toggleSubMenu('development')">Desarrollo</a></li>
                    <li><a href="#" onclick="toggleSubMenu('design')">Diseño</a></li>
                    <li><a href="#" onclick="toggleSubMenu('marketing')">Marketing</a></li>
                    <li><a href="#" onclick="toggleSubMenu('business')">Negocios</a></li>
                </ul>
            `,
            development: `
                <button class="back-btn" onclick="showMainMenu()">← Volver</button>
                <div class="explore-title">Desarrollo</div>
                <ul>
                    <li><a href="/cursos/web">Desarrollo Web</a></li>
                    <li><a href="/cursos/mobile">Desarrollo Móvil</a></li>
                    <li><a href="/cursos/javascript">JavaScript</a></li>
                </ul>
            `,
            design: `
                <button class="back-btn" onclick="showMainMenu()">← Volver</button>
                <div class="explore-title">Diseño</div>
                <ul>
                    <li><a href="/cursos/ux-ui">UX/UI Design</a></li>
                    <li><a href="/cursos/graphic-design">Diseño Gráfico</a></li>
                </ul>
            `,
            marketing: `
                <button class="back-btn" onclick="showMainMenu()">← Volver</button>
                <div class="explore-title">Marketing</div>
                <ul>
                    <li><a href="/cursos/digital-marketing">Marketing Digital</a></li>
                    <li><a href="/cursos/social-media">Social Media</a></li>
                </ul>
            `,
            business: `
                <button class="back-btn" onclick="showMainMenu()">← Volver</button>
                <div class="explore-title">Negocios</div>
                <ul>
                    <li><a href="/cursos/entrepreneurship">Emprendimiento</a></li>
                    <li><a href="/cursos/finance">Finanzas</a></li>
                </ul>
            `
        };
        
        function toggleMenu() {
            const menuIcon = document.querySelector('.menuIcon');
            const navbarMobile = document.querySelector('.navbarMobile');
            const overlay = document.querySelector('.overlay');
            
            menuIcon.classList.toggle('active');
            navbarMobile.classList.toggle('active');
            overlay.classList.toggle('active');
        
            if (navbarMobile.classList.contains('active')) {
                showMainMenu();
            }
        }
        
        function toggleSubMenu(menuType) {
            const navbarMobile = document.querySelector('.navbarMobile');
            navbarMobile.innerHTML = menuStructure[menuType] || menuStructure.main;
        }
        
        function showMainMenu() {
            toggleSubMenu('main');
        }
        
        // Event listener para cerrar el menú al hacer clic en el overlay
        document.querySelector('.overlay').addEventListener('click', toggleMenu);
       