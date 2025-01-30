export const open_modal = (id_modal, activeTab = null) => {
    const modal = document.getElementById(id_modal);
    modal.classList.remove("hidden");
    modal.classList.add("modal-active");
    document.body.style.overflow = "hidden";

    if (activeTab) {
        const form = modal.querySelector('#formulir-tambah-data');
        if (form) {
            const entityTypeInput = form.querySelector('#entity_type');
            if (entityTypeInput) {
                entityTypeInput.value = activeTab;
            }

            // Hide all tab contents and deactivate all tab buttons
            modal.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
            modal.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active', 'border-b-2', 'border-blue-500', 'text-blue-600');
                btn.classList.add('text-gray-500');
            });

            // Show active tab content and activate its button
            const activeContent = modal.querySelector(`#${activeTab}-content`);
            const activeButton = modal.querySelector(`[data-tab="${activeTab}"]`);
            if (activeContent) {
                activeContent.classList.remove('hidden');
                activeContent.classList.add('active');
            }
            if (activeButton) {
                activeButton.classList.add('border-b-2', 'border-blue-500', 'text-blue-600');
                activeButton.classList.remove('text-gray-500');
            }
        }
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
                // Update tab buttons
                tab_button.forEach(btn => {
                    btn.classList.remove("active", "border-b-2", "border-blue-500", "text-blue-600");
                    btn.classList.add("text-gray-500");
                });
        
                // Update tab contents
                tab_content.forEach(content => {
                    content.classList.add("hidden");
                    content.classList.remove("active");
                });
        
                // Activate clicked tab
                button.classList.add("border-b-2", "border-blue-500", "text-blue-600");
                button.classList.remove("text-gray-500");
                
                // Show corresponding content
                const data_tab = button.getAttribute("data-tab");
                const activeContent = modal.querySelector(`#${data_tab}-content`);
                if (activeContent) {
                    activeContent.classList.remove("hidden");
                    activeContent.classList.add("active");
                }

                // Update form state
                const form = modal.querySelector('#formulir-tambah-data');
                if (form) {
                    const entityTypeInput = form.querySelector('#entity_type');
                    if (entityTypeInput) {
                        entityTypeInput.value = data_tab;
                    }
                }
            });
        });
    });
});

document.addEventListener('modal-activated', function(e) {
    initTabHandlers();
});