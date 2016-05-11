<?php namespace App\Game\Player;

use App\Game\Collections\LocationCollection;
use App\Game\Movement\Movement;

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
     * Queue location data for immediate access
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
}