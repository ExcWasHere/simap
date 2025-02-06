document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("modal-upload");
    const close_button = modal.querySelector(".close-modal");
    const file_input = document.getElementById("file");
    const selected_file = document.getElementById("selected-file");
    const drop_zone = file_input.closest(".border-dashed");
    const upload_button = document.getElementById("upload-button");
    const button_text = document.getElementById("button-text");
    const loading_spinner = document.getElementById("loading-spinner");
    const upload_state = document.getElementById("upload-state");
    const selected_file_state = document.getElementById("selected-file-state");
    const drag_over_state = document.getElementById("drag-over-state");
    const remove_file_button = document.getElementById("remove-file");
    const file_size_element = document.getElementById("file-size");
    const upload_progress = document.getElementById("upload-progress");
    const progress_bar = document.getElementById("progress-bar");
    const progress_percentage = document.getElementById("progress-percentage");

    // Show modal when upload button is clicked
    document
        .querySelectorAll('[data-modal-target="modal-upload"]')
        .forEach((button) => {
            button.addEventListener("click", () => {
                modal.style.display = "block";
            });
        });

    // Close modal when close button is clicked
    close_button.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Close modal when clicking outside
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

    function setUploadingState(isUploading) {
        upload_button.disabled = isUploading;
        button_text.textContent = isUploading ? "Mengunggah..." : "Upload Dokumen";
        loading_spinner.classList.toggle("!hidden", !isUploading);
        upload_button.classList.toggle("opacity-75", isUploading);
        upload_button.classList.toggle("cursor-not-allowed", isUploading);

        if (isUploading) {
            upload_progress.classList.remove("hidden");
        } else {
            upload_progress.classList.add("hidden");
            progress_bar.style.width = "0%";
            progress_percentage.textContent = "0%";
        }
    }

    function showUploadError(message) {
        const errorDiv = document.createElement("div");
        errorDiv.className =
            "fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-500 transform translate-y-0";
        errorDiv.innerHTML = `<div class="flex items-center gap-2"><i class="fas fa-exclamation-circle"></i> ${message}</div>`;
        document.body.appendChild(errorDiv);
        setTimeout(() => {
            errorDiv.style.opacity = "0";
            setTimeout(() => errorDiv.remove(), 500);
        }, 3000);
    }

    function showUploadSuccess(message) {
        const successDiv = document.createElement("div");
        successDiv.className =
            "fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-500 transform translate-y-0";
        successDiv.innerHTML = `<div class="flex items-center gap-2"><i class="fas fa-check-circle"></i> ${message}</div>`;
        document.body.appendChild(successDiv);
        setTimeout(() => {
            successDiv.style.opacity = "0";
            setTimeout(() => successDiv.remove(), 500);
        }, 3000);
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return "0 Bytes";
        const k = 1024;
        const sizes = ["Bytes", "KB", "MB", "GB"];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
    }

    function showupload_state() {
        upload_state.classList.remove("hidden");
        selected_file_state.classList.add("hidden");
    }

    function showselected_file_state() {
        upload_state.classList.add("hidden");
        selected_file_state.classList.remove("hidden");
    }

    function updateFileName(file) {
        if (file) {
            if (file.type !== "application/pdf") {
                showUploadError("Hanya file PDF yang diperbolehkan");
                file_input.value = "";
                showupload_state();
                return;
            }

            if (file.size > 10 * 1024 * 1024) {
                showUploadError("Ukuran file tidak boleh lebih dari 10MB");
                file_input.value = "";
                showupload_state();
                return;
            }

            selected_file.textContent = file.name;
            file_size_element.textContent = formatFileSize(file.size);
            showselected_file_state();
        } else {
            showupload_state();
        }
    }

    remove_file_button.addEventListener("click", function () {
        file_input.value = "";
        showupload_state();
    });

    drop_zone.addEventListener("dragover", function (e) {
        e.preventDefault();
        drag_over_state.classList.remove("hidden");
    });

    drop_zone.addEventListener("dragleave", function (e) {
        e.preventDefault();
        drag_over_state.classList.add("hidden");
    });

    drop_zone.addEventListener("drop", function (e) {
        e.preventDefault();
        drag_over_state.classList.add("hidden");

        const files = e.dataTransfer.files;
        if (files.length) {
            file_input.files = files;
            updateFileName(files[0]);
        }
    });

    file_input.addEventListener("change", function (e) {
        updateFileName(this.files[0]);
    });

    const form = document.querySelector("form");
    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        if (!file_input.files.length) {
            showUploadError("Silakan pilih file PDF terlebih dahulu");
            return;
        }

        const formData = new FormData(this);
        setUploadingState(true);

        try {
            const response = await fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                },
            });

            if (response.ok) {
                showUploadSuccess("File berhasil diunggah!");
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                const data = await response.json();
                showUploadError(
                    data.message || "Terjadi kesalahan saat mengunggah file.",
                );
            }
        } catch (error) {
            console.error("Upload error:", error);
            showUploadError("Terjadi kesalahan saat mengunggah file.");
        } finally {
            setUploadingState(false);
        }
    });
});