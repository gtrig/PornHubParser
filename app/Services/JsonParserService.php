<?php

namespace App\Services;

use App\Models\HairColor;
use App\Models\Ethnicity;
use App\Models\Orientation;
use App\Models\BreastType;
use Illuminate\Support\Facades\Storage;
use \JsonMachine\Items;
use JsonMachine\JsonDecoder\ExtJsonDecoder;

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
        
        foreach ($matches[1] as $match) {
            //if the match has the character | in it, then we need to split it and add the values to the array
            if (strpos($match, '|') !== false) {
                $split = explode('|', $match);
                foreach ($split as $value) {
                    $matches[1][] = $value;
                }
                //remove the original value from the array
                unset($matches[1][array_search($match, $matches[1])]);
            }
        }

        $hairColors = array_values(array_unique($matches[1]));



        return $hairColors;
    }

    public function parseEthnicities()
    {
        $feed = Storage::disk('local')->get('feed.json');
        
        
        preg_match_all('/"ethnicity":"([^"]+)"/', $feed, $matches);

        foreach ($matches[1] as $match) {
            //if the match has the character | in it, then we need to split it and add the values to the array
            if (strpos($match, '|') !== false) {
                $split = explode('|', $match);
                foreach ($split as $value) {
                    $matches[1][] = $value;
                }
                //remove the original value from the array
                unset($matches[1][array_search($match, $matches[1])]);
            }
        }
        
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
        // using the methods above to parse the unique elements and create them in the database.
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

    public function parsePornstars()
    {
        $path = Storage::disk('local')->path('feed.json');
        
        // using json-machine to parse the json file for efficiency
        $items = Items::fromFile($path, ['pointer' => '/items','decoder' => new ExtJsonDecoder(true)]);
        $pornstars = [];
        foreach ($items as $pornstar) {
            $pornstars[] = $pornstar;
        }

        return $pornstars;
    }
}