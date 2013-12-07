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
        'user' => ['Plugins\October\User\Models\User', 'foreignKey' => 'user_id'],
    ];

    public $belongsToMany = [
        'ingredients' => ['Plugins\Responsiv\DishSmith\Models\Ingredient', 'table' => 'responsiv_dishsmith_dishes_ingredients']
    ];

    //
    // Scopes
    //

    public function scopeOfUser($query, $user)
    {
        if (!$user) return null;
        return $query->where('user_id', $user->id);
    }

}