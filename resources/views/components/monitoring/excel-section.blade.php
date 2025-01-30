<figure
    class="flex flex-col justify-between overflow-hidden p-6 rounded-lg shadow-md transform transition-all duration-300 bg-slate-50 hover:bg-slate-100">
    <figcaption class="flex items-center gap-4 mb-4">
        <i class="fas fa-file-excel p-3 rounded-lg text-2xl bg-purple-100 text-emerald-600"></i>
        <div class="cursor-default">
            <h3 class="text-lg font-semibold text-gray-900">Data Excel</h3>
            <h5 class="text-sm text-gray-600">Unduh dan kelola data dalam format Excel</h5>
        </div>
    </figcaption>
    <div class="space-y-4 mb-4">
        @include('shared.forms.radio-input', [
    'name' => 'data-excel',
    'id' => 'semua-data',
    'label' => 'Semua Data',
    'checked' => true
])

        @include('shared.forms.radio-input', [
    'name' => 'data-excel',
    'id' => 'data-per-bulan',
    'label' => 'Data Per Bulan'
])

        @include('shared.forms.radio-input', [
    'name' => 'data-excel',
    'id' => 'rekap-tahunan',
    'label' => 'Rekap Tahunan'
])
    </div>
    <button id="download-excel-btn"
        class="mt-4 cursor-pointer w-full py-3 rounded-lg transition-colors bg-emerald-600 text-emerald-50 hover:bg-emerald-500">
        Unduh Excel
    </button>
</figure>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radioButtons = document.querySelectorAll('input[name="data-excel"]');
        const downloadBtn = document.getElementById('download-excel-btn');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.checked) {
                    downloadBtn.classList.remove('cursor-not-allowed', 'opacity-50');
                    downloadBtn.removeAttribute('disabled');
                }
            });
        });

        downloadBtn.addEventListener('click', async function (e) {
            e.preventDefault();

            const selectedOption = document.querySelector('input[name="data-excel"]:checked').id;
            const downloadBtn = this;

            downloadBtn.disabled = true;
            downloadBtn.classList.add('cursor-not-allowed', 'opacity-50');
            downloadBtn.textContent = 'Mengunduh...';

            try {
                const response = await fetch(`/monitoring/export/${selectedOption}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    }
                });

                if (response.ok) {
                    const blob = await response.blob();
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `monitoring-${selectedOption}.xlsx`;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                } else {
                    throw new Error('Export failed');
                }

                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `monitoring-bhp-${selectedOption}-${new Date().toISOString().split('T')[0]}.xlsx`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            } catch (error) {
                console.error('Download error:', error);
                alert('Gagal mengunduh file Excel. Silahkan coba lagi.');
            } finally {
                downloadBtn.disabled = false;
                downloadBtn.classList.remove('cursor-not-allowed', 'opacity-50');
                downloadBtn.textContent = 'Unduh Excel';
            }
        });
    });

</script>