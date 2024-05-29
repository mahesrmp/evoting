<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKetuaDemustarExport;
use App\Exports\LaporanKomandanResimenExport;

class AdminController extends Controller
{
    public function laporanKomandan()
    {
        return Excel::download(new LaporanKomandanResimenExport, 'laporan_suara_komandan_resimen.xlsx');
    }

    public function laporanKetua()
    {
        return Excel::download(new LaporanKetuaDemustarExport, 'laporan_suara_ketua_demustar.xlsx');
    }
}
