<?php namespace Rage\AccountModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Application\Event\ApplicationHasLoaded;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Guesser\SectionNormalizer as BaseSectionNormalizer;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder as BasePanelBuilder;
use Anomaly\Streams\Platform\Ui\ControlPanel\Listener\LoadControlPanel;
use Rage\AccountModule\Ui\ControlPanel\Component\Section\Guesser\SectionNormalizer;
use Rage\AccountModule\Ui\ControlPanel\ControlPanelBuilder;
use Rage\AccountModule\User\Form\UserFormBuilder;

class AccountModuleServiceProvider extends AddonServiceProvider
{

    protected $routes = [
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

    protected $listeners = [
        ApplicationHasLoaded::class => [
            LoadControlPanel::class,
        ],
    ];

    protected $bindings = [
        'user_profile'               => UserFormBuilder::class,
        BasePanelBuilder::class      => ControlPanelBuilder::class,
        BaseSectionNormalizer::class => SectionNormalizer::class,
    ];
}
