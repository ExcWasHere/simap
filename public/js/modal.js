export const open_modal = (id_modal, active_tab = null) => {
    const modal = document.getElementById(id_modal);
    modal.classList.remove("hidden");
    modal.classList.add("modal-active");
    document.body.style.overflow = "hidden";

    if (active_tab) {
        const form = modal.querySelector("#formulir-tambah-data");
        if (form) {
            const entity_type_input = form.querySelector("#entity_type");
            if (entity_type_input) entity_type_input.value = active_tab;

            modal.querySelectorAll(".tab-content").forEach((content) => {
                content.classList.add("hidden");
                content.classList.remove("active");
            });

            modal.querySelectorAll(".tab-button").forEach((btn) => {
                btn.classList.remove("active", "border-b-2", "border-blue-500", "text-blue-600");
                btn.classList.add("text-gray-500");
            });

            const active_content = modal.querySelector(`#${active_tab}-content`);
            const active_button = modal.querySelector(`[data-tab="${active_tab}"]`);

            if (active_content) active_content.classList.remove("hidden"), active_content.classList.add("active");
            if (active_button) active_button.classList.add("border-b-2", "border-blue-500", "text-blue-600"), active_button.classList.remove("text-gray-500");
        }
    }
};

export const close_modal = (id_modal) => {
    const modal = document.getElementById(id_modal);
    modal.classList.remove("modal-active");
    modal.classList.add("hidden");
    document.body.style.overflow = "auto";
};

window.open_modal = open_modal;
window.close_modal = close_modal;

document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            const activeModals = document.querySelectorAll(".modal-active");
            activeModals.forEach((modal) => close_modal(modal.id));
        }
    });

    ["modal_detail", "modal_tambah"].forEach((id_modal) => {
        const modal = document.getElementById(id_modal);
        if (!modal) return;

        const tab_button = modal.querySelectorAll(".tab-button");
        const tab_content = modal.querySelectorAll(".tab-content");

        tab_button.forEach((button) => {
            button.addEventListener("click", () => {
                tab_button.forEach((btn) => {
                    btn.classList.remove( "active", "border-b-2", "border-blue-500", "text-blue-600");
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

document.addEventListener("modal-activated", function () {
    init_tab_handlers();
});