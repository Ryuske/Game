<?php namespace App\Game\Events\Combat;

use App\Game\Collections\CombatDamageCollection;

class EnemyAttacks
{

    public $combatDamage;

    public function __construct(CombatDamageCollection $combatDamage)
    {
        $this->combatDamage = $combatDamage;
        print_r($this->combatDamage->all());
    }
}