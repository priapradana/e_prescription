<div class="bg-white p-6 rounded-md shadow mb-6">
    <h3 class="text-md font-semibold mb-4 text-primary">Tambah Obat Non-Racikan</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        <div>
            <label class="block text-sm font-medium">Pilih Obat</label>
            <select id="selectObat" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
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
            <input type="number" id="inputJumlah" min="1" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium">Pilih Signa</label>
            <select id="selectSigna" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                <option value="">-- Pilih Signa --</option>
                @foreach ($signaList as $signa)
                    <option value="{{ $signa->signa_id }}" data-nama="{{ $signa->signa_nama }}">
                        {{ $signa->signa_kode }} - {{ $signa->signa_nama }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mt-4">
        <button type="button" onclick="tambahObatNonRacik()"
            class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">+ Tambah ke Resep</button>
    </div>
</div>
