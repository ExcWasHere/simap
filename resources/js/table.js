document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".dropdown-container")) {
            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                menu.classList.add("hidden");
            });
        }
    });

    document.querySelectorAll(".dropdown-trigger").forEach((trigger) => {
        trigger.addEventListener("click", function (e) {
            e.stopPropagation();
            const menu = this.nextElementSibling;
            const isHidden = menu.classList.contains("hidden");

            document.querySelectorAll(".dropdown-menu").forEach((otherMenu) => {
                if (otherMenu !== menu) {
                    otherMenu.classList.add("hidden");
                }
            });

            if (isHidden) {
                menu.classList.remove("hidden");
            } else {
                menu.classList.add("hidden");
            }
        });
    });

    document.querySelectorAll(".delete-btn").forEach((btn) => {
        btn.addEventListener("click", async function (e) {
            e.preventDefault();
            e.stopPropagation();

            const id = this.dataset.id;
            const section = window.location.pathname.split("/")[1];

            const willDelete = confirm(
                "Apakah Anda yakin ingin menghapus item ini?",
            );

            if (!willDelete) {
                return;
            }

            try {
                const token = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");
                console.log("CSRF Token:", token);

                this.innerHTML =
                    '<i class="fas fa-spinner fa-spin w-4"></i> Menghapus...';
                this.disabled = true;

                const response = await fetch(`/${section}/${id}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": token,
                        Accept: "application/json",
                        "Content-Type": "application/json",
                    },
                });

                console.log("Response status:", response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log("Response data:", data);

                if (data.success) {
                    const row = this.closest("tr");
                    row.style.backgroundColor = "#fee2e2";
                    row.style.transition = "background-color 0.5s ease";

                    setTimeout(() => {
                        row.style.opacity = "0";
                        row.style.transition = "opacity 0.5s ease";

                        setTimeout(() => {
                            row.remove();

                            const notification = document.createElement("div");
                            notification.className =
                                "fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-500 transform translate-y-0";
                            notification.innerHTML =
                                '<div class="flex items-center gap-2"><i class="fas fa-check-circle"></i> Data berhasil dihapus</div>';
                            document.body.appendChild(notification);

                            setTimeout(() => {
                                notification.style.opacity = "0";
                                setTimeout(() => notification.remove(), 500);
                            }, 3000);
                        }, 500);
                    }, 100);
                } else {
                    throw new Error(
                        data.message || "Terjadi kesalahan saat menghapus data",
                    );
                }
            } catch (error) {
                console.error("Error:", error);
                this.innerHTML = '<i class="fas fa-trash-alt w-4"></i> Hapus';
                this.disabled = false;

                const notification = document.createElement("div");
                notification.className =
                    "fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-500 transform translate-y-0";
                notification.innerHTML = `<div class="flex items-center gap-2"><i class="fas fa-exclamation-circle"></i> ${error.message}</div>`;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.opacity = "0";
                    setTimeout(() => notification.remove(), 500);
                }, 3000);
            }
        });
    });
});