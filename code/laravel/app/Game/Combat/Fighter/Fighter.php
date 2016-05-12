<?php namespace App\Game\Combat\Fighter;

/**
 * Interface Fighter
 * @package App\Game\Combat\Fighter
 */
interface Fighter
{

    /**
     * @return mixed
     */
    function attack();

    /**
     * @return mixed
     */
    function heal();

    /**
     * @return mixed
     */
    function run();
}