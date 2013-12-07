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

    public function scopeOfWeek($query, $week)
    {
        $alpha = array_flip(array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z'));
        $weekNo = isset($alpha[$week-1]) ? $alpha[$week-1] : 1;
        return $query->skip(($weekNo - 1) * 7)->take(7);
    }

    //
    // Helpers
    //

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

    public static function mergeIngredients($dishes)
    {
        $ingredientMap = [];
        foreach ($dishes as $dish) {
            foreach ($dish->ingredients as $ingredient) {
                if (!isset($ingredientMap[$ingredient->id])) {
                    $ingredientMap[$ingredient->id] = [
                        'id' => $ingredient->id,
                        'amount' => $ingredient->pivot->amount,
                        'type' => $ingredient->pivot->type,
                        'name' => $ingredient->name,
                        'usedIn' => [$dish],
                        'usedInString' => $dish->name
                    ];
                }
                else {
                    $ingredientMap[$ingredient->id]['amount'] += $ingredient->pivot->amount;
                    $ingredientMap[$ingredient->id]['usedIn'][] = $dish;
                    $ingredientMap[$ingredient->id]['usedInString'] .= ', ' . $dish->name;
                }
            }
        }

        return $ingredientMap;
    }

    public function getWeek($count)
    {
        $weekNo = ceil($count / 7);
        $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
        return $alpha[$weekNo-1];
    }

}