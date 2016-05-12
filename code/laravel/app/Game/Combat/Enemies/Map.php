<?php namespace App\Game\Combat\Enemies;

use \App\Game\Movement\Map as GameMap;

/**
 * Class Map
 * @package App\Game\Combat\Enemies
 */
class Map extends GameMap
{

    /**
     * @var array
     */
    protected $enemies = [
        'Rafe'    => [],
        'Eci'     => [
            'info'   => [
                'name'   => 'Eci',
                'rarity' => 20, // Probability of finding this enemy (X% of enemies will be this)
            ],
            'skills' => [
                'health'   => 20,
                'attack'   => 3,
                'defence'  => 1,
                'strength' => 2
            ]
        ],
        'Xev'     => [],
        'Retaa'   => [
            'info'   => [
                'name'   => 'Retaa',
                'rarity' => 90,
            ],
            'skills' => [
                'health'   => 5,
                'attack'   => 1,
                'defence'  => 1,
                'strength' => 1
            ]
        ],
        'Swodin'  => [],
        'Erif'    => [],
        'Dryad'   => [
            'info'   => [
                'name'   => 'Dryad',
                'rarity' => 33,
            ],
            'skills' => [
                'health'   => 10,
                'attack'   => 2,
                'defence'  => 3,
                'strength' => 1
            ]
        ],
        'Chimera' => [],
        'Krad'    => [],
        'Gast'    => [
            'info'   => [
                'name'   => 'Gast',
                'rarity' => 33,
            ],
            'skills' => [
                'health'   => 10,
                'attack'   => 1,
                'defence'  => 1,
                'strength' => 1
            ]
        ]
    ];

    /**
     * @var array
     */
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
            $enemies = [];

            foreach ($this->enemyLocations[$location] as $enemyName) {
                $enemies[$enemyName] = (new Enemy($enemyName));
            }
            return $enemies;
        }

        return NULL;
    }
}