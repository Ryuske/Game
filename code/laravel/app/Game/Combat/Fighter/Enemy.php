<?php namespace App\Game\Combat\Fighter;

use App\Game\Combat\CombatScenario;
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
     * @var CombatScenario
     */
    protected $combatScenario;

    /**
     * @var CombatFormulas
     */
    protected $combatFormulas;


    /**
     * Enemy constructor.
     * 
     * @param CombatScenario $combatScenario
     */
    public function __construct(CombatScenario $combatScenario)
    {
        $this->combatScenario = $combatScenario;
        $this->combatFormulas = new CombatFormulas;
    }

    /**
     * Make the enemy do an attack
     *
     * @return mixed
     */
    function attack()
    {
        $attackerMissed = !$this->combatFormulas->enemy($this->combatScenario->enemy)->isAttackSuccessful();
        $damageDealt    = $this->combatFormulas->enemy($this->combatScenario->enemy)->damageDealt();

        $combatDamage = new CombatDamageCollection([
            'attacker'          => $this->combatScenario->enemy->info()->name,
            'defender'          => 'Player',
            'attacker_missed'   => $attackerMissed,
            'damage_dealt'      => $damageDealt
        ]);

        Event::fire(new EnemyAttacks($combatDamage));

        if (!$attackerMissed) {
            $this->combatScenario->player->skill()->health -= $damageDealt;
        }
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