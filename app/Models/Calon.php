<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    use HasFactory;
    protected $table = 'calons';

    protected $fillable = [
        'nama_calon',
        'foto_calon',
        'keterangan',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class, 'calon_id');
    }
}
