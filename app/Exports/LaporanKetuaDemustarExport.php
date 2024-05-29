<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanKetuaDemustarExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $totalPemilih = User::where('role', 'pemilih')->count();

        $totalVotes = DB::table('calon2s')
            ->leftJoin('votes2', 'calon2s.id', '=', 'votes2.calon2_id')
            ->select('calon2s.nama_calon', DB::raw('COUNT(votes2.id) as total_suara'))
            ->groupBy('calon2s.id', 'calon2s.nama_calon')
            ->get();

        $totalSuaraKeseluruhan = $totalVotes->sum('total_suara');

        $data = [];
        foreach ($totalVotes as $vote) {
            $persentaseSuara = $totalSuaraKeseluruhan > 0 ? ($vote->total_suara / $totalSuaraKeseluruhan) * 100 : 0;
            $persentaseSuaraDariPemilih = $totalPemilih > 0 ? ($vote->total_suara / $totalPemilih) * 100 : 0;
            $data[] = [
                'Nama Kandidat' => $vote->nama_calon,
                'Total Suara' => $vote->total_suara,
                'Persentase Suara' => $persentaseSuara . '%',
                'Persentase Suara dari Pemilih' => $persentaseSuaraDariPemilih . '%',
            ];
        }
        $data[] = [
            'Nama Kandidat' => 'Total Pemilih',
            'Total Suara' => '',
            'Persentase Suara' => '',
            'Persentase Suara dari Total Pemilih' => '',
            'Total Pemilih' => $totalPemilih
        ];

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Nama Kandidat',
            'Total Suara',
            'Persentase Suara',
            'Persentase Suara dari Pemilih',
            'Total Pemilih',
        ];
    }
}
