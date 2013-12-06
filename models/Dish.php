<?php namespace Plugins\Responsiv\DishSmith\Models;

use Model;

class Dish extends Model
{
    public $table = 'responsiv_dishsmith_dish';

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    protected $guarded = [];

}