<?php
namespace App;
use Nette\Application\UI\Form;

/**
 * Settings presenter
 *
 * @author  Vojta Staněk
 */
class SettingsPresenter extends SecuredPresenter
{
	/** @var Model\UserManager */
	protected $user;

	function __construct(\Model\UserManager $user) {
		$this->user = $user;
	}


	/**
	 * @return \Nette\Application\UI\Form
	 */
	protected function createComponentChangePasswordForm()
	{
		$form = new \Nette\Application\UI\Form;
		$form->addPassword('old', 'Tvoje staré heslo:')
			->setRequired('Musíš vyplnit staré heslo.');
	
		$form->addPassword('new', 'Tvoje nové heslo:')
			->setRequired('Musíš vyplnit nové heslo.');
	
		$form->addPassword('check', 'Tvoje nové heslo znovu:')
			->addRule(Form::EQUAL, 'Nová hesla nejsou stejná.', $form['new']);
	
		$form->addSubmit('sub', 'Změnit heslo.');
	
		$form->onSuccess[] = callback($this, 'processChangePasswordForm');
	
		return $form;
	}
	
	/**
	 * @param \Nette\Application\UI\Form
	 */
	public function processChangePasswordForm(\Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();
		$old = $values->old;
		$new = $values->new;

		if ($this->user->matchPassword($this->getUser()->id, $old)) {
			$this->user->changePassword($this->getUser()->id, $new);
			$this->flashMessage('Tvoje heslo bylo úspěšně změněno!', 'success');
			$this->redirect('jezisek:');
		} else {
			$this->flashMessage('Heslo nebylo změněno. Staré heslo je nesprávné.', 'danger');
		}
	}
	
}
