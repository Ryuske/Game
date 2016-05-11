<?php namespace App\Game\Events\Combat;

/**
 * Class EnemyFound
 * @package App\Game\Events\Combat
 */
class EnemyFound
{

    /**
     * @var
     */
    public $enemy;

    /**
     * Handle the event of an enemy being found
     * - This is meant to be broadcast and consumed with websockets. Til then, just echo stuff out
     *
     * EnemyFound constructor.
     * @param $enemy
     */
    public function __construct($enemy)
    {
        $this->enemy = $enemy;
        echo 'Enemy Found: ' . $this->enemy . "\n";
    }
}