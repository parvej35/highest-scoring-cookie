<?php

/**
 * Class Ingredient
 * This class represents an ingredient of a cookie recipe.
 * 
 * An ingredient has the following properties:
 * - name: String - Name of the ingredient
 * - capacity: Integer  
 * - durability: Integer  
 * - flavor: Integer  
 * - texture: Integer  
 * - calories: Integer  
 */

class Ingredient
{
    public $name;
    public $capacity;
    public $durability;
    public $flavor;
    public $texture;
    public $calories;

    public function __construct($name, $capacity, $durability, $flavor, $texture, $calories) {
        $this->name = $name;
        $this->capacity = $capacity;
        $this->durability = $durability;
        $this->flavor = $flavor;
        $this->texture = $texture;
        $this->calories = $calories;
    }

    public function get_name() {
        return $this->name;
    }
}
