<?php

use App\Game\Player\Player;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LocationCollectionTest extends TestCase
{
    /**
     * Test LocationCollection getter with a known attribute
     *
     * @return void
     */
    public function testLocationCollectionAttributeGetter()
    {
        $player = new Player;

        $this->assertEquals('Lattocy', $player->location()->city);
    }

    /**
     * Test LocationCollection setter & saving data to original data source
     *
     * @return void
     */
    public function testLocationCollectionAttributeSetter()
    {
        $player = new Player;

        $location = $player->location();
        $location->city = 'Zandor';
        $location->save();

        $this->assertEquals('Zandor', $location->city);
        $this->assertEquals('Zandor', $player->location()->city);
    }
}
