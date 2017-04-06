<?php namespace Rage\AccountModule\Ui\ControlPanel\Component\Navigation;

use Rage\AccountModule\Ui\ControlPanel\Component\Navigation\Event\SortNavigation;
use Rage\AccountModule\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * Class NavigationSorter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Agustin Didiego
 */
class NavigationSorter
{

    /**
     * The event dispatcher.
     *
     * @var Dispatcher
     */
    protected $events;

    /**
     * Create a new NavigationSorter instance.
     *
     * @param Dispatcher $events
     */
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    /**
     * Create a new NavigationSorter instance.
     *
     * @param ControlPanelBuilder $builder
     */
    public function sort(ControlPanelBuilder $builder)
    {
        if (!$navigation = $builder->getNavigation())
        {
            return;
        }

        ksort($navigation);

        /**
         * Make the namespaces the key now
         * that we've applied default sorting.
         */
        $navigation = array_combine(
            array_map(
                function ($item)
                {
                    return $item['slug'];
                },
                $navigation
            ),
            array_values($navigation)
        );

        /**
         * Again by default push the dashboard
         * module to the top of the navigation.
         */
        foreach ($navigation as $key => $module)
        {

            if ($key == 'rage.module.account')
            {

                $navigation = [$key => $module] + $navigation;

                break;
            }
        }

        uasort($navigation,
            function ($a, $b)
            {
                if ($a['sort'] == $b['sort'])
                {
                    return true;
                }

                return ($a['sort'] < $b['sort']) ? -1 : 1;
            }
        );

        $builder->setNavigation($navigation);

        $this->events->fire(new SortNavigation($builder));
    }
}
