document.addEventListener("DOMContentLoaded", () => {
    // Bouton Burger et lien des menus
    const button_menu = document.getElementById("btn-toggle-menu");
    const menu_liens = document.getElementById("menu-liens");
    // Clic Bouton et affichage/masquage menu
    button_menu.addEventListener("click", (e) => {
        e.preventDefault();
        menu_liens.classList.toggle("show-menu");
    });

});
