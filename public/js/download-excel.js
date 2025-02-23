document.addEventListener("DOMContentLoaded", () => {
    const tombol_radio = document.querySelectorAll('input[name="data-excel"]');
    const tombol_unduh = document.getElementById("tombol-unduh-excel");

    tombol_radio.forEach((radio) => {
        radio.addEventListener("change", () => {
            if (this.checked) {
                tombol_unduh.classList.remove("cursor-not-allowed", "opacity-50");
                tombol_unduh.removeAttribute("disabled");
            }
        });
    });

    tombol_unduh.addEventListener("click", async function (e) {
        e.preventDefault();

        const opsi_yang_dipilih = document.querySelector('input[name="data-excel"]:checked',).id;
        const tombol_unduh = this;

        tombol_unduh.disabled = true;
        tombol_unduh.classList.add("cursor-not-allowed", "opacity-50");
        tombol_unduh.textContent = "Mengunduh...";

        try {
            const response = await fetch(`/monitoring/ekspor/${opsi_yang_dipilih}`, {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    Accept: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                },
            });

            if (!response.ok) throw new Error(`HTTP error with status: ${response.status}.`);

            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("spreadsheetml.sheet")) throw new Error("Invalid file format received");

            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = `monitoring-bhp-${opsi_yang_dipilih}-${new Date().toISOString().split("T")[0]}.xlsx`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        } catch (error) {
            console.error("Mengalami kesalahan saat mengunduh: ", error);
            alert("Gagal mengunduh berkas Excel, silahkan coba lagi.");
        } finally {
            tombol_unduh.disabled = false;
            tombol_unduh.classList.remove("cursor-not-allowed", "opacity-50");
            tombol_unduh.textContent = "Unduh Excel";
        }
    });
});