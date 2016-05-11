<?php namespace App\Game\Combat;

use Event;
use App\Game\Combat\Enemies\Map;
use App\Game\Events\Combat\EnemyFound;
use App\Game\Formulas\Combat\Combat as CombatFormulas;
use App\Game\Formulas\Generic as GenericFormulas;
use App\Game\Player\Player;

class CombatScenario
{

    /**
     * $combat = new CombatScenario;
     * $combat->lookForEnemy();
     * $combat->player()->attack() | $combat->player()->run()
     * $combat->enemy()->attack() | $combat->enemy()->run()
     * 
     * You're now fighting <enemy>
     * -- random, who goes first --
     * <enemy> attacks
     * <enemy> does X damage | <enemy> missed
     * Player attacks
     * Player does X damage | Player missed
     * ...
     * Player runs
     * Player successfully ran away | Player failed to run away
     */

    protected $player;

    protected $enemy;

    protected $enemiesMap;

    protected $genericFormulas;

    protected $combatFormulas;

    public function __construct()
    {
        $this->player           = new Player;
        $this->enemiesMap       = new Map;
        $this->genericFormulas  = new GenericFormulas;
        $this->combatFormulas   = new CombatFormulas;
    }

    /**
     * Look for an enemy to fight
     * - You have a 75% change of finding an enemy, otherwise nothing is found
     *
     * @return bool|string
     */
    public function lookForEnemy()
    {
        $isEnemyFound = $this->genericFormulas->probabilityCalculator(75);
        if (!$isEnemyFound) {
            return false;
        }

        $nearByEnemies = $this->enemiesMap->enemiesIn($this->player->location()->city);
        $this->enemy = $this->chooseRandomEnemy($nearByEnemies);

        Event::fire(new EnemyFound($this->enemy));

        $this->beginCombat();
        
        return $this->enemy;
    }

    public function beginCombat() {
        $playerStarts = $this->combatFormulas->PlayerGetsFirstMove();

        if (!$playerStarts) {
            $this->enemy()->attack();
        }
    }

    public function player()
    {
        return new Fighter\Player;
    }

    public function enemy()
    {
        return new Fighter\Enemy($this->enemy);
    }

    protected function chooseRandomEnemy($enemies)
    {
        return $enemies[array_rand($enemies)];
    }
}