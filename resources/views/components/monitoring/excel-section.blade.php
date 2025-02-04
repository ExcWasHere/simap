<figure class="flex flex-col justify-between overflow-hidden p-6 rounded-lg shadow-md transform transition-all duration-300 bg-slate-50 hover:bg-slate-100">
    <figcaption class="flex items-center gap-4 mb-4">
        <i class="fas fa-file-excel p-3 rounded-lg text-2xl bg-purple-100 text-emerald-600"></i>
        <div class="cursor-default">
            <h3 class="text-lg font-semibold text-gray-900">Data Excel</h3>
            <h5 class="text-sm text-gray-600">Unduh dan kelola data dalam format Excel</h5>
        </div>
    </figcaption>
    <div class="space-y-4 mb-4">
        @include('shared.forms.radio', [
            'name' => 'data-excel',
            'id' => 'semua-data',
            'label' => 'Semua Data',
            'checked' => true,
        ])
        @include('shared.forms.radio', [
            'name' => 'data-excel',
            'id' => 'data-per-bulan',
            'label' => 'Data Per Bulan',
        ])
        @include('shared.forms.radio', [
            'name' => 'data-excel',
            'id' => 'rekap-tahunan',
            'label' => 'Rekap Tahunan',
        ])
    </div>
    <button
        id="tombol-unduh-excel"
        class="mt-4 cursor-pointer w-full py-3 rounded-lg transition-colors bg-emerald-600 text-emerald-50 hover:bg-emerald-500"
    >
        Unduh Excel
    </button>
</figure>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tombol_radio = document.querySelectorAll('input[name="data-excel"]');
        const tombol_unduh = document.getElementById('tombol-unduh-excel');

        tombol_radio.forEach(radio => {
            radio.addEventListener('change', () => {
                if (this.checked) {
                    tombol_unduh.classList.remove('cursor-not-allowed', 'opacity-50');
                    tombol_unduh.removeAttribute('disabled');
                }
            });
        });

        tombol_unduh.addEventListener('click', async function (e) {
            e.preventDefault();

            const opsi_yang_dipilih = document.querySelector('input[name="data-excel"]:checked').id;
            const tombol_unduh = this;

            tombol_unduh.disabled = true;
            tombol_unduh.classList.add('cursor-not-allowed', 'opacity-50');
            tombol_unduh.textContent = 'Mengunduh...';

            try {
                const response = await fetch(`/monitoring/export/${opsi_yang_dipilih}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error with status: ${response.status}.`);
                }

                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('spreadsheetml.sheet')) {
                    throw new Error('Invalid file format received');
                }

                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `monitoring-bhp-${opsi_yang_dipilih}-${new Date().toISOString().split('T')[0]}.xlsx`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            } catch (error) {
                console.error('Download error:', error);
                alert('Gagal mengunduh berkas Excel, silahkan coba lagi.');
            } finally {
                tombol_unduh.disabled = false;
                tombol_unduh.classList.remove('cursor-not-allowed', 'opacity-50');
                tombol_unduh.textContent = 'Unduh Excel';
            }
        });
    });
</script>