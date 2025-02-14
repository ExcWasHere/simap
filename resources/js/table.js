document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".dropdown-container")) {
            document.querySelectorAll(".dropdown-menu").forEach((menu) => menu.classList.add("hidden"));
        }
    });

    document.querySelectorAll(".dropdown-trigger").forEach((trigger) => {
        trigger.addEventListener("click", function (e) {
            e.stopPropagation();
            const menu = this.nextElementSibling;
            const isHidden = menu.classList.contains("hidden");

            document.querySelectorAll(".dropdown-menu").forEach((otherMenu) => {
                if (otherMenu !== menu) otherMenu.classList.add("hidden");
            });

            isHidden ? menu.classList.remove("hidden") : menu.classList.add("hidden");
        });
    });

    document.querySelectorAll(".delete-btn").forEach((btn) => {
        btn.addEventListener("click", async function (e) {
            e.preventDefault();
            e.stopPropagation();

            const id = this.dataset.id;
            if (!id) {
                console.error("No ID found for delete button");
                return;
            }

            const section = window.location.pathname.split("/")[1];
            const willDelete = confirm("Apakah Anda yakin ingin menghapus item ini?");

            if (!willDelete) return;

            try {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                console.log("CSRF Token:", token);

                this.innerHTML = '<i class="fas fa-spinner fa-spin w-4"></i>';
                this.disabled = true;

                const encodedId = id.split('/').map(part => encodeURIComponent(part)).join('/');
                console.log('Encoded ID:', encodedId);
                console.log('Delete URL:', `/${section}/${encodedId}`);

                const response = await fetch(`/${section}/${encodedId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": token,
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                        "X-HTTP-Method-Override": "DELETE"
                    },
                    credentials: 'same-origin'
                });

                console.log("Response status:", response.status);
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error("Error response:", errorText);
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log("Response data:", data);

                if (data.success) {
                    const row = this.closest("tr");
                    if (!row) {
                        console.error("Could not find table row to delete");
                        window.location.reload();
                        return;
                    }

                    try {
                        row.style.backgroundColor = "#fee2e2";
                        row.style.transition = "all 0.5s ease";
                        await new Promise(resolve => setTimeout(resolve, 100));
                        row.style.opacity = "0";
                        await new Promise(resolve => setTimeout(resolve, 500));
                        row.remove();
                        
                        const notification = document.createElement("div");
                        notification.className = "fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-500 transform translate-y-0";
                        notification.innerHTML = '<div class="flex items-center gap-2"><i class="fas fa-check-circle"></i> Data berhasil dihapus</div>';
                        document.body.appendChild(notification);

                        setTimeout(() => {
                            notification.style.opacity = "0";
                            setTimeout(() => notification.remove(), 500);
                        }, 3000);
                        
                        if (document.contains(row)) window.location.reload();
                    } catch (error) {
                        console.error("Error during row deletion animation:", error);
                        window.location.reload();
                    }
                } else {
                    throw new Error(data.message || "Terjadi kesalahan saat menghapus data");
                }
            } catch (error) {
                console.error("Error:", error);
                this.innerHTML = '<i class="fas fa-trash-alt w-4"></i> Hapus';
                this.disabled = false;

                const notification = document.createElement("div");
                notification.className = "fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-500 transform translate-y-0";
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