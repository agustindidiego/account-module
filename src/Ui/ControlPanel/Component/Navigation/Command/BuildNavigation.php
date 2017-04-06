<?php namespace Rage\AccountModule\Ui\ControlPanel\Component\Navigation\Command;

use Rage\AccountModule\Ui\ControlPanel\Component\Navigation\NavigationBuilder;
use Rage\AccountModule\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class BuildNavigation
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Agustin Didiego
 */
class BuildNavigation
{

    /**
     * The control panel builder..
     *
     * @var ControlPanelBuilder
     */
    protected $builder;

    /**
     * Create a new BuildNavigation instance.
     *
     * @param ControlPanelBuilder $builder
     */
    public function __construct(ControlPanelBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param NavigationBuilder $builder
     */
    public function handle(NavigationBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
