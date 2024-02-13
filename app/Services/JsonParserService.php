<?php

namespace App\Services;

use App\Jobs\DownloadImageJob;
use App\Jobs\UpdatePornstarJob;
use App\Models\HairColor;
use App\Models\Ethnicity;
use App\Models\Orientation;
use App\Models\BreastType;
use App\Models\Pornstar;
use Illuminate\Support\Facades\Storage;
use \JsonMachine\Items;
use JsonMachine\JsonDecoder\ExtJsonDecoder;

class JsonParserService
{
    protected $feed;
    // Download the json file and save it to the storage directory

    public function __construct()
    {
        $this->feed = Storage::disk('local')->get('feed.json');
    }

    public function downloadFeed($url)
    {
        try {
            $feed = file_get_contents($url);
            $this->feed = $feed;
            Storage::disk('local')->put('feed.json', $feed);
            return true;
        } catch (\Exception $e) {
            throw $e;
            // return $e->getMessage();
        }
    }

    // Parse the hair colors from the json file using regex and return an array of unique hair colors
    public function parseHairColors()
    {   
        // using regex to extract the unique hair colors
        preg_match_all('/"hairColor":"([^"]+)"/', $this->feed, $matches);
        
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

    // Parse the Ethnicities from the json file using regex and return an array of unique Ethnicities
    public function parseEthnicities()
    {
        preg_match_all('/"ethnicity":"([^"]+)"/', $this->feed, $matches);

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

    // Parse the Orientations from the json file using regex and return an array of unique Orientations
    public function parseOrientations()
    {
        preg_match_all('/"orientation":"([^"]+)"/', $this->feed, $matches);
        $orientations = array_values(array_unique($matches[1]));

        return $orientations;
    }

    // Parse the BreastTypes from the json file using regex and return an array of unique BreastTypes
    public function parseBreastTypes()
    {        
        preg_match_all('/"breastType":"([^"]+)"/', $this->feed, $matches);
        $breastTypes = array_values(array_unique($matches[1]));

        return $breastTypes;
    }

    // using the methods above to parse the unique elements and store them in the database.
    public function updateTypes()
    {
        
        $hairColors = $this->parseHairColors();
        foreach ($hairColors as $color) {
            HairColor::firstOrCreate(['value' => $color]);
        }
        
        $ethnicities = $this->parseEthnicities();
        foreach ($ethnicities as $ethnicity) {
            Ethnicity::firstOrCreate(['value' => $ethnicity]);
        }
        
        $orientations = $this->parseOrientations();
        foreach ($orientations as $orientation) {
            Orientation::firstOrCreate(['value' => $orientation]);
        }
        
        $breastTypes = $this->parseBreastTypes();
        foreach ($breastTypes as $breastType) {
            BreastType::firstOrCreate(['value' => $breastType]);
        }

        return true;
    }

    public static function updatePornstar(array $pornstar): Pornstar
    {
        $stats = $pornstar['attributes']['stats'];
        unset($pornstar['attributes']['stats']);

        $p = Pornstar::updateOrCreate(['ph_id' => $pornstar['ph_id']], $pornstar);
        
        $p->stats()->updateOrCreate(['pornstar_id' => $p->id], $stats);

        if(array_key_exists('aliases', $pornstar)) {
            $aliases = $pornstar['aliases'];
            $p->syncAliases($aliases);
        }

        if(array_key_exists('thumbnails', $pornstar) && count($pornstar['thumbnails']) > 0) {
            if(is_array($pornstar['thumbnails'][0]['urls']) && count($pornstar['thumbnails'][0]['urls'])>0) {
                // echo $pornstar['thumbnails'][0]['urls'][0]."\n";
                $path = 'thumbnails/'.$p->generateImagePath();
                DownloadImageJob::dispatch($pornstar['thumbnails'][0]['urls'][0], $path);
            }
        }

        // update relationships
        if(array_key_exists('hairColor', $pornstar['attributes'])) {
            $p->hairColor = $pornstar['attributes']['hairColor'];
        }

        if(array_key_exists('ethnicity', $pornstar['attributes'])) {
            $p->ethnicity = $pornstar['attributes']['ethnicity'];
        }
        
        if(array_key_exists('orientation', $pornstar['attributes'])) {
            $p->orientation = $pornstar['attributes']['orientation'];
        }

        if(array_key_exists('breastType', $pornstar['attributes'])) {
            $p->breastType = $pornstar['attributes']['breastType'];
        }
    
        return $p;
    }
    
    // Parse the pornstars from the json file using json-machine for efficiency and return an array of pornstars
    public function parsePornstars()
    {
        $path = Storage::disk('local')->path('feed.json');

        $items = Items::fromFile($path, ['pointer' => '/items','decoder' => new ExtJsonDecoder(true)]);
        $count = 0;
        foreach ($items as $pornstar) {
            $pornstar['ph_id'] = $pornstar['id'];
            unset($pornstar['id']);
            $count++;
            JsonParserService::updatePornstar($pornstar);
        }
        return $count;
    }
}