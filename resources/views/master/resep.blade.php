<x-app-layout :title="$title">

    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-primary">{{ $title }}</h2>
    </div>

    {{-- Sort dan PerPage --}}
    <div class="flex flex-wrap items-center gap-2 mb-4">
        <form method="GET" class="flex items-center gap-2">
            {{-- Sort --}}
            <div class="relative">
                <select name="sort" onchange="this.form.submit()" class="appearance-none bg-none border-gray-300 rounded-md shadow-sm px-3 pr-8 py-2 text-sm bg-white">
                    <option value="">Sortir Berdasarkan</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
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

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left table-auto">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">No.</th>
                    <th class="px-4 py-2">Kode Resep</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Pasien</th>
                    <th class="px-4 py-2 text-center">Status</th>
                    <th class="px-4 py-2">Nama Racikan</th>
                    <th class="px-4 py-2">Obat</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($resepList as $index => $resep)
                    @php
                        $detailCount = $resep->details->count();
                    @endphp
                    @foreach ($resep->details as $i => $detail)
                        <tr class="border-t">
                            @if ($i === 0)
                                <td class="px-4 py-2" rowspan="{{ $detailCount }}">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2" rowspan="{{ $detailCount }}">{{ $resep->no_resep }}</td>
                                <td class="px-4 py-2" rowspan="{{ $detailCount }}">{{ $resep->tanggal }}</td>
                                <td class="px-4 py-2" rowspan="{{ $detailCount }}">{{ $resep->pasien_nama }}</td>
                            @endif
                            <td class="px-4 py-2 text-center">
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    {{ $detail->racikan_id ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $detail->racikan_id ? 'Racikan' : 'Non Racikan' }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                {{ $detail->racikan_id ? $detail->nama_racikan : '-' }}
                            </td>
                            <td class="px-4 py-2">{{ $detail->obatalkes->obatalkes_nama ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $detail->jumlah }}</td>
                            @if ($i === 0)
                                <td class="px-4 py-2" rowspan="{{ $detailCount }}">
                                    <a href="{{ route('resep.print', $resep->resep_id) }}" class="text-primary hover:underline" target="_blank">
                                        <i class="fas fa-print"></i> PDF
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $resepList->links() }}
    </div>

</x-app-layout>
