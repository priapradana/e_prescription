<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\ObatalkesM;
use App\Models\Resep;
use App\Models\SignaM;


class DashboardController extends Controller
{
    public function index()
    {
        $totalObat   = ObatalkesM::where('is_deleted', 0)->count();
        $totalResep  = Resep::count();
        $totalSigna  = SignaM::where('is_deleted', 0)->count();

        return view('dashboard', compact('totalObat', 'totalResep', 'totalSigna'));
    }

}