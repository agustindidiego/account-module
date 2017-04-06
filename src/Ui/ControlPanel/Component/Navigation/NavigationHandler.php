<?php namespace Rage\AccountModule\Ui\ControlPanel\Component\Navigation;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Event\GatherNavigation;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * Class NavigationHandler
 *
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Agustin Didiego
 *
 * @link   http://pyrocms.com/
 */
class NavigationHandler extends \Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\NavigationHandler
{

    /**
     * Handle the navigation.
     *
     * @param ControlPanelBuilder $builder
     * @param ModuleCollection    $modules
     * @param Dispatcher          $events
     */
    public function handle(
        ControlPanelBuilder $builder,
        ModuleCollection $modules,
        Dispatcher $events
    )
    {
        $navigation = [];

        /* @var Module $module */
        foreach ($modules->enabled()->withConfig('user-account') as $module)
        {
            $_navigation = config($module->getNamespace('user-account'));

            if (isset($_navigation['navigation']))
            {
                $navigation[$module->getSlug()] = array_merge(
                    $_navigation['navigation'],
                    ['module' => $module]
                );
            }
        }

        $builder->setNavigation(
            array_map(
                function (array $navigation)
                {
                    // return [
                    //     'breadcrumb' => $module->getName(),
                    //     'icon'       => $module->getIcon(),
                    //     'title'      => $module->getTitle(),
                    //     'slug'       => $module->getNamespace(),
                    //     'href'       => 'account/'.$module->getSlug(),
                    // ];

                    $module = $navigation['module'];
                    unset($navigation['module']);
                    if (isset($navigation['href']))
                    {
                        $navigation['href'] = route($navigation['href']);
                    }
                    return array_merge(
                        [
                            'breadcrumb' => $module->getName(),
                            'icon'       => $module->getIcon(),
                            'title'      => $module->getTitle(),
                            'slug'       => $module->getNamespace(),
                            'href'       => 'account/'.$module->getSlug(),
                        ], $navigation
                    );
                },
                $navigation
            )
        );

        $events->fire(new GatherNavigation($builder));
    }
}
