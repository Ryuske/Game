<?php

use App\Game\Events\Combat\EnemyKilled;
use App\Game\Events\Combat\EnemyLossesHeath;
use App\Game\Events\Combat\PlayerAttacks;
use App\Game\Player\Player;
use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Class PlayerAttacksTest
 */
class PlayerAttacksTest extends TestCase
{

    /**
     * Make sure everything works with player attacks
     *
     * @return void
     */
    public function testEnemyAttacks()
    {
        $this->expectsEvents([
            PlayerAttacks::class,
            EnemyKilled::class,
            EnemyLossesHeath::class
        ]);

        $player = new Player;

        do {
            $player->skill()->health = 1000;
            $combat = $player->lookForFight();
        } while (!$combat);

        $combat->enemy->skill()->health = 1;

        for ($i=0; $i<9; $i++) {
            $combat->player()->attack();
        }

        $this->assertLessThan(1, $combat->enemy->skill()->health);
    }

}
