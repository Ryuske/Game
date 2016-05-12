<?php namespace App\Game\Combat\Enemies;

use App\Game\Collections\EnemyInfoCollection;
use App\Game\Collections\EnemySkillsCollection;

/**
 * Class Enemy
 * @package App\Game\Combat\Enemies
 */
class Enemy
{

    /**
     * @var
     */
    protected $info;

    /**
     * @var
     */
    protected $skills;

    /**
     * Enemy constructor.
     *
     * @param $enemy
     */
    public function __construct($enemy)
    {
        $this->info     = $enemy['info'];
        $this->skills   = $enemy['skills'];
    }

    /**
     * Get access to all the info data related to this enemy
     *
     * @return EnemyInfoCollection
     */
    public function info() {
        return new EnemyInfoCollection($this, $this->info);
    }

    /**
     * Get access to all the skill data related to this enemy
     *
     * @return EnemySkillsCollection
     */
    public function skill() {
        return new EnemySkillsCollection($this, $this->skills);
    }

    /**
     * Make this?
     */
    public function died() {

    }
}