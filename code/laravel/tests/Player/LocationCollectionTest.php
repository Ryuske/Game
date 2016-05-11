<?php

use App\Game\Player\Player;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LocationCollectionTest extends TestCase
{
    /**
     * Test Player location getter
     *
     * @return void
     */
    public function testLocationCollectionAttributeGetter()
    {
        $player = new Player;

        $this->assertEquals('Lattocy', $player->location()->city);
    }

    public function testLocationCollectionAttributeSetter() {
        $player = new Player;

        $location = $player->location();
        $location->city = 'Zandor';
        $location->save();

        $this->assertEquals('Zandor', $player->location()->city);
    }
}
