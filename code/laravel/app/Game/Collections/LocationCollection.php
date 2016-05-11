<?php namespace App\Game\Collections;

use App\Game\Movement\Map;

class LocationCollection
{

    protected $attributes = [
        'city'
    ];

    protected $dataStore;

    protected $data;
    
    protected $map;
    
    public function __construct(&$data)
    {
        $this->dataStore = &$data;
        $this->map = new Map;
        
        foreach ($this->attributes as $attribute) {
            $this->data[$attribute] = (array_key_exists($attribute, $data)) ? $data[$attribute] : NULL;
        }
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Find the neighboring cities of the queued city
     *
     * @return mixed
     */
    public function nearByCities()
    {
        return $this->map->neighboringCities($this->data['city']);
    }

    public function save()
    {
        $this->dataStore = $this->data;
    }
}