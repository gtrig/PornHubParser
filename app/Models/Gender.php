<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
    ];

    public function pornstars()
    {
        return $this->hasMany(Pornstar::class);
    }

    public static function getIdByValue($value)
    {
        // if the value -> id is not in the cache, add it to the cache
        $cacheKey = 'Ethnicity:'.$value;
        if (!Cache::has($cacheKey)) {
            Cache::put($cacheKey, self::where('value', $value)->first()->id, config('cache.ttl'));
        }
        // then return it
        return Cache::get($cacheKey);
    }
}
