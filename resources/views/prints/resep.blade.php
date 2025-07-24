<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resep PDF</title>
    <style>
        @page {
            size: 80mm auto;
            margin: 10px;
        }

        body {
            font-family: "Arial", sans-serif;
            font-size: 11px;
            color: #000;
        }

        h2, p {
            margin: 0 0 4px 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th, td {
            border-bottom: 1px dashed #999;
            padding: 4px 0;
            text-align: left;
        }

        th {
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-style: italic;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>e-Prescription Sipatex</h2>
        <small>{{ $tanggalCetak }}</small>
    </div>

    <div class="info">
        <p><strong>No Resep:</strong> {{ $resep->no_resep }}</p>
        <p><strong>Nama Pasien:</strong> {{ $resep->pasien_nama }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">No</th>
                <th style="width: 25%;">Status Obat</th>
                <th style="width: 30%;">Racikan Obat</th>
                <th style="width: 37%;">Obat</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $grouped = $resep->details->groupBy(function ($item) {
                    return $item->racikan_id ?: 'NON';
                });
            @endphp

            @foreach ($grouped as $groupId => $groupItems)
                @foreach ($groupItems as $index => $item)
                    <tr>
                        <td>{{ $no++ }}</td>

                        @if ($index === 0)
                            <td rowspan="{{ $groupItems->count() }}">
                                {{ $groupId === 'NON' ? 'Non Racikan' : 'Racikan' }}
                            </td>
                            <td rowspan="{{ $groupItems->count() }}">
                                {{ $groupId === 'NON' ? '-' : $item->nama_racikan }}
                            </td>
                        @endif

                        <td>{{ $item->obatalkes->obatalkes_nama ?? '-' }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Cetak oleh sistem e-Resep — {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>
