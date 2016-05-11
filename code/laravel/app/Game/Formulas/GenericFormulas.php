<?php namespace App\Game\Formulas;

class GenericFormulas
{

    public function probabilityCalculator($probability) {
        $modifier = rand(1, 100);
        
        return ($modifier <= $probability);
    }
}
