<?php

use App\Game\Player\Player;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class MovementTest extends TestCase
{
    /**
     * Test nearByCities functionality.
     *
     * @return void
     */
    public function testPlayerNearbyCities()
    {
        $player = new Player;
        
        $this->assertArraySubset([
            'NorthEast' => 'Zandor',
            'SouthWest' => 'Jaubridge'
        ], $player->location()->nearByCities());
    }

    public function testWalkingToNeighboringCity()
    {
        $player = new Player;

        $this->assertTrue($player->walkTo('Zandor'));
        $this->assertEquals('Zandor', $player->location()->city);
    }

    public function testWalkingToNonNeighboringCity()
    {
        $player = new Player;

        $this->assertFalse($player->walkTo('Yarie'));
        $this->assertEquals('Lattocy', $player->location()->city);
    }
}
