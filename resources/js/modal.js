export const OpenModal = (id_modal, active_tab = null) => {
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

export const CloseModal = (id_modal) => {
    const modal = document.getElementById(id_modal);
    modal.classList.remove("modal-active");
    modal.classList.add("hidden");
    document.body.style.overflow = "auto";
};