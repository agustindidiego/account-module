<?php namespace Rage\AccountModule\Ui\ControlPanel;

use Rage\AccountModule\Ui\ControlPanel\Command\BuildControlPanel;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\ButtonHandler;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\NavigationCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Contract\SectionInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Rage\AccountModule\Ui\ControlPanel\Component\Navigation\NavigationHandler;
use Rage\AccountModule\Ui\ControlPanel\Component\Section\SectionHandler;

/**
 * Class ControlPanelBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Agustin Didiego
 */
class ControlPanelBuilder extends \Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder
{

    use DispatchesJobs;

    /**
     * The section buttons.
     *
     * @var array
     */
    protected $buttons = ButtonHandler::class;

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
     * The control_panel object.
     *
     * @var ControlPanel
     */
    protected $controlPanel;

//    /**
//     * Create a new ControlPanelBuilder instance.
//     *
//     * @param ControlPanel $controlPanel
//     */
//    public function __construct(ControlPanel $controlPanel)
//    {
//        $this->controlPanel = $controlPanel;
//    }

    /**
     * Build the control_panel.
     */
    public function build()
    {
        $this->dispatch(new BuildControlPanel($this));

        return $this->controlPanel;
    }

    /**
     * Get the control_panel.
     *
     * @return ControlPanel
     */
    public function getControlPanel()
    {
        return $this->controlPanel;
    }

    /**
     * Get the section buttons.
     *
     * @return array
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Set the section buttons.
     *
     * @param array $buttons
     */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;
    }

    /**
     * Get the module sections.
     *
     * @return array
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Set the sections.
     *
     * @param array $sections
     * @return $this
     */
    public function setSections($sections)
    {
        $this->sections = $sections;

        return $this;
    }

    /**
     * Add a section.
     *
     * @param        $slug
     * @param  array $section
     * @param null   $position
     * @return $this
     */
    public function addSection($slug, array $section, $position = null)
    {
        if ($position === null) {
            $position = count($this->sections) + 1;
        }

        $front = array_slice($this->sections, 0, $position, true);
        $back  = array_slice($this->sections, $position, count($this->sections) - $position, true);

        $this->sections = $front + [$slug => $section] + $back;

        return $this;
    }

    /**
     * Add a section button.
     *
     * @param        $section
     * @param        $slug
     * @param  array $button
     * @param null   $position
     * @return $this
     */
    public function addSectionButton($section, $slug, array $button, $position = null)
    {
        $buttons = (array)array_get($this->sections, "{$section}.buttons");

        if ($position === null) {
            $position = count($buttons) + 1;
        }

        $front = array_slice($buttons, 0, $position, true);
        $back  = array_slice($buttons, $position, count($buttons) - $position, true);

        $buttons = $front + [$slug => $button] + $back;

        array_set($this->sections, "{$section}.buttons", $buttons);

        return $this;
    }

    /**
     * Get the module navigation.
     *
     * @return array
     */
    public function getNavigation()
    {
        return $this->navigation;
    }

    /**
     * Set the navigation.
     *
     * @param array $navigation
     */
    public function setNavigation($navigation)
    {
        $this->navigation = $navigation;
    }

    /**
     * Return the active control panel section.
     *
     * @return SectionInterface|null
     */
    public function getControlPanelActiveSection()
    {
        $sections = $this->getControlPanelSections();

        return $sections->active();
    }

    /**
     * Get the control panel sections.
     *
     * @return SectionCollection
     */
    public function getControlPanelSections()
    {
        return $this->controlPanel->getSections();
    }

    /**
     * Get the control panel navigation.
     *
     * @return NavigationCollection
     */
    public function getControlPanelNavigation()
    {
        return $this->controlPanel->getNavigation();
    }
}
