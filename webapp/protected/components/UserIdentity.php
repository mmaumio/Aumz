<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	public function UserIdentity($id, $name, $image, $email)
	{
		$this->_id = $id;
		$this->setState('name', $name);
		$this->setState('image', $image);
		$this->setState('email', $email);
	}

	public function authenticate()
	{
		return true;
	}

	public function getId()
    {
        return $this->_id;
    }
}