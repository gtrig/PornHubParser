<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alias extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function pornstar()
    {
        return $this->belongsTo(Pornstar::class);
    }
}
