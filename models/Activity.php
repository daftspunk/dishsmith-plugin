<?php namespace Responsiv\DishSmith\Models;

use Model;

class Activity extends Model
{
    public $table = 'responsiv_dishsmith_activities';

    protected $guarded = [];

    /*
     * Relations
     */
    public $belongsTo = [
        'dish' => ['Responsiv\DishSmith\Models\Dish'],
        'user' => ['RainLab\User\Models\User'],
    ];

}