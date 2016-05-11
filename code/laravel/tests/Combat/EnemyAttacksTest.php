<?php

use App\Game\Events\Combat\EnemyAttacks;
use App\Game\Events\Player\PlayerLossesHeath;
use App\Game\Player\Player;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EnemyAttacksTest extends TestCase
{

    /**
     *
     * @return void
     */
    public function testEnemyAttacks()
    {
        $this->expectsEvents([
            EnemyAttacks::class,
            PlayerLossesHeath::class
        ]);

        $player = new Player;
        $player->skill()->health = 1000;

        do {
            $combat = $player->lookForFight();
        } while (!$combat);

        for ($i=0; $i<9; $i++) {
            $combat->enemy()->attack();
        }

        $this->assertLessThan(1000, $player->skill()->health);
    }

}
