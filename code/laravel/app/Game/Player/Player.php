<?php namespace App\Game\Player;

use App\Game\Movement\Map;
use App\Game\Movement\Movement;

class Player {

    /**
     * @var Movement
     */
    protected $movement;

    /**
     * @var Map
     */
    protected $map;

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
     * Specific data immediately queued for access
     *
     * @var
     */
    protected $queuedData;

    /**
     * Player constructor.
     */
    public function __construct()
    {
        $this->movement = new Movement;
        $this->map      = new Map;
    }

    /**
     * Set the given property within immediately queued data
     * Properties set here are persistent
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value) {
        $this->queuedData[$name] = $value;
    }

    /**
     * Get the given property from the immediately queued data
     *
     * @param $name
     * @return mixed
     */
    public function __get($name) {
        return $this->queuedData[$name];
    }

    /**
     * Queue location data for immediate access
     *
     * @return $this
     */
    public function location() {
        $this->queuedData = &$this->playerData['location'];

        return $this;
    }

    /**
     * Find the neighboring cities of the queued city
     *
     * @return mixed
     */
    public function nearByCities() {
        return $this->map->neighboringCities($this->queuedData['city']);
    }

    /**
     * Implements control to walk to different cities
     *
     * @param $city
     * @return bool
     * @throws \Exception
     */
    public function walkTo($city) {
        $player = $this->movement->player($this);

        if ($player->CanWalk($city)) {
            $player->walkTo($city);

            return true;
        }

        return false;
    }
}