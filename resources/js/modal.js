export function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

export function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
}

window.openModal = openModal;
window.closeModal = closeModal;

document.addEventListener('DOMContentLoaded', function() {
    ['modalDetail', 'modalTambah'].forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        const tabButtons = modal.querySelectorAll('.tab-btn');
        const tabContents = modal.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabButtons.forEach(btn => {
                    btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
                    btn.classList.add('text-gray-500');
                });
                tabContents.forEach(content => content.classList.add('hidden'));

                button.classList.add('active', 'border-blue-500', 'text-blue-600');
                button.classList.remove('text-gray-500');
                
                const tabId = button.getAttribute('data-tab');
                modal.querySelector(`#${tabId}-content`).classList.remove('hidden');
            });
        });
    });
});