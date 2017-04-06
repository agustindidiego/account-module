<?php namespace Rage\AccountModule\Ui\ControlPanel\Command;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\Command\BuildButtons;
use Rage\AccountModule\Ui\ControlPanel\Component\Navigation\Command\BuildNavigation;
use Rage\AccountModule\Ui\ControlPanel\Component\Navigation\Command\SetActiveNavigationLink;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Command\SetMainNavigationLinks;
use Rage\AccountModule\Ui\ControlPanel\Component\Section\Command\BuildSections;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Command\SetActiveSection;
use Rage\AccountModule\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class BuildControlPanel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Agustin Didiego
 */
class BuildControlPanel
{
    use DispatchesJobs;

    /**
     * The builder object.
     *
     * @var ControlPanelBuilder
     */
    protected $builder;

    /**
     * Create a new BuildControlPanel instance.
     *
     * @param ControlPanelBuilder $builder
     */
    public function __construct(ControlPanelBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $this->dispatch(new BuildNavigation($this->builder));
        $this->dispatch(new SetActiveNavigationLink($this->builder));
        $this->dispatch(new SetMainNavigationLinks($this->builder));

        $this->dispatch(new BuildSections($this->builder));
        $this->dispatch(new SetActiveSection($this->builder));

        $this->dispatch(new BuildButtons($this->builder));
    }
}
