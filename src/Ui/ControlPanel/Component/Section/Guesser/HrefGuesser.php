<?php namespace Rage\AccountModule\Ui\ControlPanel\Component\Section\Guesser;

use Rage\AccountModule\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class HrefGuesser
 *
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Agustin Didiego
 *
 * @link   http://pyrocms.com/
 */
class HrefGuesser extends \Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Guesser\HrefGuesser
{

    /**
     * Guess the sections HREF attribute.
     *
     * @param ControlPanelBuilder $builder
     */
    public function guess(ControlPanelBuilder $builder)
    {
        $sections = $builder->getSections();

        foreach ($sections as $index => &$section)
        {

            // If HREF is set then skip it.
            if (isset($section['attributes']['href']))
            {
                continue;
            }

            $module = $this->modules->active();

            $href = $this->url->to($module->getSlug());

            if ($index !== 0 && $module->getSlug() !== $section['slug'])
            {
                $href .= '/'.$section['slug'];
            }

            $section['attributes']['href'] = $href;
        }

        $builder->setSections($sections);
    }
}
