import "./bootstrap";
import "./carousel";
import "./chart";
import "./download-excel";
import "./modal";
import "./table";
import "./upload-document";
import createLoaderAnimation from "./loader";

document.addEventListener("DOMContentLoaded", () => {
    // Hamburger Menu
    const mobile_menu_button = document.getElementById("mobile-menu-button");
    const mobile_menu = document.getElementById("mobile-menu");

    console.log('Mobile menu setup:', { 
        button: mobile_menu_button, 
        menu: mobile_menu 
    });

    mobile_menu_button.addEventListener("click", () => {
        console.log('Mobile menu button clicked');
        mobile_menu.classList.toggle("hidden");
        mobile_menu.classList.toggle("flex");
        console.log('Classes after toggle:', mobile_menu.classList.toString());
    });

    // Loader
    createLoaderAnimation();
});