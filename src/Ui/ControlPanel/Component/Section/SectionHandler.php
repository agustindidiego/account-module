<?php namespace Rage\AccountModule\Ui\ControlPanel\Component\Section;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Support\Resolver;
use Rage\AccountModule\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class SectionHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Agustin Didiego
 */
class SectionHandler
{

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * The resolver utility.
     *
     * @var Resolver
     */
    protected $resolver;

    /**
     * Create a new SectionHandler instance.
     *
     * @param ModuleCollection $modules
     * @param Resolver         $resolver
     */
    public function __construct(ModuleCollection $modules, Resolver $resolver)
    {
        $this->modules  = $modules;
        $this->resolver = $resolver;
    }

    /**
     * Handle the sections.
     *
     * @param ControlPanelBuilder $builder
     */
    public function handle(ControlPanelBuilder $builder)
    {

        /*
         * We have to have a module for
         * the default functionality.
         */
        if (!$module = $this->modules->active())
        {
            return;
        }

        /*
         * Default to the module's sections.
         */
        $sections       = [];
        $_accountConfig = config($module->getNamespace('user-account'));
        if (isset($_accountConfig['sections']))
        {
            $sections = $_accountConfig['sections'];
        }
        $builder->setSections($sections);

        /*
         * If the module has a sections handler
         * let that HANDLE the sections.
         */
        if (!$sections && class_exists($sections = get_class($module) . 'Sections'))
        {
            $this->resolver->resolve($sections . '@handle', compact('builder'));
        }
    }
}
