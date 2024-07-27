<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Calon;
use Illuminate\Http\Request;
use App\Exports\PemilihExport;
use App\Imports\PemilihImport;
use App\Models\Calon2;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DataPemilihController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPemilih = DB::table('users')->where('role', 'pemilih')->get();
        // dd($dataPemilih);
        return view('admin.dataPemilih.index', compact('dataPemilih'));
    }

    public function tambahDariExcel(Request $request)
    {
        // Validasi file Excel yang diunggah
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        // Membaca file Excel yang diunggah
        $excel = $request->file('excel_file');

        // Membaca data dari file Excel dan menambahkannya ke basis data
        Excel::import(new PemilihImport, $excel);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data pemilih berhasil ditambahkan dari file Excel.');
    }

    public function export()
    {
        return Excel::download(new PemilihExport, 'pemilih.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataPemilih = User::find($id);
        return view('admin.dataPemilih.edit', compact('dataPemilih'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'kataSandi' => 'required',
        ]);

        $dataPemilih = User::find($id);

        $dataPemilih->username = $request->username;
        $dataPemilih->kataSandi = $request->kataSandi;

        $dataPemilih->save();

        if ($dataPemilih) {
            return redirect('/dataPemilih')->with(['success' => "Data Pemilih Berhasil Di Update!"]);
        } else {
            return redirect('/dataPemilih')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('users')->where('id', $id)->delete();

        if ($delete) {
            return redirect('/dataPemilih')->with(['success' => "Data Berhasil Di Hapus"]);
        } else {
            return redirect('/dataPemilih')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }

    public function kotakSuaraKomandanResimen()
    {
        $votes = DB::table('votes')
            ->join('users', 'users.id', '=', 'votes.user_id')
            ->join('calons', 'calons.id', '=', 'votes.calon_id')
            ->select('votes.created_at', 'calons.nama_calon', 'users.username')
            ->get();

        return view('admin.kotakSuaraKomandanResimen.index', compact('votes'));
    }

    public function kotakSuaraKetuaDemustar()
    {
        $votes = DB::table('votes2')
            ->join('users', 'users.id', '=', 'votes2.user_id')
            ->join('calon2s', 'calon2s.id', '=', 'votes2.calon2_id')
            ->select('votes2.created_at', 'calon2s.nama_calon', 'users.username')
            ->get();

        return view('admin.kotakSuaraKetuaDemustar.index', compact('votes'));
    }

    public function suaraSementaraCalonKomandanResimen()
    {
        $calons = Calon::orderBy('no_urut', 'asc')->get();
        return view('admin.suaraSementaraCalonKomandanResimen.index', compact('calons'));
    }

    public function suaraSementaraCalonKetuaDemustar()
    {
        $calons = Calon2::orderBy('no_urut', 'asc')->get();
        return view('admin.suaraSementaraCalonKetuaDemustar.index', compact('calons'));
    }
}
