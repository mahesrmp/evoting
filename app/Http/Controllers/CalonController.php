<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CalonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCalon = DB::table('calons')->get();
        return view('admin.dataCalon.index', compact('dataCalon'));
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
            $tujuanFile = 'asset/kandidat';
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

        $simpan = DB::table('calons')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Kandidat berhasil tambah']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal tambah']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataKandidat = Calon::find($id);
        return view('admin.dataCalon.edit', compact('dataKandidat'));
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
            'no_urut' => 'required',
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        $dataKandidat = Calon::find($id);

        $namafile = $dataKandidat->foto_calon;

        $dataKandidat->no_urut = $request->no_urut;
        $dataKandidat->nama_calon = $request->nama;
        $dataKandidat->keterangan = $request->keterangan;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/kandidat';
            $file->move($tujuanFile, $namafile);
        }

        $dataKandidat->foto_calon = $namafile;

        $dataKandidat->save();

        if ($dataKandidat) {
            return redirect('/dataCalonKomandanResimen')->with(['success' => "Data Kandidat Berhasil Di Update!"]);
        } else {
            return redirect('/dataCalonKomandanResimen')->with(['error' => "Data Gagal Di Hapus"]);
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
        $delete = DB::table('calons')->where('id', $id)->delete();

        if ($delete) {
            return redirect('/dataCalonKomandanResimen')->with(['success' => "Data Berhasil Di Hapus"]);
        } else {
            return redirect('/dataCalonKomandanResimen')->with(['error' => "Data Gagal Di Hapus"]);
        }
    }
}
