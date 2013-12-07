<?php namespace Plugins\Responsiv\DishSmith\Models;

use Model;

class Dish extends Model
{
    public $table = 'responsiv_dishsmith_dishes';

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    protected $guarded = [];

    /*
     * Relations
     */
    public $belongsTo = [
        'user' => ['Pluguns\October\User\Models\User', 'foreignKey' => 'user_id'],
    ];

    public $belongsToMany = [
        'ingredients' => ['Plugins\Responsiv\DishSmith\Models\Ingredient', 'table' => 'responsiv_dishsmith_dishes_ingredients']
    ];

}