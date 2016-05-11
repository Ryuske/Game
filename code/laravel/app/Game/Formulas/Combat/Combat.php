<?php namespace App\Game\Formulas\Combat;

/**
 * Class Combat
 * @package App\Game\Formulas\Combat
 */
class Combat
{

    /**
     * Decides whether or not the player gets to attack first
     * - This will be more complicated eventually, based on enemy & player stats
     *
     * @return bool
     */
    public function DoesPlayerGetFirstMove() {
        $modifier = rand(1, 2);

        return (1 === $modifier);
    }

    /**
     * Accessor for combat formulas specifically relating to enemies
     *
     * @param $enemy
     * @return EnemyCombatFormulas
     */
    public function enemy($enemy)
    {
        return new EnemyCombatFormulas($enemy);
    }
}
