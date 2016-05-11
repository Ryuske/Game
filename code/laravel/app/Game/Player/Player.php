<?php namespace App\Game\Player;

use Event;
use App\Game\Collections\LocationCollection;
use App\Game\Combat\CombatScenario;
use App\Game\Events\Combat\EnemyNotFound;
use App\Game\Movement\Movement;

/**
 * Class Player
 * @package App\Game\Player
 */
class Player
{

    /**
     * @var Movement
     */
    protected $movement;

    /**
     * Data pertaining the given player
     *
     * @var array
     */
    protected $playerData = [
        'location' => [
            'city' => 'Lattocy'
        ]
    ];

    /**
     * Player constructor.
     */
    public function __construct()
    {
        $this->movement = new Movement;
    }

    /**
     * Return an instance of a LocationCollection with the data set to the players current data
     *
     * @return $this
     */
    public function location() {
        return new LocationCollection($this->playerData['location']);
    }

    /**
     * Implements control to walk to different cities
     *
     * @param $city
     * @return bool
     * @throws \Exception
     */
    public function walkTo($city)
    {
        $player = $this->movement->player($this);

        if ($player->CanWalk($city)) {
            $player->walkTo($city);

            return true;
        }

        return false;
    }

    /**
     * Implements control to look for a fight
     * If a fight is found, return the CombatScenario
     *
     * @return CombatScenario|bool
     */
    public function lookForFight()
    {
        $combat = new CombatScenario;
        $enemy = $combat->lookForEnemy();
        
        if (!$enemy) {
            Event::fire(new EnemyNotFound);

            return false;
        }

        return $combat;
    }
}