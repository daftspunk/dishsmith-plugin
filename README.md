DishSmith Plugin
================

Plugin used by DishSmith theme created at HACT 2013

See [DishSmith theme](https://github.com/daftspunk/dishsmith) for the details.

## Models

#### Dish

An item on a menu, like a meal. Dishes belong to Users.

- name
- user

#### Ingredient

Dishes have many ingredients, unified ingredients make up the shopping list.

- name
- description

#### Dish:Ingredient

Pivot table

- ingredient (id)
- dish (id)
- amount (100)
- type (grams)

#### Activity

Record logging for what dish appears on a timetable. 
Can tell when a dish was last eaten.

- dish (id)
- created_at
- type (enum: dish, skip)