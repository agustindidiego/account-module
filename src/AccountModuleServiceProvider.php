<?php namespace Rage\AccountModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class AccountModuleServiceProvider extends AddonServiceProvider
{

    protected $plugins    = [];

    protected $commands   = [];

    protected $routes     = [
        'account'           => [
            'as'   => 'rage.module.account::account.index',
            'uses' => 'Rage\AccountModule\Http\Controller\AccountController@index',
        ],
        'account/dashboard' => [
            'as'   => 'rage.module.account::account.dashboard',
            'uses' => 'Rage\AccountModule\Http\Controller\AccountController@dashboard',
        ],
        'profile'           => [
            'as'     => 'rage.module.account::profile.index',
            'uses'   => 'Rage\AccountModule\Http\Controller\ProfileController@index',
            'prefix' => 'account',
        ],
        'profile/edit'      => [
            'as'     => 'rage.module.account::profile.edit',
            'uses'   => 'Rage\AccountModule\Http\Controller\ProfileController@edit',
            'prefix' => 'account',
        ],
    ];

    protected $middleware = [];

    protected $listeners  = [
        'Anomaly\Streams\Platform\Application\Event\ApplicationHasLoaded' => [
            'Rage\AccountModule\Listener\LoadControlPanel',
        ],
    ];

    protected $aliases    = [];

    protected $bindings   = [
        'user_profile' => 'Rage\AccountModule\User\Form\UserFormBuilder',
    ];

    protected $providers  = [];

    protected $singletons = [];

    protected $overrides  = [];

    protected $mobile     = [];

    public function register()
    {
    }

    public function map()
    {
    }

}
