document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-btn").forEach((button) => {
        button.addEventListener("click", async function () {
            const id = this.dataset.id;
            const section =
                window.location.pathname.split("/")[1] || "intelijen";

            try {
                const response = await fetch(`/${section}/${id}/edit`);
                if (!response.ok) throw new Error("Failed to fetch data");

                const data = await response.json();

                const editModal = document.getElementById("modal_edit");
                if (!editModal) {
                    throw new Error("Modal tidak ditemukan");
                }
                editModal.classList.remove("hidden");

                setTimeout(() => {
                    switch (section) {
                        case "intelijen":
                            const intelijenFields = {
                                edit_no_nhi: data.no_nhi,
                                edit_tanggal_nhi:
                                    data.tanggal_nhi.split(" ")[0],
                                edit_tempat: data.tempat,
                                edit_jenis_barang: data.jenis_barang,
                                edit_jumlah_barang: data.jumlah_barang,
                                edit_keterangan: data.keterangan || "",
                            };

                            Object.entries(intelijenFields).forEach(
                                ([id, value]) => {
                                    const element = document.getElementById(id);
                                    if (element) {
                                        element.value = value;
                                    } else {
                                        console.warn(
                                            `Element with id ${id} not found`,
                                        );
                                    }
                                },
                            );
                            break;

                        case "penyidikan":
                            const penyidikanFields = {
                                edit_no_spdp: data.no_spdp,
                                edit_tanggal_spdp:
                                    data.tanggal_spdp.split(" ")[0],
                                edit_pelaku: data.pelaku,
                                edit_intelijen_id: data.intelijen_id,
                                edit_keterangan: data.keterangan || "",
                            };

                            Object.entries(penyidikanFields).forEach(
                                ([id, value]) => {
                                    const element = document.getElementById(id);
                                    if (element) {
                                        element.value = value;
                                    } else {
                                        console.warn(
                                            `Element with id ${id} not found`,
                                        );
                                    }
                                },
                            );
                            break;

                        case "penindakan":
                            const penindakanFields = {
                                edit_no_sbp: data.no_sbp,
                                edit_tanggal_sbp:
                                    data.tanggal_sbp.split(" ")[0],
                                edit_penyidikan_id: data.penyidikan_id,
                                edit_lokasi_penindakan: data.lokasi_penindakan,
                                edit_uraian_bhp: data.uraian_bhp,
                                edit_jumlah: data.jumlah,
                                edit_kemasan: data.kemasan,
                                edit_perkiraan_nilai_barang:
                                    data.perkiraan_nilai_barang,
                                edit_potensi_kurang_bayar:
                                    data.potensi_kurang_bayar,
                            };

                            Object.entries(penindakanFields).forEach(
                                ([id, value]) => {
                                    const element = document.getElementById(id);
                                    if (element) {
                                        element.value = value;
                                    } else {
                                        console.warn(
                                            `Element with id ${id} not found`,
                                        );
                                    }
                                },
                            );
                            break;
                    }
                }, 100);
            } catch (error) {
                console.error("Error:", error);
                alert("Gagal mengambil data untuk diedit: " + error.message);
            }
        });
    });

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