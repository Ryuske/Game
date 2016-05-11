<?php namespace App\Game\Collections;

use App\Game\Events\Player\PlayerLossesHeath;
use App\Game\Player\Player;
use Event;

class SkillsCollection
{

    /**
     * The attributes known or available to the collection
     *
     * @var array
     */
    protected $attributes = [
        'attack',
        'defence',
        'strength',
        'heath',
        'archery',
        'smelting',
        'smithing',
        'mining',
        'coding',
        'fletching',
        'alchemy',
        'cooking',
        'breeding'
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
     * Create a collection with the values taken from the original data source
     *
     * LocationCollection constructor.
     * @param $data
     */
    public function __construct(&$data)
    {
        $this->dataStore = &$data;

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
        switch ($name) {
            case 'heath':
                if ($value < $this->data[$name]) {
                    Event::fire(new PlayerLossesHeath($this->data[$name] - $value, $value));
                }

                if ($value <= 0) {
                    (new Player)->died();
                }
        }
        
        $this->data[$name] = $value;

        $this->save();
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