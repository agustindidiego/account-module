<?php namespace Rage\AccountModule\Addon\Module;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class ModuleCollection
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ModuleCollection extends \Anomaly\Streams\Platform\Addon\Module\ModuleCollection
{

    /**
     * Return navigate-able modules.
     *
     * @return ModuleCollection
     */
    public function navigation()
    {
        $navigation = [];

        /* @var Module $item */
        foreach ($this->items as $item)
        {
            if ($item->getNavigation())
            {
                $navigation[trans($item->getName())] = $item;
            }
        }

        ksort($navigation);

        foreach ($navigation as $key => $item)
        {
            if ($item->getNamespace() == 'anomaly.module.dashboard')
            {
                $navigation = [$key => $item] + $navigation;

                break;
            }
        }

        return self::make($navigation)
                   ->enabled()
                   ->accessible()
            ;
    }

    /**
     * Return accessible modules.
     *
     * @return ModuleCollection
     */
    public function accessible()
    {
        $accessible = [];

        /* @var Authorizer $authorizer */
        $authorizer = app('Anomaly\Streams\Platform\Support\Authorizer');

        /* @var Module $item */
        foreach ($this->items as $item)
        {
            if ($authorizer->authorize($item->getNamespace('*')))
            {
                $accessible[] = $item;
            }
        }

        return self::make($accessible);
    }
}
