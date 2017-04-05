<?php namespace Rage\AccountModule\User\Form;

use Anomaly\UsersModule\User\UserModel;

class UserFormSections
{

    /**
     * Handle the form sections.
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
        ];

        $password_field = [
            'password',
            'confirm_password',
        ];

        $assignments = $users->getAssignments();

        $profileFields = $assignments->notLocked()->fieldSlugs();

        $builder->setSections(
            [
                'general'  => [
                    'fields' => $fields,
                ],
                'password' => [
                    'fields' => $password_field,
                ],
                'profile'  => [
                    'fields' => $profileFields,
                ],
            ]
        );
    }
}
