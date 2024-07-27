<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Calon;
use App\Models\Calon2;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemilihController extends Controller
{
    public function indexKomandan()
    {
        $dataCalonKomandan = DB::table('calons')->orderBy("no_urut", "asc")->get();
        return view('pemilih.komandanResimen.index', compact('dataCalonKomandan'));
    }

    public function detailKomandan($id)
    {
        $dataCalon = DB::table('calons')->get();
        $detailDataKandidat = Calon::find($id);
        return view('pemilih.komandanResimen.detail', compact('dataCalon', 'detailDataKandidat'));
    }

    public function pilihKomandan($id)
    {
        $pilihKandidat = Calon::find($id);
        return view('pemilih.komandanResimen.pilihKandidat', compact('pilihKandidat'));
    }

    public function pilihprosKomandan(Request $request, $id)
    {
        $id_pengguna = auth()->id();

        $pengguna = User::find($id_pengguna);
        if ($pengguna && $pengguna->status_vote_komandan == 1) {
            return redirect('/dashboard/pemilih')->with(['error' => "Anda sudah menggunakan hak suara Anda."]);
        }

        $pemilihan = new Vote;
        $pemilihan->user_id = $id_pengguna;
        $pemilihan->calon_id = $id;
        $pemilihan->save();

        if ($pemilihan) {
            $pengguna = User::find($id_pengguna);
            if ($pengguna && $pengguna->status_vote_komandan == 0) {
                $pengguna->status_vote_komandan = '1';
                $pengguna->save();
            }

            return redirect('/dashboard/pemilih')->with(['success' => "Pilihan Anda telah disimpan."]);
        } else {
            return redirect('/dashboard/pemilih')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }

    public function indexKetua()
    {
        $dataCalonKetua = DB::table('calon2s')->orderBy("no_urut", "asc")->get();
        return view('pemilih.ketuaDemustar.index', compact('dataCalonKetua'));
    }

    public function detailKetua($id)
    {
        $dataCalon = DB::table('calon2s')->get();
        $detailDataKandidat = Calon2::find($id);
        return view('pemilih.ketuaDemustar.detail', compact('dataCalon', 'detailDataKandidat'));
    }

    public function pilihKetua($id)
    {
        $pilihKandidat = Calon2::find($id);
        return view('pemilih.ketuaDemustar.pilihKandidat', compact('pilihKandidat'));
    }

    public function pilihprosKetua(Request $request, $id)
    {
        $id_pengguna = auth()->id();

        $pengguna = User::find($id_pengguna);
        if ($pengguna && $pengguna->status_vote_ketua == 1) {
            return redirect('/dashboard/pemilihKetua')->with(['error' => "Anda sudah menggunakan hak suara Anda."]);
        }

        $pemilihan = new Votes;
        $pemilihan->user_id = $id_pengguna;
        $pemilihan->calon2_id = $id;
        $pemilihan->save();

        if ($pemilihan) {
            $pengguna = User::find($id_pengguna);
            if ($pengguna && $pengguna->status_vote_ketua == 0) {
                $pengguna->status_vote_ketua = '1';
                $pengguna->save();
            }

            return redirect('/dashboard/pemilihKetua')->with(['success' => "Pilihan Anda telah disimpan."]);
        } else {
            return redirect('/dashboard/pemilihKetua')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }
}
