<?php

namespace Tests\Unit;

use App\Services\JsonParserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JsonParserServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test a json file is downloaded and saved to the storage directory using the downloadFeed method of the JsonParserService class
     */
    public function test_downloadFeed_method()
    {
        $file = base_path('tests/Data/test.json');
        $jps = new JsonParserService();
        $jps->downloadFeed($file);
        $this->assertFileExists('storage/app/feed.json');
    }

    /**
     * Test the parseHairColors method of the JsonParserService class
     */
    public function test_parseHairColors_method()
    {
        $file = base_path('tests/Data/test.json');        
        $jps = new JsonParserService();
        $jps->downloadFeed($file);
        $hairColors = $jps->parseHairColors();
        $this->assertEquals(['Blonde', 'Brunette', 'Black'], $hairColors);
        
    }

    /**
     * Test the parseEthnicities method of the JsonParserService class
     */
    public function test_parseEthnicities_method()
    {
        $file = base_path('tests/Data/test.json');        
        $jps = new JsonParserService();
        $jps->downloadFeed($file);
        $ethnicities = $jps->parseEthnicities();
        $this->assertEquals(['White','Black'], $ethnicities);
    }

    /**
     * Test the parseOrientations method of the JsonParserService class
     */
    public function test_parseOrientations_method()
    {
        $file = base_path('tests/Data/test.json');        
        $jps = new JsonParserService();
        $jps->downloadFeed($file);
        $orientations = $jps->parseOrientations();
        $this->assertEquals(['straight','gay'], $orientations);
    }

    /**
     * Test the parseBreastTypes method of the JsonParserService class
     */
    public function test_parseBreastTypes_method()
    {
        $file = base_path('tests/Data/test.json');        
        $jps = new JsonParserService();
        $jps->downloadFeed($file);
        $breastTypes = $jps->parseBreastTypes();
        $this->assertEquals(['A', 'C', 'E', 'D', 'B'], $breastTypes);
    }

    /**
     * Test the downloadFeed method of the JsonParserService class
     */
    public function test_downloadFeed_method_exception()
    {
        $file = base_path('tests/Data/test1.json');
        $jps = new JsonParserService();
        $this->expectException(\Exception::class);
        $jps->downloadFeed($file);
    }

    /**
     * Test the updateTypes method of the JsonParserService class
     */
    public function test_updateTypes_method()
    {
        $file = base_path('tests/Data/test.json');        
        $jps = new JsonParserService();
        $jps->downloadFeed($file);
        
        $jps->updateTypes();

        $this->assertDatabaseHas('hair_colors', ['value' => 'Blonde']);
        $this->assertDatabaseHas('hair_colors', ['value' => 'Brunette']);
        $this->assertDatabaseHas('hair_colors', ['value' => 'Black']);
    }
}
