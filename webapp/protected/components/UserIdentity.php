<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
        
        /**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
                $record = User::model()->findByAttributes(array('email' => $this->username));
                if($record===null)
                    $this->errorCode=self::ERROR_USERNAME_INVALID;
                elseif($record->password!== User::hashPassword($this->password))
                    $this->errorCode=self::ERROR_PASSWORD_INVALID;
                else{
                    $this->_id=$record->id;
                    $this->setState('name', $record->firstName);
                    $this->setState('image', $record->profileImageUrl);
                    $this->setState('email',  $record->email);
                    Yii::app()->session['uid'] = $record->id;
                    $this->errorCode=self::ERROR_NONE;
                }
		return !$this->errorCode;
	}

	public function getId()
        {
            return $this->_id;
        }
}