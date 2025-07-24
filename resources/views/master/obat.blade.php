<x-app-layout :title="$title">

    <style>
        select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        }
    </style>
    
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-primary">Data Obat</h2>
        <a href="#" id="btnTambahObat" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition">
            + Tambah Obat
        </a>
    </div>

    <div class="mb-4 flex flex-col md:flex-row md:justify-between md:items-center gap-2">
        {{-- Sort dan PerPage --}}
        <div class="flex flex-wrap items-center gap-2">
            <form method="GET" class="flex items-center gap-2">
                {{-- Sort --}}
                <div class="relative">
                    <select name="sort" onchange="this.form.submit()" class="appearance-none bg-none border-gray-300 rounded-md shadow-sm px-3 pr-8 py-2 text-sm bg-white">
                        <option value="">Sortir Berdasarkan</option>
                        <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Nama Z-A</option>
                        <option value="stok" {{ request('sort') == 'stok' ? 'selected' : '' }}>Stok Terendah</option>
                        <option value="keluar" {{ request('sort') == 'keluar' ? 'selected' : '' }}>Barang Keluar Terbanyak</option>

                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.29a.75.75 0 01.02-1.08z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                {{-- Per Page --}}
                <div class="relative">
                    <select name="perpage" onchange="this.form.submit()" class="appearance-none bg-none border-gray-300 rounded-md shadow-sm px-3 pr-8 py-2 text-sm bg-white">
                        <option value="10" {{ request('perpage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('perpage') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('perpage') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.29a.75.75 0 01.02-1.08z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </form>
        </div>


        {{-- Search --}}
        <form method="GET" class="flex items-center gap-2">
            <input type="text" name="q" placeholder="Cari obat..." value="{{ request('q') }}"
                class="border-gray-300 rounded-md shadow-sm px-4 py-2 text-sm focus:ring-primary focus:border-primary" />
            <button type="submit"
                class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition text-sm">
                Cari
            </button>
        </form>
    </div>


    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">No.</th>
                    <th class="px-4 py-2">Kode Obat</th>
                    <th class="px-4 py-2">Nama Obat</th>
                    <th class="px-4 py-2">Stok</th>
                    <th class="px-4 py-2">Jumlah Keluar</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($obatList as $obat)
                    <tr class="border-t">
                        <td class="px-4 py-2">
                            {{ ($obatList->currentPage() - 1) * $obatList->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-4 py-2">{{ $obat->obatalkes_kode }}</td>
                        <td class="px-4 py-2">{{ $obat->obatalkes_nama }}</td>
                        <td class="px-4 py-2">{{ $obat->stok }}</td>
                        <td class="text-center px-4 py-2">{{ $obat->barang_keluar ?? 0 }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                {{ $obat->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $obat->is_active ? 'Aktif' : 'Non-Aktif' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 space-x-2">
                            {{-- Tombol Edit --}}
                            <button 
                                class="btnEditObat text-primary hover:underline"
                                data-id="{{ $obat->obatalkes_id }}"
                                data-kode="{{ $obat->obatalkes_kode }}"
                                data-nama="{{ $obat->obatalkes_nama }}"
                                data-stok="{{ $obat->stok }}"
                                data-url="{{ route('master.obat.update', $obat->obatalkes_id) }}">
                                Edit
                            </button>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('master.obat.delete', $obat->obatalkes_id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:underline">Hapus</button>
                            </form>

                            {{-- Toggle Aktif / Nonaktif --}}
                            <form action="{{ route('master.obat.toggle', $obat->obatalkes_id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-sm text-gray-600 hover:text-primary">
                                    {{ $obat->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $obatList->links() }}
        </div>
    </div>

    <!-- Modal Tambah Obat -->
    <div id="modalTambahObat" class="fixed inset-0 z-50 bg-black bg-opacity-30 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md relative">
            <h2 class="text-lg font-semibold mb-4 text-primary">Tambah Obat</h2>

            <form method="POST" action="{{ route('master.obat.add') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Kode Obat</label>
                    <input type="text" name="obatalkes_kode" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Obat</label>
                    <input type="text" name="obatalkes_nama" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Stok</label>
                    <input type="number" step="0.01" name="stok" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm" />
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="toggleModal(false)"
                        class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Obat -->
    <div id="modalEditObat" class="fixed inset-0 z-50 bg-black bg-opacity-30 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-md relative">
            <h2 class="text-lg font-semibold mb-4 text-primary">Edit Obat</h2>

            <form method="POST" id="formEditObat" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="obatalkes_id" id="edit_id">

                <div class="mb-4">
                    <label class="block text-sm font-medium">Kode Obat</label>
                    <input type="text" name="obatalkes_kode" id="edit_kode" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Obat</label>
                    <input type="text" name="obatalkes_nama" id="edit_nama" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Stok</label>
                    <input type="number" step="0.01" name="stok" id="edit_stok" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm" />
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="toggleEditModal(false)"
                        class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        // Tangani tombol "Edit"
        document.querySelectorAll('.btnEditObat').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                const kode = button.dataset.kode;
                const nama = button.dataset.nama;
                const stok = button.dataset.stok;
                const updateUrl = button.dataset.url;

                document.getElementById('edit_id').value = id;
                document.getElementById('edit_kode').value = kode;
                document.getElementById('edit_nama').value = nama;
                document.getElementById('edit_stok').value = stok;
                document.getElementById('formEditObat').action = updateUrl;

                toggleEditModal(true);
            });
        });

        // Fungsi toggle modal Edit
        function toggleEditModal(show = true) {
            const modal = document.getElementById('modalEditObat');
            if (!modal) return;
            modal.classList.toggle('hidden', !show);
        }

        // Fungsi toggle modal Tambah
        function toggleModal(show = true) {
            const modal = document.getElementById('modalTambahObat');
            if (!modal) return;
            modal.classList.toggle('hidden', !show);
        }

        // Tombol buka modal Tambah
        document.getElementById('btnTambahObat')?.addEventListener('click', () => toggleModal(true));
    </script>


</x-app-layout>
