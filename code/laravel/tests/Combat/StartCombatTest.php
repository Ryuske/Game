<?php

use App\Game\Combat\CombatScenario;
use App\Game\Player\Player;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StartCombatTest extends TestCase
{

    /**
     *  Make sure once an enemy is found, that a CombatScenario instance is returned
     *
     * @return void
     */
    public function testCombatDamageCollection()
    {
        $player = new Player;

        do {
            $combat = $player->lookForFight();
        } while (!$combat);

        $this->assertInstanceOf(CombatScenario::class, $combat);
    }
}
