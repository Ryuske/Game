<?php namespace App\Game\Movement;

use App\Game\Movement\Person\Person;
use App\Game\Movement\Person\Player as PlayerContract;
use App\Game\Player\Player;
use Map;

class Movement
{

    /**
     * Provide the contract for the given kind of Person
     *
     * @var Person
     */
    protected $person;

    /**
     * Set the Person contract to a Player
     *
     * @param Player $player
     * @return $this
     */
    public function player(Player $player)
    {
        $this->person = new PlayerContract($player);
        
        return $this;
    }

    /**
     * Implement validation to check if the Person can walk to the desired city
     *
     * @param $desired_city
     * @return bool
     * @throws \Exception
     */
    public function canWalk($desired_city)
    {
        if (!$this->person instanceof Person) {
            throw new \Exception('No Person found. Method only available after selecting a Person.');
        }

        return $this->person->canWalk($desired_city);
    }

    /**
     * Implement control to move the Person to the given city
     *
     * @param $city
     * @throws \Exception
     */
    public function walkTo($city)
    {
        if (!$this->person instanceof Person) {
            throw new \Exception('No Person found. Method only available after selecting a Person.');
        }

        $this->person->walkTo($city);
    }

}