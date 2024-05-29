<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PemilihImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $username = strtolower(str_replace(' ', '', $row['nama']));
        $password = Str::random(5);

        return new User([
            'nama' => $row['nama'],
            'username' => $username,
            'kataSandi' => $password,
            'role' => 'pemilih', // Tetapkan role sebagai pemilih
            // tambahkan sesuai kebutuhan dengan kolom lainnya
        ]);
    }
}
