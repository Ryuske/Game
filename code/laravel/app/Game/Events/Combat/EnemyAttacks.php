<?php namespace App\Game\Events\Combat;

use App\Game\Collections\CombatDamageCollection;

/**
 * Class EnemyAttacks
 * @package App\Game\Events\Combat
 */
class EnemyAttacks
{

    /**
     * @var CombatDamageCollection
     */
    public $combatDamage;

    /**
     * Handle the event an enemy attacking
     * - This is meant to be broadcast and consumed with websockets. Til then, just echo stuff out
     *
     * EnemyAttacks constructor.
     * @param CombatDamageCollection $combatDamage
     */
    public function __construct(CombatDamageCollection $combatDamage)
    {
        $this->combatDamage = $combatDamage;
        print_r($this->combatDamage->all());
    }
}