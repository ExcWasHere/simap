import "./bootstrap";
import "./carousel";
import "./chart";
import "./download-excel";
import "./modal";
import "./table";
import "./upload-document";
import createLoaderAnimation from "./loader";

console.log('App.js loading...');

document.addEventListener("DOMContentLoaded", () => {
    console.log('DOM Content Loaded');
    createLoaderAnimation();
});