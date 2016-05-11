<?php namespace App\Game\Combat;

use Event;
use App\Game\Combat\Enemies\Map;
use App\Game\Events\Combat\EnemyFound;
use App\Game\Formulas\Combat\Combat as CombatFormulas;
use App\Game\Formulas\Generic as GenericFormulas;
use App\Game\Player\Player;

/**
 * Class CombatScenario
 * @package App\Game\Combat
 */
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

    /**
     * @var Player
     */
    public $player;

    /**
     * @var
     */
    public $enemy;

    /**
     * @var Map
     */
    protected $enemiesMap;

    /**
     * @var GenericFormulas
     */
    protected $genericFormulas;

    /**
     * @var CombatFormulas
     */
    protected $combatFormulas;

    /**
     * CombatScenario constructor.
     */
    public function __construct(Player &$player)
    {
        $this->player           = $player;
        $this->enemiesMap       = new Map;
        $this->genericFormulas  = new GenericFormulas;
        $this->combatFormulas   = new CombatFormulas;
    }

    /**
     * Look for an enemy to fight
     * - You have a 75% change of finding an enemy, otherwise nothing is found
     *
     * @return bool|CombatDamageCollection
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

        return $this->beginCombat();
    }

    /**
     * If an enemy is found, begin the combat
     */
    public function beginCombat() {
        $playerStarts = $this->combatFormulas->DoesPlayerGetFirstMove();

        if (!$playerStarts) {
            return $this->enemy()->attack();
        }
    }

    /**
     * Accessor to player combat actions
     *
     * @return Fighter\Player
     */
    public function player()
    {
        return new Fighter\Player;
    }

    /**
     * Accessor to enemy combat actions
     *
     * @return Fighter\Enemy
     */
    public function enemy()
    {
        return new Fighter\Enemy($this);
    }

    /**
     * Pick an enemy at random out of the list given
     * - Eventually this will be more complex, accounting for the rarity of the enemies
     *
     * @param $enemies
     * @return mixed
     */
    protected function chooseRandomEnemy($enemies)
    {
        return $enemies[array_rand($enemies)];
    }
}