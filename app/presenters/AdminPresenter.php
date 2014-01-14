<?php
namespace App;

use Nette\Application\UI\Form,
	Nette;

/**
 * Admin presenter
 *
 * @author  Vojta Staněk
 */
class AdminPresenter extends SecuredPresenter
{
	/** @var UserManager */
	protected $users;

	public function __construct(\Model\UserManager $users)
	{
		$this->users = $users;
	}

	public function startup()
	{
		parent::startup();
		if (!$this->users->isAdmin($this->getUser()->id)) {
			$this->redirect('jezisek:default');
		}
	}

	/**
	 * @return \Nette\Application\UI\Form
	 */
	protected function createComponentAddUserForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('username', 'Uživatelské jméno:')
			->setRequired('Please enter username.');

		$form->addText('name', 'Zobrazované jméno:')
			->setRequired('Full name is required.');

		$form->addText('pass', 'Heslo:')
			->setRequired('Please enter password.');


		$form->addSubmit('send', 'Přidat');

	
		$form->onSuccess[] = callback($this, 'processAddUserForm');
	
		return $form;
	}
	
	/**
	 * @param \Nette\Application\UI\Form
	 */
	public function processAddUserForm(\Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();
		$username = $values->username;
		$password = $values->pass;
		$full = $values->name;

		$this->users->add($username, $password, $full);
		$this->flashMessage('User '.$username.' was added.', 'success');
		
		$this->redirect('this');
	}
}
