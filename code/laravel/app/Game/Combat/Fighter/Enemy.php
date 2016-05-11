<?php namespace App\Game\Combat\Fighter;

use Event;
use App\Game\Collections\CombatDamageCollection;
use App\Game\Events\Combat\EnemyAttacks;
use App\Game\Formulas\Combat\Combat as CombatFormulas;

/**
 * Class Enemy
 * @package App\Game\Combat\Fighter
 */
class Enemy implements Fighter
{

    /**
     * @var
     */
    protected $enemy;

    /**
     * @var CombatFormulas
     */
    protected $combatFormulas;

    /**
     * Enemy constructor.
     * @param $enemy
     */
    public function __construct($enemy)
    {
        $this->enemy            = $enemy;
        $this->combatFormulas   = new CombatFormulas;
    }

    /**
     * Make the enemy do an attack
     *
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
     * Have the enemy heal themselves
     *
     * @return mixed
     */
    function heal()
    {
        // For now, enemies only do damage
    }

    /**
     * Make the enemy attempt to flee from combat
     *
     * @return mixed
     */
    function run()
    {
        // For now, enemies only do damage
    }
}