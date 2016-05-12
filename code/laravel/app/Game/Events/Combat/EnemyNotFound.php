<?php namespace App\Game\Events\Combat;

/**
 * Class EnemyNotFound
 * @package App\Game\Events\Combat
 */
class EnemyNotFound
{

    /**
     * Handle the event of an enemy NOT being found
     * - This is meant to be broadcast and consumed with websockets. Til then, just echo stuff out
     * EnemyNotFound constructor.
     *
     */
    public function __construct()
    {
        echo 'No Enemies Found!';
    }
}