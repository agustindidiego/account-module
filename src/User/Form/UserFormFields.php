<?php namespace Rage\AccountModule\User\Form;

use Anomaly\UsersModule\User\UserModel;

class UserFormFields
{

    /**
     * Handle the form fields.
     *
     * @param UserFormBuilder $builder
     */
    public function handle(UserFormBuilder $builder, UserModel $users)
    {
        $fields = [
            'first_name',
            'last_name',
            'display_name',
            'username',
            'email',
            'password' => [
                'value'    => '',
                'required' => false,
                'rules'    => [
                    'required_if:password,*',
                ],
            ],
        ];

        $assignments = $users->getAssignments();

        $builder->setFields(array_merge($fields, $assignments->notLocked()->fieldSlugs()));
    }
}
