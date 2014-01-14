<?php

namespace App;

use Nette\Application\UI\Form;

/**
 * Jezisek presenter
 *
 * @author  Vojta Staněk
 */
class JezisekPresenter extends SecuredPresenter
{

	/** @var \Model\GiftManager */
	protected $gift;

	/** @var \Model\UserManager */
	protected $user;

	public function __construct(\Model\GiftManager $gift, \Model\UserManager $user) {
		$this->gift = $gift;
		$this->user = $user;
	}

	public function startup()
	{
		parent::startup();
		$this->template->jezisek = $this->user->getJezisek($this->getUser()->id, 'name');
		$this->template->registerHelper('linklinks', '\App\JezisekPresenter::links');
	}


	public function renderDefault()
	{
		$gifts = $this->gift->getGifts($this->getUser()->id, true);
		$users = $this->user->getUsers();
		$r = array();
		$usersIds = array();
		foreach ($users as $user) {
			$id = $user['id'];
			$name = $this->user->getFullName($id);
			$r[$name] = array();
			$usersIds[$id] = $name;
		}
		foreach ($gifts as $k => $gift) {
			if($this->getUser()->id != $gift['user'])
			{
				$r[$usersIds[$gift['user']]][$k] = $gift->toArray();
			//	$r[$usersIds[$gift['user']]][$k]['description'] = self::links($r[$usersIds[$gift['user']]][$k]['description']);
				$r[$usersIds[$gift['user']]][$k]['isGiven'] = $this->gift->isGiven($gift['id']);
			}
		}
		unset($r[$usersIds[$this->getUser()->id]]);

		$this->template->gifts = $r;
		/*
			gifts = array(
				'Vojta Staněk' => 
					array(
						array('name' => Dárek, 'description' => Tohle si přeji..., ...)
					)
			)
		*/
		



	}

	public function renderMyGifts()
	{
		$this->template->myGifts = $this->gift->getGifts($this->getUser()->id);
	}

	public function renderGives()
	{
		$givesRaw = $this->gift->getGives($this->getUser()->id);
		$gives = array();
		foreach ($givesRaw as $k => $give) {
			$gives[$k] = $this->gift->getGift($give['gift']);
			$gives[$k]['user'] = $this->user->getFullName($gives[$k]['user']);
		}
		$this->template->gives = $gives;
	}


	/**
	 * @return \Nette\Application\UI\Form
	 */
	protected function createComponentAddGiftForm()
	{
		$form = new \Nette\Application\UI\Form;
		$form->addText('name', 'Název:')
			->setRequired('Název musí být vyplněn.');

		$form->addTextArea('description', 'Popis:');

		$form->addCheckbox('plurality', 'Může být více');
	
		$form->addSubmit('sub', 'Přidej dáreček.');
	
		$form->onSuccess[] = callback($this, 'processAddGiftForm');
	
		return $form;
	}
	
	/**
	 * @param \Nette\Application\UI\Form
	 */
	public function processAddGiftForm(\Nette\Application\UI\Form $form)
	{
		$values = $form->getValues();
		$giftId = $this->getParameter('giftId');
		$name = $values->name;
		$description = $values->description;
		$plurality = $values->plurality;
		
		if(!$giftId) {
			$this->gift->addGift($this->getUser()->id, $name, $description, $plurality);
		} else {
			$this->gift->editGift($giftId, $name, $description, $plurality);
		}
		$this->flashMessage('Teď už si přeješ "'.$name.'". Já velký ježíšek o tom vím!!!' , 'success');
		$this->redirect('jezisek:myGifts');
	}

	public function actionEditGift($giftId)
	{
		$this->template->giftId = $giftId;
		$this['addGiftForm']->setDefaults($this->gift->getGift($giftId));
	}

	public function actionDeleteGift($giftId)
	{
		$this->gift->deleteGift($giftId);
		$this->redirect('jezisek:myGifts');
	}

	public function actionAddGive($giftId)
	{
		$this->gift->addGive($giftId, $this->getUser()->id);
		$this->redirect('jezisek:gives');
	}

	public function actionDeleteGive($giftId)
	{
		$this->gift->deleteGive($this->getUser()->id, $giftId);
		$this->redirect('jezisek:gives');
	}

	static public function links($text)
	{
		// http://css-tricks.com/snippets/php/find-urls-in-text-make-links/
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

		if(preg_match($reg_exUrl, $text, $url)) {
			return preg_replace($reg_exUrl, '<a href='.$url[0].' target="_blanc">'.$url[0].'</a> ', $text);
		} else {
			return $text;
		}
	}

}
