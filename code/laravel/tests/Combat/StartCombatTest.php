<?php

use App\Game\Combat\CombatScenario;
use App\Game\Events\Combat\EnemyFound;
use App\Game\Events\Combat\EnemyNotFound;
use App\Game\Player\Player;
use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Class StartCombatTest
 */
class StartCombatTest extends TestCase
{

    /**
     * Make sure once an enemy is found, that a CombatScenario instance is returned
     * Also make sure the correct events are fired if an enemy is found & an enemy is not found
     *
     * @return void
     */
    public function testStartCombat()
    {
        $this->expectsEvents([
            EnemyFound::class,
            EnemyNotFound::class
        ]);

        $player = new Player;

        for ($i=0; $i<10; $i++) {
            $player->lookForFight();
        }

        do {
            $combat = $player->lookForFight();
        } while (!$combat);

        $this->assertInstanceOf(CombatScenario::class, $combat);
    }
}
