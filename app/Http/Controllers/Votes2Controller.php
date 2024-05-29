<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Votes;
use App\Models\Calon2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Votes2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCalon2 = DB::table('calon2s')->get();
        return view('pemilih2.index', compact('dataCalon2'));
    }
    public function detail($id)
    {
        $dataCalon2 = DB::table('calon2s')->get();
        $detailDataKandidat2 = Calon2::find($id);
        return view('pemilih2.detail', compact('dataCalon2', 'detailDataKandidat2'));
    }

    public function pilih($id)
    {
        $pilihKandidat2 = Calon2::find($id);
        return view('pemilih2.pilihKandidat', compact('pilihKandidat2'));
    }

    public function pilihpros(Request $request, $id)
    {
        $id_pengguna = auth()->id();

        $pengguna = User::find($id_pengguna);
        if ($pengguna && $pengguna->status == 1) {
            return redirect('/dashboard/pemilih')->with(['error' => "Anda sudah menggunakan hak suara Anda."]);
        }

        $pemilihan = new Votes;
        $pemilihan->user_id = $id_pengguna;
        $pemilihan->calon_id = $id;
        $pemilihan->save();

        if ($pemilihan) {
            $pengguna = User::find($id_pengguna);
            if ($pengguna && $pengguna->status == 0) {
                $pengguna->status = '1';
                $pengguna->save();
            }

            return redirect('/dashboard/pemilih')->with(['success' => "Pilihan Anda telah disimpan."]);
        } else {
            return redirect('/dashboard/pemilih')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }
}
