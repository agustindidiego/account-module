<?php namespace Rage\AccountModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class AccountModule extends Module
{

    /**
     * The addon icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-user';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'profile',
    ];

    /**
     * Module navigation
     *
     * @var boolean
     */
    protected $navigation = false;
}
