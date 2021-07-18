<?php
/**
*
* nthieu - 2018-08-04
*/

namespace phpbb\passwords\driver;

class efruit extends base
{
	const PREFIX = '$ef$';
	const SALT = 'eFruit24082013';
	const PASSWORD_LENGTH = 32;

	/**
	* {@inheritdoc}
	*/
	public function get_prefix()
	{
		return self::PREFIX;
	}

	/**
	* {@inheritdoc}
	*/
	public function is_legacy()
	{
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function hash($password, $user_row = '')
	{
		if (!empty($user_row['username']))
			return self::PREFIX.substr(md5(self::SALT.$password.$user_row['username']), 0, self::PASSWORD_LENGTH);
		return self::PREFIX.substr(md5(self::SALT.$password), 0, self::PASSWORD_LENGTH);;
	}

	/**
	* {@inheritdoc}
	*/
	public function check($password, $hash, $user_row = array())
	{
		if (empty($hash))
		{
			return false;
		}
		else
		{
			return $this->helper->string_compare($hash, $this->hash($password, $user_row));
		}
	}
}
