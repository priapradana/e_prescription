<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\SignaM;
use App\Models\ObatalkesM;
use App\Models\Resep;
use App\Models\ResepDetail;


class ResepController extends Controller
{
    public function index()
    {
        $obatList = ObatalkesM::where('is_deleted', 0)->where('is_active', 1)->get();
        $signaList = SignaM::where('is_deleted', 0)->where('is_active', 1)->get();

        return view('resep.index', [
            'title' => 'Input Resep',
            'obatList' => $obatList,
            'signaList' => $signaList,
        ]);
    }

    public function add(Request $request)
    {
        $items = json_decode($request->input('items'), true);
        $request->merge(['items' => $items]);

        $request->validate([
            'tanggal_resep' => 'required|date',
            'nama_pasien' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.obatId' => 'required|integer|exists:obatalkes_m,obatalkes_id',
            'items.*.jumlah' => 'required|numeric|min:1',
        ]);

        $resep = Resep::create([
            'no_resep' => 'RSP-' . strtoupper(Str::random(8)),
            'tanggal' => $request->tanggal_resep,
            'pasien_nama' => $request->nama_pasien,
            'created_by' => Auth::id(),
        ]);

        foreach ($items as $item) {
            // Cek apakah ini racikan atau bukan
            $isRacikan = isset($item['racikan_id']);

            ResepDetail::create([
                'resep_id' => $resep->resep_id,
                'obatalkes_id' => $item['obatId'],
                'jumlah' => $item['jumlah'],
                'signa_kode' => $item['signaId'] ?? $item['signa_kode'] ?? null,
                'signa_nama' => $item['signaNama'] ?? $item['signa_nama'] ?? null,
                'racikan_id' => $item['racikan_id'] ?? null,
                'is_racikan_header' => $item['is_racikan_header'] ?? false,
                'nama_racikan' => $item['nama_racikan'] ?? null,
            ]);

            // Update stok obat
            $obat = ObatalkesM::find($item['obatId']);
            if ($obat) {
                $obat->stok = max(0, $obat->stok - $item['jumlah']);
                $obat->modified_count = ($obat->modified_count ?? 0) + 1;
                $obat->last_modified_date = now();
                $obat->last_modified_by = Auth::id();
                $obat->save();
            }
        }

        return redirect()->route('resep.index')->with('success', 'Resep berhasil disimpan.');
    }


    // Data Master
    public function data(Request $request)
    {
        $query = Resep::with(['details.obatalkes']);

        // Sorting berdasarkan tanggal
        if ($request->sort === 'latest') {
            $query->orderBy('tanggal', 'desc');
        } elseif ($request->sort === 'oldest') {
            $query->orderBy('tanggal', 'asc');
        }

        $perPage = $request->input('perpage', 10);
        $resepList = $query->paginate($perPage)->withQueryString();

        return view('master.resep', [
            'title' => 'Data Resep',
            'resepList' => $resepList
        ]);
    }

    public function printPdf($id)
    {
        $resep = Resep::with(['details.obatalkes'])
                    ->where('resep_id', $id)
                    ->firstOrFail();

        $tanggalCetak = now()->format('d-m-Y');

        return Pdf::loadView('prints.resep', [
            'resep' => $resep,
            'tanggalCetak' => $tanggalCetak
        ])  ->setPaper([0, 0, 226.77, 1000], 'portrait')
            ->stream('Resep-' . $resep->no_resep . '.pdf');
    }

}
