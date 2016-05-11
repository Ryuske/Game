<?php namespace App\Game\Events\Player;

/**
 * Class PlayerLossesHeath
 * @package App\Game\Events\Player
 */
class PlayerLossesHeath
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
     * Handle the event the player lossing heath
     * - This is meant to be broadcast and consumed with websockets. Til then, just echo stuff out
     *
     * EnemyAttacks constructor.
     * @param CombatDamageCollection $combatDamage
     */
    public function __construct($healthLost, $healthLeft)
    {
        $this->healthLost   = $healthLost;
        $this->heathLeft    = $healthLeft;

        echo "Player lost $healthLost health; $healthLeft heath remaining.\n";
    }
}