<?php

namespace App\Http\Controllers;

use App\Models\Calon2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Calon2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCalon2 = DB::table('calon2s')->orderBy("no_urut", "asc")->get();
        return view('admin.dataCalon2.index', compact('dataCalon2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no_urut = $request->no_urut;
        $namaKandidat = $request->nama;
        $keterangan = $request->keterangan;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/kandidat2';
            $file->move($tujuanFile, $namafile);
        } else {
            $namafile = null;
        }

        $data = [
            'no_urut' => $no_urut,
            'nama_calon' => $namaKandidat,
            'keterangan' => $keterangan,
            'foto_calon' => $namafile,
        ];

        $simpan = DB::table('calon2s')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Kandidat berhasil tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal tambah']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calon2  $calon2
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataKandidat2 = Calon2::find($id);
        return view('admin.dataCalon2.edit', compact('dataKandidat2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calon2  $calon2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_urut' => 'required',
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        $dataKandidat2 = Calon2::find($id);

        $namafile = $dataKandidat2->foto_calon;

        $dataKandidat2->no_urut = $request->no_urut;
        $dataKandidat2->nama_calon = $request->nama;
        $dataKandidat2->keterangan = $request->keterangan;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/kandidat2';
            $file->move($tujuanFile, $namafile);
        }

        $dataKandidat2->foto_calon = $namafile;

        $dataKandidat2->save();

        if ($dataKandidat2) {
            return redirect('/dataCalonKetuaDemustar')->with(['success' => "Data Kandidat Berhasil Di Update!"]);
        } else {
            return redirect('/dataCalonKetuaDemustar')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calon2  $calon2
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('calon2s')->where('id', $id)->delete();

        if ($delete) {
            return redirect('/dataCalonKetuaDemustar')->with(['success' => "Data Berhasil Di Hapus"]);
        } else {
            return redirect('/dataCalonKetuaDemustar')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }
}
