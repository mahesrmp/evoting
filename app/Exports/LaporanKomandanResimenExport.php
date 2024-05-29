<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanKomandanResimenExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $totalPemilih = User::where('role', 'pemilih')->count();

        $totalVotes = DB::table('calons')
            ->leftJoin('votes', 'calons.id', '=', 'votes.calon_id')
            ->select('calons.nama_calon', DB::raw('COUNT(votes.id) as total_suara'))
            ->groupBy('calons.id', 'calons.nama_calon')
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
