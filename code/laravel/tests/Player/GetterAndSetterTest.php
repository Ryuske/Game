<?php

use App\Game\Player\Player;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class GetterAndSetterTest extends TestCase
{
    /**
     * Test Player location getter
     *
     * @return void
     */
    public function testPlayerCityGetter()
    {
        $player = new Player;

        $this->assertEquals('Lattocy', $player->location()->city);
    }

    public function testPlayerCitySetter() {
        $player = new Player;
        $player->location()->city = 'Zandor';

        $this->assertEquals('Zandor', $player->location()->city);
    }
}
