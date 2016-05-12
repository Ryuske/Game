<?php namespace App\Game\Events\Combat;

class EnemyLossesHeath
{

    /**
     * @var
     */
    public $heathLost;

    /**
     * @var
     */
    public $heathLeft;

    /**
     * Handle the event the enemy losing heath
     * - This is meant to be broadcast and consumed with websockets. Til then, just echo stuff out
     *
     * EnemyAttacks constructor.
     * @param CombatDamageCollection $combatDamage
     */
    public function __construct($enemy, $healthLost, $healthLeft)
    {
        $this->healthLost   = $healthLost;
        $this->heathLeft    = $healthLeft;

        echo $enemy->name . " lost $healthLost health; $healthLeft heath remaining.\n";
    }
}