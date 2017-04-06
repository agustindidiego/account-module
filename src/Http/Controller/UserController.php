<?php namespace Rage\AccountModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;

class UserController extends PublicController
{

    /**
     * Create an instance of UserController
     */
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }
}
