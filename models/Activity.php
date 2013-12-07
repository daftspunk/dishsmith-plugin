<?php namespace Plugins\Responsiv\DishSmith\Models;

use Model;

class Activity extends Model
{
    public $table = 'responsiv_dishsmith_activities';

    /*
     * Validation
     */
    public $rules = [];

    protected $guarded = [];

    /*
     * Relations
     */
    public $belongsTo = [
        'dish' => ['Plugins\Responsiv\DishSmith\Models\Dish', 'foreignKey' => 'dish_id'],
        'user' => ['Plugins\October\User\Models\User', 'foreignKey' => 'user_id'],
    ];

}