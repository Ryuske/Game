<?php namespace App\Game\Combat\Enemies;

use \App\Game\Movement\Map as GameMap;

class Map extends GameMap
{

    protected $enemies = [
        'Rafe',
        'Eci',
        'Xev',
        'Retaa',
        'Swodin',
        'Erif',
        'Dryad',
        'Chimera',
        'Krad',
        'Gast'
    ];

    protected $enemyLocations = [
        'Yarie' => [
            'Eci',
            'Retaa',
            'Dryad',
            'Gast'
        ],
        'Zandor' => [
            'Retaa',
            'Swodin',
            'Krad'
        ],
        'Lattocy' => [
            'Retaa',
            'Eci',
            'Dryad'
        ],
        'Jaubridge' => [
            'Retaa',
            'Erif',
            'Swodin',
            'Chimera'
        ],
        'Aqivale' => [
            'Retaa',
            'Swodin',
            'Krad'
        ],
        'Dixmont' => [
            'Rafe',
            'Retaa',
            'Erif',
            'Krad'
        ],
        'Quarg' => [
            'Retaa',
            'Eci',
            'Xev',
            'Dryad',
            'Gast'
        ]
    ];

    /**
     * Returns an array of enemies found in the given location
     * - returns NULL if location has no enemies OR location doesn't exist
     *
     * @param $location
     * @return array|null
     */
    public function enemiesIn($location)
    {
        if (array_key_exists($location, $this->enemyLocations)) {
            return $this->enemyLocations[$location];
        }

        return NULL;
    }
}