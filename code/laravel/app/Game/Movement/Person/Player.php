<?php namespace App\Game\Movement\Person;

use App\Game\Movement\Map;

class Player implements Person
{

    /**
     * @var \App\Game\Player\Player
     */
    private $player;

    /**
     * @var Map
     */
    private $map;

    public function __construct(\App\Game\Player\Player $player)
    {
        $this->map      = new Map;
        $this->player   = $player;
    }

    /**
     * Make sure the player can walk to the desired city
     * Only requirement to be able to walk to a specific city is if it's a neighboring city
     *
     * @param $desired_city
     * @return bool
     */
    function canWalk($desired_city)
    {
        if ($this->map->citiesAreNeighbors($this->player->location()->city, $desired_city)) {
            return true;
        }

        return false;
    }

    /**
     * Moves the player to the given city
     *
     * @param $city
     */
    function walkTo($city)
    {
        $location = $this->player->location();
        $location->city = $city;
        $location->save();
    }
}