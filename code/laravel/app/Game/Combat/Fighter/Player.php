<?php namespace App\Game\Combat\Fighter;

use App\Game\Combat\CombatScenario;
use App\Game\Events\Combat\EnemyKilled;
use App\Game\Events\Combat\PlayerAttacks;
use App\Game\Events\Player\EnemyLossesHeath;
use Event;
use App\Game\Collections\CombatDamageCollection;
use App\Game\Formulas\Combat\Combat as CombatFormulas;

/**
 * Class Player
 * @package App\Game\Combat\Fighter
 */
class Player implements Fighter
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
     * Make the Player do an attack
     *
     * @return mixed
     */
    function attack()
    {
        $attackerMissed = !$this->combatFormulas->player($this->combatScenario->player)->isAttackSuccessful();
        $damageDealt    = $this->combatFormulas->player($this->combatScenario->player)->damageDealt();
        $enemyKilled    = false;

        $combatDamage = new CombatDamageCollection([
            'attacker'          => 'Player',
            'defender'          => $this->combatScenario->enemy->info()->name,
            'attacker_missed'   => $attackerMissed,
            'damage_dealt'      => $damageDealt
        ]);

        Event::fire(new PlayerAttacks($combatDamage));

        if (!$attackerMissed) {
            $this->combatScenario->enemy->skill()->health -= $damageDealt;

            // All of this should be moved to enemy->died
            if ($this->combatScenario->enemy->skill()->health <= 0) {
                $enemyKilled = true;

                Event::fire(new EnemyKilled($this->combatScenario->enemy));

                unset($this);
            }
        }

        if (!$enemyKilled) {
            $this->combatScenario->enemy()->attack();
        }
    }

    /**
     * Have the Player heal themselves
     *
     * @return mixed
     */
    function heal()
    {
    }

    /**
     * Make the Player attempt to flee from combat
     *
     * @return mixed
     */
    function run()
    {
    }
}