<?php namespace Plugins\Responsiv\DishSmith\Models;

use Model;

class Ingredient extends Model
{
    public $table = 'responsiv_dishsmith_ingredient';

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required',
        'description' => 'required',
        'slug' => 'required',
    ];

    protected $guarded = [];

}