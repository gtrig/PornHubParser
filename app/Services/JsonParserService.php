<?php

namespace App\Services;

use App\Models\HairColor;
use App\Models\Ethnicity;
use App\Models\Orientation;
use App\Models\BreastType;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;

class JsonParserService
{
    public function downloadFeed($url)
    {
        try {
            $feed = file_get_contents($url);
            Storage::disk('local')->put('feed.json', $feed);
            return true;
        } catch (\Exception $e) {
            throw $e;
            // return $e->getMessage();
        }
    }

    public function parseHairColors()
    {
        $feed = Storage::disk('local')->get('feed.json');
        
        // using regex to extract the unique hair colors
        preg_match_all('/"hairColor":"([^"]+)"/', $feed, $matches);
        $hairColors = array_values(array_unique($matches[1]));

        return $hairColors;
    }

    public function parseEthnicities()
    {
        $feed = Storage::disk('local')->get('feed.json');
        
        
        preg_match_all('/"ethnicity":"([^"]+)"/', $feed, $matches);
        $ethnicities = array_values(array_unique($matches[1]));

        return $ethnicities;
    }

    public function parseOrientations()
    {
        $feed = Storage::disk('local')->get('feed.json');
        
        preg_match_all('/"orientation":"([^"]+)"/', $feed, $matches);
        $orientations = array_values(array_unique($matches[1]));

        return $orientations;
    }

    public function parseBreastTypes()
    {
        $feed = Storage::disk('local')->get('feed.json');
        
        preg_match_all('/"breastType":"([^"]+)"/', $feed, $matches);
        $breastTypes = array_values(array_unique($matches[1]));

        return $breastTypes;
    }

    public function updateTypes()
    {
        $hairColors = $this->parseHairColors();
        $ethnicities = $this->parseEthnicities();
        $orientations = $this->parseOrientations();
        $breastTypes = $this->parseBreastTypes();

        foreach ($hairColors as $color) {
            HairColor::firstOrCreate(['value' => $color]);
        }

        foreach ($ethnicities as $ethnicity) {
            Ethnicity::firstOrCreate(['value' => $ethnicity]);
        }

        foreach ($orientations as $orientation) {
            Orientation::firstOrCreate(['value' => $orientation]);
        }

        foreach ($breastTypes as $breastType) {
            BreastType::firstOrCreate(['value' => $breastType]);
        }

        return true;
    }

    protected function parseJson($file)
    {
        while (!feof($file)) {
            $line = fgets($file);
            
            if ($line !== false) {
                yield json_decode($line, true);
            }
        }
        
        fclose($file);
    }

    public function parsePornstars()
    {
        $pornstars = [];
        foreach ($this->parseJson(fopen(storage_path('app/feed.json'),'r')) as $pornstar) {
            var_dump($pornstar);
        }

        return $pornstars;
    }
}