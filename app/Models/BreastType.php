<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreastType extends Model
{
    use HasFactory;

    protected $fillable = ['value'];

    public function pornstar()
    {
        return $this->hasMany(Pornstar::class);
    }
}
