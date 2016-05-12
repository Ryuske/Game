<?php namespace App\Game\Combat\Enemies;

use App\Game\Collections\EnemyInfoCollection;
use App\Game\Collections\EnemySkillsCollection;

class Enemy
{

    protected $info;

    protected $skills;

    public function __construct($enemy)
    {
        $this->info     = $enemy->info;
        $this->skills   = $enemy->skills;
    }

    public function info() {
        return new EnemyInfoCollection($this, $this->info);
    }

    public function skill() {
        return new EnemySkillsCollection($this, $this->skills);
    }

    public function died() {
        
    }
}