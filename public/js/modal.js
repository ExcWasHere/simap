export const open_modal = (id_modal) => {
    const modal = document.getElementById(id_modal);
    modal.classList.remove("hidden");
    modal.classList.add("modal-active");
    document.body.style.overflow = "hidden";

    const activeTab = modal.querySelector('.tab-button.active').getAttribute('data-tab');
    const form = modal.querySelector("#formulir-tambah-data");
    
    if (form) {
        form.querySelectorAll('input, textarea, select').forEach(field => {
            const parentSection = field.closest('.tab-content');
            if (parentSection) {
                field.required = parentSection.id === `${activeTab}-content` && field.hasAttribute('data-required');
            }
        });
    }
}

export const close_modal = (id_modal) => {
    const modal = document.getElementById(id_modal);
    modal.classList.remove("modal-active");
    modal.classList.add("hidden");
    document.body.style.overflow = "auto";
}

window.open_modal = open_modal;
window.close_modal = close_modal;

document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("keydown", function(event) {
        if (event.key === "Escape") {
            const activeModals = document.querySelectorAll(".modal-active");
            activeModals.forEach(modal => close_modal(modal.id));
        }
    });

    ["modal_detail", "modal_tambah"].forEach((id_modal) => {
        const modal = document.getElementById(id_modal);
        if (!modal) return;

        const tab_button = modal.querySelectorAll(".tab-button");
        const tab_content = modal.querySelectorAll(".tab-content");

        tab_button.forEach((button) => {
            button.addEventListener("click", () => {
                tab_button.forEach(btn => {
                    btn.classList.remove("active", "border-blue-500", "text-blue-600");
                    btn.classList.add("text-gray-500");
                });

                tab_content.forEach(content => content.classList.add("hidden"));

                button.classList.add("active", "border-blue-500", "text-blue-600");
                button.classList.remove("text-gray-500");
                
                const data_tab = button.getAttribute("data-tab");
                const activeContent = modal.querySelector(`#${data_tab}-content`);
                activeContent.classList.remove("hidden");

                const form = modal.querySelector("#formulir-tambah-data");
                if (form) {
                    const entityTypeInput = form.querySelector('#entity_type');
                    entityTypeInput.value = data_tab;

                    form.querySelectorAll('input, textarea, select').forEach(field => {
                        const parentSection = field.closest('.tab-content');
                        if (parentSection) {
                            field.required = parentSection.id === `${data_tab}-content` && field.hasAttribute('data-required');
                        }
                    });
                }
            });
        });
    });
});