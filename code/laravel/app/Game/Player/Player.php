<?php namespace App\Game\Player;

use App\Game\Collections\SkillsCollection;
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
        'skills' => [
            'attack'    => 1,
            'defence'   => 1,
            'strength'  => 1,
            'heath'     => 10,
            'archery'   => 1,
            'smelting'  => 1,
            'smithing'  => 1,
            'mining'    => 1,
            'coding'    => 1,
            'fletching' => 1,
            'alchemy'   => 1,
            'cooking'   => 1,
            'breeding'  => 1
        ],
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
     * Return an instance of a SkillsCollection with the data set to the players current data
     *
     * @return SkillsCollection
     */
    public function skill() {
        return new SkillsCollection($this->playerData['skills']);
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
        $combat = new CombatScenario($this);
        $enemy = $combat->lookForEnemy();
        
        if (!$enemy) {
            Event::fire(new EnemyNotFound);

            return false;
        }

        return $combat;
    }

    /**
     * Controls a players death - Game Over
     */
    public function died()
    {
        die('Player died!');
    }
}