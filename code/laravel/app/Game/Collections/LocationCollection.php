<?php namespace App\Game\Collections;

use App\Game\Movement\Map;

class LocationCollection
{

    /**
     * The attributes known or available to the collection
     *
     * @var array
     */
    protected $attributes = [
        'city'
    ];

    /**
     * The original set of data
     *
     * @var
     */
    protected $dataStore;

    /**
     * The data localized to the given collection
     *
     * @var
     */
    protected $data;

    /**
     * @var Map
     */
    protected $map;

    /**
     * Create a collection with the values taken from the original data source
     *
     * LocationCollection constructor.
     * @param $data
     */
    public function __construct(&$data)
    {
        $this->dataStore = &$data;
        $this->map = new Map;
        
        foreach ($this->attributes as $attribute) {
            $this->data[$attribute] = (array_key_exists($attribute, $data)) ? $data[$attribute] : NULL;
        }
    }

    /**
     * Magic method to get a given attribute from the collection
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * Magic method to set a given attribute to a given value in the collection
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Find the neighboring cities of the city in the localized collection
     *
     * @return mixed
     */
    public function nearByCities()
    {
        return $this->map->neighboringCities($this->data['city']);
    }

    /**
     * Save the localized data to the original data source
     *
     * @return void
     */
    public function save()
    {
        $this->dataStore = $this->data;
    }
}