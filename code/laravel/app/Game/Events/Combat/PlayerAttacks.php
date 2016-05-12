<?php namespace App\Game\Events\Combat;

use App\Game\Collections\CombatDamageCollection;

/**
 * Class PlayerAttacks
 * @package App\Game\Events\Combat
 */
class PlayerAttacks
{

    /**
     * @var CombatDamageCollection
     */
    public $combatDamage;

    /**
     * Handle the event a player attacking
     * - This is meant to be broadcast and consumed with websockets. Til then, just echo stuff out
     * PlayerAttacks constructor.
     *
     * @param CombatDamageCollection $combatDamage
     */
    public function __construct(CombatDamageCollection $combatDamage)
    {
        $this->combatDamage = $combatDamage;

        if ($this->combatDamage->attacker_missed) {
            echo 'Player missed ' . $this->combatDamage->defender . "\n";
        } else {
            echo "Player attack landed!\n";
        }
    }
}