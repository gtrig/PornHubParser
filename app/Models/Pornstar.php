<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pornstar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'link',
        'piercings',
        'tattoos',
        'breast_size',
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


    public function breastType()
    {
        return $this->belongsTo(BreastType::class);
    }

    public function ethnicity()
    {
        return $this->belongsTo(Ethnicity::class);
    }

    public function hairColor()
    {
        return $this->belongsTo(HairColor::class);
    }

    public function orientation()
    {
        return $this->belongsTo(Orientation::class);
    }

    public function setStatsAttribute($value)
    {
        $this->monthlySearches = $value['monthlySearches'];
        $this->premiumVideosCount = $value['premiumVideosCount'];
        $this->rank = $value['rank'];
        $this->rankPremium = $value['rankPremium'];
        $this->rankWl = $value['rankWl'];
        $this->subscriptions = $value['subscriptions'];
        $this->videosCount = $value['videosCount'];
        $this->views = $value['views'];
        $this->whiteLabelVideoCount = $value['whiteLabelVideoCount'];
    }

    public function getStatsAttribute()
    {
        return [
            'monthlySearches' => $this->monthlySearches,
            'premiumVideosCount' => $this->premiumVideosCount,
            'rank' => $this->rank,
            'rankPremium' => $this->rankPremium,
            'rankWl' => $this->rankWl,
            'subscriptions' => $this->subscriptions,
            'videosCount' => $this->videosCount,
            'views' => $this->views,
            'whiteLabelVideoCount' => $this->whiteLabelVideoCount,
        ];
    }
}
