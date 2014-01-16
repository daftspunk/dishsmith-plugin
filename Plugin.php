<?php namespace Responsiv\DishSmith;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name' => 'DishSmith',
            'description' => 'DishSmith specific features.',
            'author' => 'Samuel Georges',
            'icon' => 'icon-food'
        ];
    }

    public function registerComponents()
    {
        return [
            // 'RainLab\User\Components\Register' => 'userRegister',
        ];
    }

    public function registerNavigation()
    {
        return [
            // 'dishsmith' => [
            //     'label' => 'DishSmith',
            //     'url' => Backend::url('dishsmith/dishes'),
            //     'icon' => 'icon-food',
            //     'permissions' => ['dishsmith:*'],
            //     'order' => 500,
            //     'sideMenu' => [
            //         'users' => [
            //             'label' => 'All Users',
            //             'icon' => 'icon-food',
            //             'url' => Backend::url('responsiv/dishsmith/dishes'),
            //             'permissions' => ['dishsmith:access_dishes'],
            //         ],
            //     ]
            // ]
        ];
    }

}