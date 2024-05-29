<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    use HasFactory;
    protected $table = 'votes2';

    protected $fillable = [
        'user_id',
        'calon2_id',
    ];

    public function calon2()
    {
        return $this->belongsTo(Calon2::class, 'calon2_id');
    }
}
