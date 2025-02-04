import { Chart } from "chart.js/auto";

document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById("main-chart").getContext("2d");
    let main_chart = null;
    let chart_data = null;

    const buat_chart = (type, data) => {
        if (main_chart) main_chart.destroy();
        main_chart = new Chart(ctx, {
            type: type === "area" ? "line" : type,
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                interaction: {
                    intersect: false,
                    mode: "index",
                },
                layout: {
                    padding: {
                        top: 20,
                        right: 20,
                        bottom: 20,
                        left: 20
                    }
                },
                plugins: {
                    legend: {
                        position: "top",
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                        },
                    },
                    tooltip: {
                        mode: "index",
                        intersect: false,
                        backgroundColor: "rgba(255, 255, 255, 0.9)",
                        titleColor: "#000",
                        bodyColor: "#666",
                        borderColor: "#ddd",
                        borderWidth: 1,
                        padding: 10,
                        boxPadding: 4,
                    },
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                        },
                        grid: {
                            borderDash: [2, 2],
                        },
                    },
                },
                elements: {
                    line: {
                        tension: 0.4,
                    },
                    point: {
                        radius: 4,
                        hitRadius: 10,
                        hoverRadius: 6,
                    },
                },
            },
        });
    }

    const perbarui_statistik = (stats) => {
        document.getElementById("total_dokumen").textContent = stats.total_dokumen.toLocaleString();
        document.getElementById("pertumbuhan").textContent = `${stats.pertumbuhan > 0 ? "+" : ""}${stats.pertumbuhan}%`;
        document.getElementById("average_per_month").textContent = stats.average_per_month.toLocaleString();

        const statistik_pertumbuhan = document.getElementById("pertumbuhan");
        if (stats.pertumbuhan > 0) {
            statistik_pertumbuhan.classList.add("text-green-600");
        } else if (stats.pertumbuhan < 0) {
            statistik_pertumbuhan.classList.add("text-red-600");
        }
    }

    const perbarui_chart = () => {
        const kategori_yang_dipilih = document.querySelector('select[name="category"]').value;
        const tipe_yang_dipilih = document.querySelector('select[name="chart-type"]').value;

        if (!chart_data) return;

        const dataset_terbarukan = chart_data.datasets.filter((dataset) =>
            kategori_yang_dipilih === "all" ||
            dataset.label.toLowerCase() === kategori_yang_dipilih,
        ).map((dataset) => ({
            ...dataset,
            fill: tipe_yang_dipilih === "area",
        }));

        buat_chart(tipe_yang_dipilih, {
            labels: chart_data.labels,
            datasets: dataset_terbarukan,
        });
    }

    const fetch_chart_data = () => {
        const range = document.querySelector('select[name="date-range"]').value;
        const chartElement = document.getElementById("main-chart");
        const dataUrl = chartElement.dataset.url;
        
        if (!dataUrl) {
            console.error("Chart data URL not provided");
            return;
        }

        const url = new URL(dataUrl);
        url.searchParams.append("range", range);

        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                chart_data = data;
                perbarui_chart();
                perbarui_statistik(data.stats);
            })
            .catch((error) => {
                console.error("Error fetching chart data:", error);
            });
    }

    document.querySelector('select[name="chart-type"]').value = "line";
    document.querySelector('select[name="date-range"]').value = "7";

    fetch_chart_data();

    document.querySelector('select[name="chart-type"]').addEventListener("change", perbarui_chart);
    document.querySelector('select[name="category"]').addEventListener("change", perbarui_chart);
    document.querySelector('select[name="date-range"]').addEventListener("change", fetch_chart_data);
    
    document.querySelector("button:has(i.fa-expand)").addEventListener("click", () => {
        const chart_container = document.getElementById("main-chart").parentElement;
        document.fullscreenElement ? document.exitFullscreen() : chart_container.requestFullscreen();
    });
});