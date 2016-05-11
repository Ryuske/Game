<?php namespace App\Game\Formulas\Combat;

use App\Game\Formulas\Generic;

/**
 * Class EnemyCombatFormulas
 * @package App\Game\Formulas\Combat
 */
class EnemyCombatFormulas
{

    /**
     * @var
     */
    protected $enemy;

    /**
     * EnemyCombatFormulas constructor.
     * @param $enemy
     */
    public function __construct($enemy)
    {
        $this->enemy = $enemy;
    }

    /**
     * Determines if the attack is a hit or miss
     * - Will get more complicated. For now, 2 out of 3 attacks will hit
     *
     * @return bool
     */
    public function isAttackSuccessful()
    {
        return ((new Generic())->probabilityCalculator(66));
    }

    /**
     * Determines how much damage is dealt
     * - Will get more complicated. For now, damage is anywhere from 0 to 10
     *
     * @return int
     */
    public function damageDealt()
    {
        return rand(0,10);
    }
}
