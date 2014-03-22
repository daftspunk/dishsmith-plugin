<?php namespace Responsiv\DishSmith;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'DishSmith',
            'description' => 'DishSmith specific features.',
            'author'      => 'Samuel Georges',
            'icon'        => 'icon-food'
        ];
    }

}