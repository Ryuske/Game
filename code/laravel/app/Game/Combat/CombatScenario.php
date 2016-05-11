<?php namespace App\Game\Combat;

use App\Game\Combat\Enemies\Map;
use App\Game\Formulas\GenericFormulas;
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
t
    protected $enemiesMap;

    protected $genericFormulas;

    public function __construct()
    {
        $this->player = new Player;
        $this->enemiesMap = new Map;
        $this->genericFormulas = new GenericFormulas;
    }

    /**
     * Look for an enemy to fight
     * - You have a 75% change of finding an enemy, otherwise nothing is found
     */
    public function lookForEnemy()
    {
        $isEnemyFound = $this->genericFormulas->probabilityCalculator(75);
        if (!$isEnemyFound) {
            return false;
        }

        $nearByEnemies = $this->enemiesMap->enemiesIn($this->player->location()->city);
        $this->enemy = $this->chooseRandomEnemy($nearByEnemies);
    }

    protected function chooseRandomEnemy($enemies)
    {
        return array_rand($enemies);
    }

    public function player()
    {
        return new Fighter\Player;
    }

    public function enemy()
    {

    }
}