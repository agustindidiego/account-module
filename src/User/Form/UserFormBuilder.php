<?php namespace Rage\AccountModule\User\Form;

use Anomaly\Streams\Platform\Ui\Form\Component\Field\FieldFactory;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserModel;
use Illuminate\Http\Request;


class UserFormBuilder extends FormBuilder
{

	protected $model = UserModel::class;

	protected $actions = [
		'save'
	];

	protected $buttons = [
		'back' => [
			'text' => 'Back',
		    'type'  => 'link',
		    'attributes' => [
			    'href'   => 'account/profile'
		    ]
		]
	];

	protected $options = [
		'form_view' => 'streams::form/form'
	];

	public function onReady()
	{

	}

    /**
     * Fired just before posting.
     *
     * @param Request $request
     */
    public function onPosting(Request $request)
    {
        if (!$request->get('password') && $this->form->getMode() == 'edit') {
            $this->disableFormField('password');
        }
    }

	public function onSaving(Request $request)
	{
		if ($request->get('confirm_password') && $this->form->getMode() == 'edit') {
			$this->disableFormField('confirm_password');
		}
	}

    public function onBuilt(UserFormBuilder $builder, FieldFactory $factory)
    {
	    $builder->addFormField($factory->make(
		    [
			    'field'    => 'confirm_password',
			    'type'     => 'anomaly.field_type.text',
			    'label'    => 'Confirm Password',
			    'required' => false,
			    'rules'     => [
				    'required_with:password',
			        'same:password'
			    ],
			    'config'    => [
				    'type'              => 'password'
			    ],
			    'value' => ''
		    ]
	    ));
    }
}
