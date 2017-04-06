<?php namespace Rage\AccountModule\Http\Controller;

class AccountController extends UserController
{

    /**
     * Show the account
     *
     * @return Response
     */
    public function index()
    {
        return $this->redirect->to('account/dashboard');
    }

    /**
     * Show the dashboard
     *
     * @return Response
     */
    public function dashboard()
    {
        return $this->view->make('rage.module.account::account/index');
    }
}
