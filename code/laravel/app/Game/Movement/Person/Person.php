<?php namespace App\Game\Movement\Person;

interface Person {

    /**
     * @param $desired_city
     * @return bool
     */
    function canWalk($desired_city);

    /**
     * @param $city
     * @return void
     */
    function walkTo($city);
}