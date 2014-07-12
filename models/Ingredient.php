<?php namespace Responsiv\DishSmith\Models;

use Model;

class Ingredient extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'responsiv_dishsmith_ingredients';

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required',
    ];

    protected $guarded = [];
}