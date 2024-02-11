<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    use HasFactory;

    protected $fillable = [
        'pornstar_id',
        'monthlySearches',
        'premiumVideosCount',
        'rank',
        'rankPremium',
        'rankWl',
        'subscriptions',
        'videosCount',
        'views',
        'whiteLabelVideoCount',
    ];

    public function pornstar()
    {
        return $this->belongsTo(Pornstar::class);
    }
}
