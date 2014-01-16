<?php namespace Responsiv\DishSmith\Models;

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
        'dish' => ['Responsiv\DishSmith\Models\Dish', 'foreignKey' => 'dish_id'],
        'user' => ['RainLab\User\Models\User', 'foreignKey' => 'user_id'],
    ];

}