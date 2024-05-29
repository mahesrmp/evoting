<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemilihExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::where('role', 'pemilih')->get(['nama', 'username', 'kataSandi']);
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Username',
            'Password',
        ];
    }
}