<?php

namespace Model;

use Nette;
/**
* 
*/
class GiftManager extends Nette\Object
{

	/** @var Nette\Database\Context */
	private $database;


	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	/**
	 * Add gift
	 *
	 * @return void
	 * @param int
	 * @param String
	 * @param String
	 * @param bool
	 * @author Vojta Staněk
	 **/
	public function addGift($user, $name, $description = '', $plurality = false)
	{
		$this->database->table('gifts')->insert(array('user' => $user, 'name' => $name, 'description' => $description, 'plurality' => $plurality, 'created' => new \Nette\DateTime(), 'changed' => new \Nette\DateTime()));
	}

	public function editGift($giftId, $name, $description = '', $plurality = false)
	{
		$this->database->table('gifts')->wherePrimary($giftId)->update(array('name' => $name, 'description' => $description, 'plurality' => $plurality, 'changed' => new \Nette\DateTime()));
	}

	public function deleteGift($giftId)
	{
		if ($this->database->table('gives')->where(array('gift' => $giftId))->count() > 0) { // Someone wants to gift this gift
			$this->database->table('gifts')->wherePrimary($giftId)->update(array('notwant' => new \Nette\DateTime()));
		} else { //  Noone wants to gift this gift
			$this->database->table('gifts')->wherePrimary($giftId)->delete();
		}
	}

	// If reverse is true all user's gifts will be returned but not the $userId's
	public function getGifts($userId = '', $reverse = false)
	{
		$where = array();

		if (($userId != '' && $reverse == false) || ($userId != '' && $reverse == false)) {
			$where['user'] = $userId;
		}
		return $this->database->table('gifts')->where($where)->where('notwant IS NOT NULL');
	}

	public function isGiven($giftId)
	{
		$giftPlural = $this->database->table('gifts')->wherePrimary($giftId)->fetch()['plurality'];
		$someoneGives = $this->database->table('gives')->where('gift', $giftId)->count() > 0;
		return (!$giftPlural && $someoneGives);
	}

	public function getGift($id)
	{
		return $this->database->table('gifts')->wherePrimary($id)->fetch()->toArray();
	}

	public function addGive($giftId, $userId)
	{
		$this->database->table('gives')->insert(array('gift' => $giftId, 'user' => $userId, 'timestamp' => new \Nette\DateTime()));
	}

	public function getGives($userId)
	{
		return $this->database->table('gives')->where(array('user' => $userId));
	}


	public function deleteGive($userId, $giftId)
	{
		$this->database->table('gives')->where(array('user' => $userId, 'gift' => $giftId))->delete();
	}
}
