<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon2 extends Model
{
    use HasFactory;
    protected $table = 'calon2s';

    protected $fillable = [
        'nama_calon',
        'foto_calon',
        'keterangan',
    ];

    public function votes2()
    {
        return $this->hasMany(Votes::class, 'calon2_id');
    }
}
