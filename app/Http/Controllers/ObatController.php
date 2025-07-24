<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\ObatalkesM;


class ObatController extends Controller
{
    public function index(Request $request)
    {
        $query = ObatalkesM::withCount(['resepDetails as barang_keluar' => function ($q) {
            $q->select(DB::raw("COALESCE(SUM(jumlah), 0)"));
        }]);

        // Pencarian
        if ($request->filled('q')) {
            $query->where('obatalkes_nama', 'like', '%' . $request->q . '%');
        }

        // Sorting
        switch ($request->sort) {
            case 'az':
                $query->orderBy('obatalkes_nama', 'asc');
                break;
            case 'za':
                $query->orderBy('obatalkes_nama', 'desc');
                break;
            case 'stok':
                $query->orderBy('stok', 'asc');
                break;
            case 'keluar':
                $query->orderBy('barang_keluar', 'desc');
                break;
        }

        // Pagination
        $perPage = $request->input('perpage', 10);
        $obatList = $query->paginate($perPage)->withQueryString();

        return view('master.obat', [
            'title' => 'Data Obat',
            'obatList' => $obatList
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'obatalkes_kode' => 'required|string|max:100|unique:obatalkes_m,obatalkes_kode',
            'obatalkes_nama' => 'required|string|max:250',
            'stok' => 'required|numeric|min:0|max:999999999999.99', // Sesuai batas decimal(15,2)
        ]);

        ObatalkesM::create([
            'obatalkes_kode' => $request->obatalkes_kode,
            'obatalkes_nama' => $request->obatalkes_nama,
            'stok' => $request->stok,
            'is_active' => 0
        ]);

        return redirect()->route('master.obat')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $obat = ObatalkesM::findOrFail($id);

        $request->validate([
            'obatalkes_kode' => 'required|string|max:100|unique:obatalkes_m,obatalkes_kode,' . $id . ',obatalkes_id',
            'obatalkes_nama' => 'required|string|max:255',
            'stok' => 'required|numeric|min:0',
        ]);

        $obat->update([
            'obatalkes_kode' => $request->obatalkes_kode,
            'obatalkes_nama' => $request->obatalkes_nama,
            'stok' => $request->stok,
            'modified_count' => $obat->modified_count + 1,
            'last_modified_date' => now(),
            'last_modified_by' => Auth::user()->name ?? 'admin'
        ]);

        return redirect()->back()->with('success', 'Obat berhasil diupdate');
    }

    public function softDelete($id)
    {
        $obat = ObatalkesM::findOrFail($id);

        $obat->update([
            'is_deleted' => 1,
            'is_active' => 0,
            'deleted_date' => now(),
            'deleted_by' => Auth::user()->name ?? 'admin',
        ]);

        return redirect()->back()->with('success', 'Obat berhasil dihapus');
    }


    public function toggle($id)
    {
        $obat = ObatalkesM::findOrFail($id);
        $obat->is_active = !$obat->is_active;
        $obat->save();

        return redirect()->back()->with('success', 'Status obat diperbarui.');
    }


}
