<?php namespace App\Game\Events\Combat;

class EnemyFound
{

    public $enemy;

    public function __construct($enemy)
    {
        $this->enemy = $enemy;
        echo 'Enemy Found: ' . $this->enemy . "\n";
    }
}