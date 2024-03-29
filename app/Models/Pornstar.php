<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Pornstar extends Model
{
    use HasFactory;

    protected $fillable = [
        'ph_id',
        'attributes',
        'name',
        'gender',
        'age',
        'link',
        'license',
        'wlStatus',
        'piercings',
        'tattoos',
        'breast_size',
        'breastType',
        'orientation',
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

    public function generateImagePath()
    {
        // images should be stored 1000 per folder to avoid performance issues.
        // for example, if the pornstar id is 123456, the path should be 123/400/123456.jpg
        $id = $this->id;
        $path = [];

        //1st level
        if($id > 1000000) {
            $path[] = floor($id / 1000000);
        } else {
            $path[] = 0;
        }
        
        //2nd level
        if($id > 1000) {
            $path[] = floor($id / 1000);
        } else {
            $path[] = 0;
        }

        return implode('/', $path).'/'.$this->id.'.jpg';
    }

    public function hasImage()
    {
        $path = 'thumbnails/'.$this->generateImagePath();
        return Storage::disk('public')->exists($path);
    }

    public function breastType()
    {
        return $this->belongsTo(BreastType::class);
    }

    public function ethnicity()
    {
        return $this->belongsToMany(Ethnicity::class)->withPivot('pornstar_id');
    }

    public function hairColor()
    {
        return $this->belongsToMany(HairColor::class)->withPivot('pornstar_id');
    }

    public function orientation()
    {
        return $this->belongsTo(Orientation::class);
    }

    public function aliases()
    {
        return $this->hasMany(Alias::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function stats()
    {
        return $this->hasOne(Stats::class);
    }

    public function syncAliases($aliases)
    {
        $this->aliases()->delete();
        foreach ($aliases as $alias) {
            $this->aliases()->create(['name' => $alias]);
        }
    }

    public function setAttributesAttribute($value)
    {
        if($value == null) {
            return;
        }
        $this->age = $value['age']??null;
        $this->piercings = $value['piercings'];
        $this->tattoos = $value['tattoos'];
        $this->breast_size = $value['breastSize']??null;
        if(isset($value['gender'])) {
            $this->gender()->associate(Gender::getIdByValue($value['gender']));
        }
        if(isset($value['breastType'])) {
            $this->breast_type = $value['breastType'];
        }
        if(isset($value['orientation'])) {
            $this->orientation = $value['orientation'];
        }
    }

    public function setBreastTypeAttribute($value)
    {
        if($value == null) {
            return;
        }
        $this->breast_type_id = BreastType::getIdByValue($value);
    }
    
    public function setOrientationAttribute($value)
    {
        if($value == null) {
            return;
        }
        $this->orientation_id = Orientation::getIdByValue($value);
    }

    // public function setGenderAttribute($value)
    // {
    //     if($value == null) {
    //         return;
    //     }

    //     $this->gender_id = Gender::getIdByValue($value);
    // }

    public function setEthnicityAttribute($value)
    {
        if($value == null) {
            return;
        }
        if (strpos($value, '|') !== false) {
            $split = explode('|', $value);
            foreach ($split as $ethnicity) {
                $ethnicity_id = Ethnicity::getIdByValue($ethnicity);
                $this->ethnicity()->sync($ethnicity_id);
            }
        } else {
            $ethnicity_id = Ethnicity::getIdByValue($value);
            $this->ethnicity()->sync($ethnicity_id);
        }
    }

    public function setHairColorAttribute($value)
    {
        if (strpos($value, '|') !== false) {
            $split = explode('|', $value);
            foreach ($split as $color) {
                $this->hairColor()->sync(HairColor::getIdByValue($color));
            }
        } else {
            $this->hairColor()->sync(HairColor::getIdByValue($value));
        }
    }

}
