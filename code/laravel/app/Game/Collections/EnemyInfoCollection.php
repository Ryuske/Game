<?php namespace App\Game\Collections;

class EnemyInfoCollection
{

    /**
     * The attributes known or available to the collection
     *
     * @var array
     */
    protected $attributes = [
        'name',
        'rarity'
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

    protected $parent;

    /**
     * Create a collection with the values taken from the original data source
     *
     * LocationCollection constructor.
     * @param $data
     */
    public function __construct($parent, &$data)
    {
        $this->parent       = $parent;
        $this->dataStore    = &$data;

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
     * Save the localized data to the original data source
     *
     * @return void
     */
    public function save()
    {
        $this->dataStore = $this->data;
    }
}