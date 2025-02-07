@props(['reference_id', 'section', 'module_type'])

<section
    id="modal-upload"
    class="fixed z-50 inset-0 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
    style="display: none"
>
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <span class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <article class="px-8 py-4">
                <span class="cursor-default flex items-center justify-between">
                    <h3 class="text-2xl font-semibold text-gray-800">Unggah Dokumen Baru</h3>
                    <i class="close-modal fa-solid fa-x cursor-pointer text-gray-400 hover:text-gray-500"></i>
                </span>
                <h5 class="mt-1 cursor-default text-left text-sm text-gray-500">
                    Unggah dokumen PDF untuk melengkapi data.
                </h5>
                @if (session('success'))
                    <div class="mt-6 flex items-center text-left rounded-lg p-4 bg-green-50">
                        <i class="fa-solid fa-circle-check text-sm text-green-400"></i>
                        <h5 class="ml-3 text-sm font-medium text-green-800">{{ session('success') }}</h5>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mt-6 text-left rounded-lg p-4 bg-red-50">
                        <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @php
                    $reference_param = match ($section) {
                        'intelijen' => 'no_nhi',
                        'monitoring' => 'id',
                        'penindakan' => 'no_sbp',
                        'penyidikan' => 'no_spdp',
                        default => 'id',
                    };
                    $upload_route = match ($section) {
                        'intelijen' => 'intelijen.upload.dokumen',
                        'monitoring' => 'monitoring.upload.dokumen',
                        'penindakan' => 'penindakan.upload.dokumen',
                        'penyidikan' => 'penyidikan.upload.dokumen',
                        default => 'intelijen.upload.dokumen',
                    };
                @endphp
                <form
                    action="{{ route($upload_route, [$reference_param => $reference_id]) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-8 py-6 text-left"
                >
                    @csrf
                    <fieldset>
                        <label for="tipe" class="text-sm font-medium text-gray-700">
                            Tipe Dokumen <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="tipe"
                            id="tipe"
                            class="appearance-none w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 lg:text-sm"
                            required
                        >
                            <option>Pilih Tipe Dokumen</option>
                            @switch($module_type)
                                @case('intelijen')
                                    <option value="ST-I">ST-I</option>
                                    <option value="LPTI">LPTI</option>
                                    <option value="LPPI">LPPI</option>
                                    <option value="LKAI">LKAI</option>
                                    <option value="NHI">NHI</option>
                                    <option value="NI">NI</option>
                                @break
                                @case('penyidikan')
                                    <option value="LK">LK</option>
                                    <option value="SPTP">SPTP</option>
                                    <option value="SPDP">SPDP</option>
                                    <option value="TAP SITA">TAP SITA</option>
                                    <option value="P2I">P2I</option>
                                @break
                                @case('monitoring')
                                    <option value="KEP-BDN">KEP-BDN</option>
                                    <option value="KEP-BMN">KEP-BMN</option>
                                    <option value="KEP-UR">KEP-UR</option>
                                    <option value="STCK">STCK</option>
                                @break
                                @case('penindakan')
                                    <option value="PRIN">PRIN</option>
                                    <option value="ST">ST</option>
                                    <option value="BA-Pemeriksaan">BA-Pemeriksaan</option>
                                    <option value="BA-Penegahan">BA-Penegahan</option>
                                    <option value="BAST">BAST</option>
                                    <option value="BA-Dokumentasi">BA-Dokumentasi</option>
                                    <option value="BA-Pencacahan">BA-Pencacahan</option>
                                    <option value="BA-Penyegelan">BA-Penyegelan</option>
                                    <option value="SBP">SBP</option>
                                    <option value="LPHP">LPHP</option>
                                    <option value="LP/LP1">LP/LP1</option>
                                    <option value="LPP">LPP</option>
                                    <option value="LPF">LPF</option>
                                    <option value="SPLIT">SPLIT</option>
                                    <option value="LHP">LHP</option>
                                    <option value="LRP">LRP</option>
                                @break
                            @endswitch
                        </select>
                    </fieldset>
                    @include('shared.forms.textarea', [
                        'name' => 'deskripsi',
                        'id' => 'deskripsi',
                        'label' => 'Deskripsi',
                        'rows' => 4,
                        'placeholder' => 'Masukkan deskripsi dokumen',
                        'required' => true,
                    ])
                    @include('components.unggah-dokumen.unggah-berkas-pdf')
                    <span class="flex w-full justify-end">
                        <button
                            type="submit"
                            id="upload-button"
                            class="cursor-pointer rounded-lg px-6 py-2.5 text-sm font-semibold transition-all duration-200 ease-in-out shadow-sm bg-blue-600 text-white hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <h5 id="button-text">Unggah Dokumen</h5>
                        </button>
                    </span>
                </form>
            </article>
        </div>
    </div>
</section>