<?php namespace Rage\AccountModule\User\Form;

use Anomaly\Streams\Platform\Ui\Form\Component\Field\FieldFactory;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserModel;
use Illuminate\Http\Request;

class UserFormBuilder extends \Anomaly\UsersModule\User\Form\UserFormBuilder
{

    protected $model = UserModel::class;

    /**
     * Form actions
     *
     * @var array
     */
    protected $actions = [
        'save',
    ];

    /**
     * Form buttons
     *
     * @var array
     */
    protected $buttons = [
        'back' => [
            'text'       => 'Back',
            'type'       => 'link',
            'attributes' => [
                'href' => 'account/profile',
            ],
        ],
    ];

    /**
     * Form options
     *
     * @var array
     */
    protected $options = [
        'form_view' => 'streams::form/form',
    ];

    /**
     * On saving user form
     *
     * @param Request $request The request
     */
    public function onSaving(Request $request)
    {
        if ($request->get('confirm_password') && $this->form->getMode() == 'edit')
        {
            $this->disableFormField('confirm_password');
        }
    }

    /**
     * When form was built
     *
     * @param UserFormBuilder $builder The builder
     * @param FieldFactory    $factory The factory
     */
    public function onBuilt(UserFormBuilder $builder, FieldFactory $factory)
    {
        $builder->addFormField($factory->make(
            [
                'field'    => 'confirm_password',
                'type'     => 'anomaly.field_type.text',
                'label'    => 'Confirm Password',
                'required' => false,
                'rules'    => [
                    'required_with:password',
                    'same:password',
                ],
                'config'   => [
                    'type' => 'password',
                ],
                'value'    => '',
            ]
        ));
    }
}
