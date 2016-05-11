<?php

use App\Game\Player\Player;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SkillsCollectionTest extends TestCase
{

    /**
     * Test SkillsCollection getter with a known attribute
     *
     * @return void
     */
    public function testSkillsCollectionAttributeGetter()
    {
        $player = new Player;

        $this->assertEquals(10, $player->skill()->health);
    }

    /**
     * Test LocationCollection setter & saving data to original data source
     *
     * @return void
     */
    public function testLocationCollectionAttributeSetter()
    {
        $player = new Player;
        $player->skill()->attack++;

        $this->assertEquals(2, $player->skill()->attack);
    }
}
