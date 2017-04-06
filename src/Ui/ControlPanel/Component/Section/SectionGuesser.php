<?php namespace Rage\AccountModule\Ui\ControlPanel\Component\Section;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Guesser\DescriptionGuesser;
use Rage\AccountModule\Ui\ControlPanel\Component\Section\Guesser\HrefGuesser;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Guesser\PermissionGuesser;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Guesser\TitleGuesser;
use Rage\AccountModule\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class SectionGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Agustin Didiego
 */
class SectionGuesser
{

    /**
     * The HREF guesser.
     *
     * @var HrefGuesser
     */
    protected $href;

    /**
     * The title guesser.
     *
     * @var TitleGuesser
     */
    protected $title;

    /**
     * The permission guesser.
     *
     * @var PermissionGuesser
     */
    protected $permission;

    /**
     * The description guesser.
     *
     * @var DescriptionGuesser
     */
    protected $description;

    /**
     * Create a new SectionGuesser instance.
     *
     * @param HrefGuesser        $href
     * @param TitleGuesser       $title
     * @param PermissionGuesser  $permission
     * @param DescriptionGuesser $description
     */
    public function __construct(
        HrefGuesser $href,
        TitleGuesser $title,
        PermissionGuesser $permission,
        DescriptionGuesser $description
    ) {
        $this->href        = $href;
        $this->title       = $title;
        $this->permission  = $permission;
        $this->description = $description;
    }

    /**
     * Guess section properties.
     *
     * @param ControlPanelBuilder $builder
     */
    public function guess(ControlPanelBuilder $builder)
    {
        $this->href->guess($builder);
        $this->title->guess($builder);
        $this->permission->guess($builder);
        $this->description->guess($builder);
    }
}
