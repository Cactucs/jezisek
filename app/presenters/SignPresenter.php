<?php
namespace App;

use Nette,
	Model;


/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{

	public function actionIn()
	{
		if($this->getUser()->isLoggedIn()) {
			$this->redirect('jezisek:default');
		}
	}


	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('username', 'Uživatelské jméno:')
			->setRequired('Zadej své uživatelské jméno.');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Zadej své heslo. (Pokud jsi ho zapoměl tak mi napiš)');

		// $form->addCheckbox('remember', 'Keep me signed in');

		$form->addSubmit('send', 'Přihlásit!');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}


	public function signInFormSucceeded($form)
	{
		$values = $form->getValues();

		if (true) {
			$this->getUser()->setExpiration('14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->redirect('Jezisek:');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('Byl jsi úspěšně odhlášen.', 'success');
		$this->redirect('in');
	}

}
