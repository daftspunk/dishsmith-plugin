<?php namespace Plugins\Responsiv\DishSmith\Models;

use Model;

class Dish extends Model
{
    public $table = 'responsiv_dishsmith_dishes';

    public $implement = [
        'October.Rain.Database.Behaviors.SortableModel'
    ];

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required',
    ];

    protected $guarded = [];

    /*
     * Relations
     */
    public $belongsTo = [
        'user' => ['Plugins\October\User\Models\User', 'foreignKey' => 'user_id'],
    ];

    public $belongsToMany = [
        'ingredients' => [
            'Plugins\Responsiv\DishSmith\Models\Ingredient',
            'table' => 'responsiv_dishsmith_dishes_ingredients',
            'pivotData' => ['amount', 'type']
        ]
    ];

    //
    // Scopes
    //

    public function scopeOfUser($query, $user)
    {
        if (!$user) return null;
        return $query->where('user_id', $user->id);
    }

    public function getIngredients()
    {
        $relation = $this->ingredients;
        $ingredients = [];

        foreach ($relation as $ingredient)
        {
            $ingredients[] = [
                'name' => $ingredient->name,
                'amount' => $ingredient->pivot->amount,
                'type' => $ingredient->pivot->type,
            ];
        }

        return $ingredients;
    }

}