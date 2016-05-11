<?php namespace App\Game\Collections;

/**
 * Class CombatDamageCollection
 * @package App\Game\Collections
 */
class CombatDamageCollection
{

    /**
     * The attributes known or available to the collection
     *
     * @var array
     */
    protected $attributes = [
        'attacker',
        'defender',
        'attacker_missed',
        'damage_dealt'
    ];

    /**
     * The data localized to the given collection
     *
     * @var
     */
    protected $data;

    /**
     * Create a collection with the values taken from the data passed in
     *
     * LocationCollection constructor.
     * @param $data
     */
    public function __construct($data)
    {
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
     * Returns all the data known to the collection
     *
     * @return mixed
     */
    public function all()
    {
        return $this->data;
    }
}