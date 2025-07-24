<?php

// app/Http/Controllers/SignaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SignaM;
use Illuminate\Support\Facades\Auth;

class SignaController extends Controller
{
    public function index(Request $request)
    {
        $query = SignaM::query();

        // Pencarian
        if ($request->q) {
            $query->where('signa_nama', 'like', '%' . $request->q . '%');
        }

        // Sorting
        if ($request->sort == 'az') {
            $query->orderBy('signa_nama', 'asc');
        } elseif ($request->sort == 'za') {
            $query->orderBy('signa_nama', 'desc');
        }

        // Pagination
        $perPage = $request->perpage ?? 10;
        $signaList = $query->paginate($perPage)->withQueryString();

        return view('master.signa', [
            'title' => 'Data Signa',
            'signaList' => $signaList,
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'signa_kode' => 'required|string|max:100|unique:signa_m,signa_kode',
            'signa_nama' => 'required|string|max:255',
        ]);

        SignaM::create([
            'signa_kode' => $request->signa_kode,
            'signa_nama' => $request->signa_nama,
            'is_active' => 1,
            'is_deleted' => 0,
            'created_date' => now(),
            'created_by' => Auth::user()->name ?? 'admin',
        ]);

        return redirect()->back()->with('success', 'Signa berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $signa = SignaM::findOrFail($id);

        $request->validate([
            'signa_kode' => 'required|string|max:100|unique:signa_m,signa_kode,' . $id . ',signa_id',
            'signa_nama' => 'required|string|max:255',
        ]);

        $signa->update([
            'signa_kode' => $request->signa_kode,
            'signa_nama' => $request->signa_nama,
            'last_modified_date' => now(),
            'last_modified_by' => Auth::user()->name ?? 'admin',
        ]);

        return redirect()->back()->with('success', 'Data Signa berhasil diupdate');
    }

    public function toggle($id)
    {
        $signa = SignaM::findOrFail($id);
        $signa->is_active = !$signa->is_active;
        $signa->last_modified_date = now();
        $signa->last_modified_by = Auth::user()->name ?? 'admin';
        $signa->save();

        return redirect()->back()->with('success', 'Status Signa berhasil diperbarui');
    }

    public function softDelete($id)
    {
        $signa = SignaM::findOrFail($id);

        $signa->update([
            'is_deleted' => 1,
            'is_active' => 0,
            'deleted_date' => now(),
            'deleted_by' => Auth::user()->name ?? 'admin',
        ]);

        return redirect()->back()->with('success', 'Data Signa berhasil dihapus');
    }

}
