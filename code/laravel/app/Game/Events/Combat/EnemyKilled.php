<?php namespace App\Game\Events\Combat;

use App\Game\Combat\Enemies\Enemy;

class EnemyKilled
{

    /**
     * @var CombatDamageCollection
     */
    public $enemy;

    /**
     * Handle the event an enemy attacking
     * - This is meant to be broadcast and consumed with websockets. Til then, just echo stuff out
     *
     * EnemyAttacks constructor.
     * @param CombatDamageCollection $combatDamage
     */
    public function __construct(Enemy $enemy)
    {
        $this->enemy = $enemy;

        echo $this->enemy->info()->name . ' was killed!';
    }
}