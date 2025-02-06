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

    mobile_menu_button.addEventListener("click", () => {
        mobile_menu.classList.toggle("hidden");
        mobile_menu.classList.toggle("flex");
    });

    // Loader
    createLoaderAnimation();
});