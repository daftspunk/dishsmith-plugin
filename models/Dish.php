<?php namespace Responsiv\DishSmith\Models;

use Model;

class Dish extends Model
{
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Validation;

    public $table = 'responsiv_dishsmith_dishes';


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
        'user' => ['RainLab\User\Models\User'],
    ];

    public $belongsToMany = [
        'ingredients' => [
            'Responsiv\DishSmith\Models\Ingredient',
            'table' => 'responsiv_dishsmith_dishes_ingredients',
            'pivot' => ['amount', 'type']
        ]
    ];

    public $attachOne = [
        'photo' => ['System\Models\File']
    ];

    //
    // Scopes
    //

    public function scopeOfUser($query, $user)
    {
        if (!$user) return null;
        return $query->where('user_id', $user->id)->orderBy('sort_order');
    }

    public function scopeOfWeek($query, $week)
    {
        $alpha = array_flip(array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z'));
        $weekNo = isset($alpha[$week]) ? $alpha[$week] : 0;
        return $query->skip($weekNo * 7)->take(7);
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

    public static function getWeeksForUser($user)
    {
        $self = new self();
        $dishNo = $self->ofUser($user)->count();
        $dishNo = ceil($dishNo / 7);

        $alpha = array('A','B','C','D','E','F','G','H','I','J','K', 'L','M','N','O','P','Q','R','S','T','U','V','W','X ','Y','Z');
        return array_slice($alpha, 0, $dishNo);
    }

    public function getPic()
    {
        $pic = $this->photo;
        return ($pic) ? $pic->getThumb(350, 350, ['mode'=>'crop']) : 'http://placehold.it/350x350';
    }

}