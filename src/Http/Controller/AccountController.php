<?php

namespace Rage\AccountModule\Http\Controller;


class AccountController extends UserController
{

	public function index()
	{
		return $this->redirect->to('account/dashboard');
	}

	public function dashboard()
	{
		return $this->view->make('rage.module.account::account/index');
	}
}