<?php namespace Rage\AccountModule\Ui\ControlPanel;

use Anomaly\Streams\Platform\Ui\ControlPanel\Command\BuildControlPanel;
use Rage\AccountModule\Ui\ControlPanel\Component\Navigation\NavigationHandler;
use Rage\AccountModule\Ui\ControlPanel\Component\Section\SectionHandler;

/**
 * Class ControlPanelBuilder
 *
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Agustin Didiego
 *
 * @link   http://pyrocms.com/
 */
class ControlPanelBuilder extends \Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder
{

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = SectionHandler::class;

    /**
     * The navigation links.
     *
     * @var array
     */
    protected $navigation = NavigationHandler::class;

    /**
     * Build the control_panel.
     */
    public function build()
    {
        $this->dispatch(new BuildControlPanel($this));

        return $this->controlPanel;
    }
}
