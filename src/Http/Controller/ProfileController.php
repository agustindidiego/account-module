<?php namespace Rage\AccountModule\Http\Controller;

use \Rage\AccountModule\User\Form\UserFormBuilder;

class ProfileController extends UserController
{

    /**
     * Show the profile
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function index()
    {
        return $this->view->make('rage.module.account::profile/index');
    }

    /**
     * Edit the profile
     *
     * @param  UserFormBuilder $form The form
     * @return Response
     */
    public function edit(UserFormBuilder $form)
    {
        $id = $this->request->user()->id;

        $this->template->layout = 'rage.module.account::layouts/account';

        return $form->render($id);
        // return $this->view->make('rage.module.account::profile/edit');
    }
}
