<?php
namespace App;
use Nette\Application\UI\Form;

/**
 * Secured presenter
 *
 * @author  Vojta Staněk
 */
abstract class SecuredPresenter extends BasePresenter
{
	public function startup()
	{
		parent::startup();
		if(!$this->getUser()->isLoggedIn()) {
			$this->redirect('Sign:in');
		}
		
	}
}
