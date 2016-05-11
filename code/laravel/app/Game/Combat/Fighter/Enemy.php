<?php namespace App\Game\Combat\Fighter;

use Event;
use App\Game\Collections\CombatDamageCollection;
use App\Game\Events\Combat\EnemyAttacks;
use App\Game\Formulas\Combat\Combat as CombatFormulas;

class Enemy implements Fighter
{

    /**
     * @var
     */
    protected $enemy;

    protected $combatFormulas;

    public function __construct($enemy)
    {
        $this->enemy            = $enemy;
        $this->combatFormulas   = new CombatFormulas;
    }

    /**
     * @return mixed
     */
    function attack()
    {
        $attackerMissed = !$this->combatFormulas->enemy($this->enemy)->isAttackSuccessful();
        $damageDealt    = $this->combatFormulas->enemy($this->enemy)->damageDealt();

        $combatDamage = new CombatDamageCollection([
            'attacker'          => $this->enemy,
            'defender'          => 'Player',
            'attacker_missed'   => ($attackerMissed) ? 'true' : 'false',
            'damage_dealt'      => $damageDealt
        ]);

        Event::fire(new EnemyAttacks($combatDamage));
    }

    /**
     * @return mixed
     */
    function heal()
    {
        // For now, enemies only do damage
    }

    /**
     * @return mixed
     */
    function run()
    {
        // For now, enemies only do damage
    }
}