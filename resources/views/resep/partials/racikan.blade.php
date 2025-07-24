<div class="bg-white p-6 rounded-md shadow mb-6">
    <h3 class="text-md font-semibold mb-4 text-primary">Tambah Racikan</h3>

    <div class="mt-4">
        <label class="block text-sm font-medium mb-1">Nama Racikan</label>
        <input type="text" id="namaRacikan" class="w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        <div>
            <label class="block text-sm font-medium">Pilih Obat</label>
            <select id="selectObatRacik" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                <option value="">-- Pilih Obat --</option>
                @foreach ($obatList as $obat)
                    <option value="{{ $obat->obatalkes_id }}" data-nama="{{ $obat->obatalkes_nama }}">
                        {{ $obat->obatalkes_kode }} - {{ $obat->obatalkes_nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium">Jumlah</label>
            <input type="number" id="inputJumlahRacik" min="1" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <button type="button" onclick="tambahObatRacikan()"
                class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">+ Tambah Obat</button>
        </div>
    </div>

    <div class="mt-6">
        <h4 class="text-md font-semibold mb-2 text-primary">Daftar Obat Siap Racik</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm text-left border border-gray-300 rounded-md">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border-b border-gray-300">Obat</th>
                        <th class="px-4 py-2 border-b border-gray-300">Jumlah</th>
                        <th class="px-4 py-2 border-b border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody id="obatRacikTemp" class="text-gray-700">
                    <!-- Diisi oleh JS -->
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <label class="block text-sm font-medium mb-1">Pilih Signa Racikan</label>
        <select id="selectSignaRacik" class="w-full border-gray-300 rounded-md shadow-sm">
            <option value="">-- Pilih Signa --</option>
            @foreach ($signaList as $signa)
                <option value="{{ $signa->signa_id }}" data-nama="{{ $signa->signa_nama }}">
                    {{ $signa->signa_kode }} - {{ $signa->signa_nama }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mt-4 text-right">
        <button type="button" onclick="selesaikanRacikan()"
            class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">✔ Selesai Racikan</button>
    </div>
</div>
