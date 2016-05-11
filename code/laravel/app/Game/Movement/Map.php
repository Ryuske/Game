<?php namespace App\Game\Movement;

class Map 
{

    /**
     * List of the known nations within the game
     *
     * @var array
     */
    protected $nations = [
        'Tenedarg',
        'Atria',
        'Boshia',
        'Ustax'
    ];

    /**
     * List of the known cities within the game (within all nations)
     *
     * @var array
     */
    protected $cities = [
        'Tenedarg' => [
            'Yarie',
            'Zandor',
            'Lattocy',
            'Jaubridge',
            'Aqivale',
            'Dixmont',
            'Quarg'
        ]
    ];

    /**
     * Associate the physical locations of the various cities
     *
     * @var array
     */
    protected $neighborCities = [
        'Yarie' => [
            'East' => 'Zandor'
        ],
        'Zandor' => [
            'West'      => 'Yarie',
            'SouthWest' => 'Lattocy'
        ],
        'Lattocy' => [
            'NorthEast' => 'Zandor',
            'SouthWest' => 'Jaubridge'
        ],
        'Jaubridge' => [
            'NorthEast' => 'Lattocy',
            'SouthEast' => 'Aqivale'
        ],
        'Aqivale' => [
            'NorthWest' => 'Jaubridge',
            'West'      => 'Quarg',
            'SouthWest' => 'Dixmont'
        ],
        'Dixmont' => [
            'NorthEast' => 'Aqivale',
            'NorthWest' => 'Quarg'
        ],
        'Quarg' => [
            'East'      => 'Aqivale',
            'SouthEast' => 'Dixmont'
        ]
    ];

    /**
     * Check if the given cities are neighboring
     *
     * @param $cityA
     * @param $cityB
     * @return bool
     */
    public function citiesAreNeighbors($cityA, $cityB)
    {
        return in_array($cityB, $this->neighborCities[$cityA]);
    }

    /**
     * Find the neighboring cities of the given city
     *
     * @param $city
     * @return mixed
     */
    public function neighboringCities($city)
    {
        return $this->neighborCities[$city];
    }
}