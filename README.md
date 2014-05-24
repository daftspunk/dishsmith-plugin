DishSmith Plugin
================

Plugin used by DishSmith theme created at [HACT 2013](http://hact.org.au).

See [DishSmith theme](https://github.com/daftspunk/dishsmith) for the details.


## Installation

1. [Install a copy of October CMS](http://octobercms.com/docs/help/installation).
2. Download this [Plugin archive](https://github.com/daftspunk/dishsmith-plugin/archive/master.zip) as a ZIP.
3. Extract the archive contents to `/plugins/responsiv/dishsmith` in the OctoberCMS application root directory.
4. Ensure you have also installed the [DishSmith Theme](https://github.com/daftspunk/dishsmith).
5. Sign out of the Back-end (if not already) and sign in again to build the database.
6. Open the front-end homepage and sign in to get started

## Models

#### Dish

An item on a menu, like a meal. Dishes belong to Users.

- name
- user
- slug

#### Ingredient

Dishes have many ingredients, unified ingredients make up the shopping list.

- name
- description
- slug

#### Dish:Ingredient

Pivot table

- ingredient (id)
- dish (id)
- amount (100)
- type (grams)

#### Activity

Record logging for what dish appears on a timetable. 
Can tell when a dish was last eaten.

- user (id)
- dish (id)
- created_at
- type (enum: dish, skip)
