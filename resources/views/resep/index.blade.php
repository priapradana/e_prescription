<x-app-layout :title="'Input Resep'">

    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-primary">Formulir Resep</h2>
    </div>

    <form action="{{ route('resep.add') }}" method="POST">
        @csrf

        {{-- Form Pasien --}}
        <div class="bg-white p-6 rounded-md shadow mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Nama Pasien</label>
                    <input type="text" name="nama_pasien" required
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm" />
                </div>
                <div>
                    <label class="block text-sm font-medium">Tanggal Resep</label>
                    <input type="date" name="tanggal_resep" required value="{{ date('Y-m-d') }}"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm" />
                </div>
            </div>
        </div>

        {{-- Tab Selector & Content --}}
        <div class="mb-4">
            <button type="button" onclick="toggleAccordion('non')"
                class="w-full text-left px-4 py-2 border border-blue-500 text-blue-600 rounded-md flex justify-between items-center hover:bg-gray-50 transition">
                <span class="font-medium">Form Resep Non Racikan</span>
                <i id="iconNon" class="fas fa-chevron-down"></i>
            </button>
            <div id="accordionNon" class="mt-2 hidden">
                @include('resep.partials.non_racikan')
            </div>
        </div>

        <div class="mb-4">
            <button type="button" onclick="toggleAccordion('racik')"
                class="w-full text-left px-4 py-2 border border-green-600 text-green-600 rounded-md flex justify-between items-center hover:bg-gray-50 transition">
                <span class="font-medium">Form Resep Racikan</span>
                <i id="iconRacik" class="fas fa-chevron-down"></i>
            </button>
            <div id="accordionRacik" class="mt-2 hidden">
                @include('resep.partials.racikan')
            </div>
        </div>


        {{-- Output Items JSON --}}
        <input type="hidden" name="items" id="itemsJson">

        {{-- Tabel Daftar Resep --}}
        <div class="bg-white p-6 rounded-md shadow mt-6">
            <h3 class="text-md font-semibold mb-4 text-primary">Daftar Resep</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">Nama Racikan</th>
                            <th class="px-4 py-2 border">Obat</th>
                            <th class="px-4 py-2 border">Jumlah</th>
                            <th class="px-4 py-2 border">Signa</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="resepItems" class="text-gray-700">
                        <!-- Diisi oleh JS -->
                    </tbody>
                </table>
            </div>

            {{-- Tombol Simpan --}}
            <div class="mt-4 text-right">
                <button type="submit"
                    class="px-6 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">Simpan Resep</button>
            </div>
        </div>
    </form>

    <script>
        function toggleAccordion(type) {
            const panel = document.getElementById('accordion' + capitalize(type));
            const icon = document.getElementById('icon' + capitalize(type));
            const isOpen = !panel.classList.contains('hidden');

            // Optionally: auto-collapse other
            const other = type === 'non' ? 'racik' : 'non';
            document.getElementById('accordion' + capitalize(other)).classList.add('hidden');
            document.getElementById('icon' + capitalize(other)).classList.replace('fa-chevron-up', 'fa-chevron-down');

            if (isOpen) {
                panel.classList.add('hidden');
                icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
            } else {
                panel.classList.remove('hidden');
                icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
            }
        }

        function capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
    
        function showTab(tab) {
            document.getElementById('tabNon').classList.add('hidden');
            document.getElementById('tabRacik').classList.add('hidden');
            if (tab === 'non') document.getElementById('tabNon').classList.remove('hidden');
            else document.getElementById('tabRacik').classList.remove('hidden');
        }

        let semuaItem = [];

        // ========== NON RACIKAN ==========
        function tambahObatNonRacik() {
            const selectObat = document.getElementById('selectObat');
            const inputJumlah = document.getElementById('inputJumlah');
            const selectSigna = document.getElementById('selectSigna');

            const obatId = selectObat.value;
            const obatNama = selectObat.options[selectObat.selectedIndex]?.dataset.nama;
            const jumlah = inputJumlah.value;
            const signaId = selectSigna.value;
            const signaNama = selectSigna.options[selectSigna.selectedIndex]?.dataset.nama;

            if (!obatId || !jumlah || !signaId) {
                alert('Lengkapi semua isian obat, jumlah dan signa.');
                return;
            }

            semuaItem.push({
                obatId,
                obatNama,
                jumlah,
                signaId,
                signaNama,
                is_racikan_header: false,
                racikan_id: null,
                nama_racikan: null,
            });

            renderSemuaItem();
            selectObat.value = '';
            inputJumlah.value = '';
            selectSigna.value = '';
        }

        // ========== RACIKAN ==========
        let racikanTemp = [];
        let racikanId = generateRacikanId();

        function tambahObatRacikan() {
            const selectObat = document.getElementById('selectObatRacik');
            const inputJumlah = document.getElementById('inputJumlahRacik');

            const obatId = selectObat.value;
            const obatNama = selectObat.options[selectObat.selectedIndex]?.dataset.nama;
            const jumlah = inputJumlah.value;

            if (!obatId || !jumlah) {
                alert('Pilih obat dan jumlah terlebih dahulu');
                return;
            }

            racikanTemp.push({ obatId, obatNama, jumlah });
            renderObatRacikTemp();
            selectObat.value = '';
            inputJumlah.value = '';
        }

        function selesaikanRacikan() {
            const namaRacikan = document.getElementById('namaRacikan').value;
            const selectSigna = document.getElementById('selectSignaRacik');
            const signaId = selectSigna.value;
            const signaNama = selectSigna.options[selectSigna.selectedIndex]?.dataset.nama;

            if (!namaRacikan || !signaId || racikanTemp.length === 0) {
                alert('Lengkapi racikan, nama racikan, dan signa');
                return;
            }

            racikanTemp.forEach((item, index) => {
                semuaItem.push({
                    racikan_id: racikanId,
                    is_racikan_header: index === 0,
                    nama_racikan: namaRacikan,
                    signaId: signaId,
                    signaNama: signaNama,
                    obatId: item.obatId,
                    obatNama: item.obatNama,
                    jumlah: item.jumlah,
                });
            });

            racikanTemp = [];
            racikanId = generateRacikanId();
            document.getElementById('namaRacikan').value = '';
            document.getElementById('selectSignaRacik').value = '';
            renderObatRacikTemp();
            renderSemuaItem();
        }

        // ========== UTILITY & RENDER ==========
        function generateRacikanId() {
            return 'RCK-' + Math.random().toString(36).substring(2, 8).toUpperCase();
        }

        function renderObatRacikTemp() {
            const tbody = document.getElementById('obatRacikTemp');
            tbody.innerHTML = '';

            racikanTemp.forEach((item, index) => {
                tbody.innerHTML += `
                    <tr>
                        <td class="px-4 py-2 border">${item.obatNama}</td>
                        <td class="px-4 py-2 border">${item.jumlah}</td>
                        <td class="px-4 py-2 border">
                            <button onclick="hapusObatTemp(${index})" class="text-red-500 hover:underline">Hapus</button>
                        </td>
                    </tr>`;
            });
        }

        function renderSemuaItem() {
            const tbody = document.getElementById('resepItems');
            const itemsJson = document.getElementById('itemsJson');
            tbody.innerHTML = '';

            let grouped = {};

            semuaItem.forEach((item, index) => {
                if (item.racikan_id) {
                    if (!grouped[item.racikan_id]) {
                        grouped[item.racikan_id] = [];
                    }
                    grouped[item.racikan_id].push({ ...item, index });
                } else {
                    // Non racikan langsung render
                    tbody.innerHTML += `
                        <tr>
                            <td class="px-4 py-2 border">-</td>
                            <td class="px-4 py-2 border">${item.obatNama}</td>
                            <td class="px-4 py-2 border">${item.jumlah}</td>
                            <td class="px-4 py-2 border">${item.signaNama}</td>
                            <td class="px-4 py-2 border">
                                <button onclick="hapusItem(${index})" class="text-red-600 hover:underline">Hapus</button>
                            </td>
                        </tr>
                    `;
                }
            });

            // Render racikan per grup
            for (const racikanId in grouped) {
                const grup = grouped[racikanId];
                grup.forEach((item, i) => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="px-4 py-2 border">${i === 0 ? item.nama_racikan : ''}</td>
                            <td class="px-4 py-2 border">${item.obatNama}</td>
                            <td class="px-4 py-2 border">${item.jumlah}</td>
                            <td class="px-4 py-2 border">${i === 0 ? item.signaNama : ''}</td>
                            <td class="px-4 py-2 border">
                                <button onclick="hapusItem(${item.index})" class="text-red-600 hover:underline">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            }

            itemsJson.value = JSON.stringify(semuaItem);
        }


        function hapusItem(index) {
            semuaItem.splice(index, 1);
            renderSemuaItem();
        }

        function hapusObatTemp(index) {
            racikanTemp.splice(index, 1);
            renderObatRacikTemp();
        }
    </script>

</x-app-layout>
