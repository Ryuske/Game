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

    /**
     * Test function to walk to a neighboring city
     *
     * @return void
     */
    public function testWalkingToNeighboringCity()
    {
        $player = new Player;

        $this->assertTrue($player->walkTo('Zandor'));
        $this->assertEquals('Zandor', $player->location()->city);
    }

    /**
     * Test functionality of trying to walk to a non-neighboring city
     *
     * @return void
     */
    public function testWalkingToNonNeighboringCity()
    {
        $player = new Player;

        $this->assertFalse($player->walkTo('Yarie'));
        $this->assertEquals('Lattocy', $player->location()->city);
    }
}
