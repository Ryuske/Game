<?php namespace App\Game\Formulas;

/**
 * Class Generic
 * @package App\Game\Formulas
 */
class Generic
{

    /**
     * Calculates true or false using the given probability percentage
     *
     * @param $probability
     * @return bool
     */
    public function probabilityCalculator($probability) {
        $modifier = rand(1, 100);

        return ($modifier <= $probability);
    }
}
