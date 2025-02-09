import { Carousel } from "./carousel";
import { OpenModal, CloseModal } from "./modal";
import gsap from "gsap";
import "./bootstrap";
import "./chart";
import "./download-excel";
import "./table";
import "./upload-document";

window.open_modal = OpenModal;
window.close_modal = CloseModal;

document.addEventListener("DOMContentLoaded", () => {
    // Carousel
    const carousel = new Carousel();
    window.addEventListener("unload", () => carousel.destroy());

    // Loader
    window.addEventListener("load", () => {
        if (sessionStorage.getItem("loaderShown")) {
            document.getElementById("loader").remove();
            gsap.set("main", { autoAlpha: 1 });
            return;
        }

        gsap.set("main", { autoAlpha: 0 });

        const loaderTimeline = gsap.timeline({
            defaults: { ease: "power2.inOut" },
            onComplete: () => {
                document.getElementById("loader").remove();
                sessionStorage.setItem("loaderShown", true);
            },
        });

        loaderTimeline.fromTo("#loader-logo", {
            scale: 0.5,
            opacity: 0,
            rotation: -180,
            },
            {
                duration: 1,
                scale: 1,
                opacity: 1,
                rotation: 0,
            })
            .to("#loader-logo", {
                duration: 0.5,
                scale: 0.8,
                yoyo: true,
                repeat: 1,
            })
            .to("#loader", {
                duration: 0.8,
                opacity: 0,
                y: "-100%",
            })
            .fromTo("main", {
                autoAlpha: 0,
                y: 20,
            },
            {
                duration: 0.8,
                autoAlpha: 1,
                y: 0,
            },
            "-=0.4",
        );
    });

    // Modal
    window.addEventListener("open-upload-modal", () => {
        document.getElementById("modal-upload").style.display = "block";
        document.body.style.overflow = "hidden";    
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") document.querySelectorAll(".modal-active").forEach((modal) => CloseModal(modal.id));
    });

    ["modal_detail", "modal_tambah"].forEach((id_modal) => {
        const modal = document.getElementById(id_modal);
        if (!modal) return;

        const tab_button = modal.querySelectorAll(".tab-button");
        const tab_content = modal.querySelectorAll(".tab-content");

        tab_button.forEach((button) => {
            button.addEventListener("click", () => {
                tab_button.forEach((btn) => {
                    btn.classList.remove("active", "border-b-2", "border-blue-500", "text-blue-600");
                    btn.classList.add("text-gray-500");
                });

                tab_content.forEach((content) => {
                    content.classList.add("hidden");
                    content.classList.remove("active");
                });

                button.classList.add("border-b-2", "border-blue-500", "text-blue-600");
                button.classList.remove("text-gray-500");

                const data_tab = button.getAttribute("data-tab");
                const active_content = modal.querySelector(`#${data_tab}-content`);

                if (active_content) active_content.classList.remove("hidden"), active_content.classList.add("active");

                const form = modal.querySelector("#formulir-tambah-data");
                if (form) {
                    const entity_type_input = form.querySelector("#entity_type");
                    if (entity_type_input) entity_type_input.value = data_tab;
                }
            });
        });
    });
});