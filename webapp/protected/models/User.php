<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $gender
 * @property string $link
 * @property string $timezone
 * @property string $locale
 * @property string $type
 * @property string $status
 * @property string $profileImageUrl
 * @property string $password
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Activity[] $activities
 * @property AuthCredential[] $authCredentials
 * @property File[] $files
 * @property Lab[] $labs
 * @property Project[] $projects
 * @property Project[] $projects1
 * @property SystemEvent[] $systemEvents
 * @property Task[] $tasks
 * @property Task[] $tasks1
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
     
    public $confirmpassword; 
     
	public function tableName()
	{
		return 'user';
	}
 
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('email', 'unique'),
			array('email', 'required'),
			array('firstName, lastName, email, link, profileImageUrl', 'length', 'max'=>128),
			array('gender, locale', 'length', 'max'=>8),
			array('timezone', 'length', 'max'=>4),
			array('type, status', 'length', 'max'=>32),
			array('password', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, firstName, lastName, email, gender, link, timezone, locale, type, status, profileImageUrl, password, created, modified', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'activities' => array(self::HAS_MANY, 'Activity', 'userId'),
			'authCredentials' => array(self::HAS_MANY, 'AuthCredential', 'userId'),
			'files' => array(self::HAS_MANY, 'File', 'userId'),
			'labs' => array(self::MANY_MANY, 'Lab', 'lab_user(userId, labId)'),
			//'projects' => array(self::HAS_MANY, 'Project', 'userId'),
			'projects' => array(self::MANY_MANY, 'Project', 'project_user(userId, projectId)'),
			'systemEvents' => array(self::HAS_MANY, 'SystemEvent', 'userId'),
			'tasks' => array(self::HAS_MANY, 'Task', 'ownerId'),
			'assignedTasks' => array(self::HAS_MANY, 'Task', 'assigneeId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firstName' => 'First Name',
			'lastName' => 'Last Name',
			'email' => 'Email',
			'gender' => 'Gender',
			'link' => 'Link',
			'timezone' => 'Timezone',
			'locale' => 'Locale',
			'type' => 'Type',
			'status' => 'Status',
			'profileImageUrl' => 'Profile Image Url',
			'password' => 'Password',
			'created' => 'Created',
			'modified' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('timezone',$this->timezone,true);
		$criteria->compare('locale',$this->locale,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('profileImageUrl',$this->profileImageUrl,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
    {   
        if ($this->isNewRecord)
        {   
            $this->created = new CDbExpression('UTC_TIMESTAMP()');
        }   
    
        $this->modified = new CDbExpression('UTC_TIMESTAMP()');
    
        return parent::beforeSave();
    }
	 public static function hashPassword($password)
    {
    	$passwordWithSalt = $password . "omniscience super sercret hash";
		return hash("sha256", $passwordWithSalt);
    }
    public function add_to_project($projectId)
    {
    	$exists = ProjectUser::model()->findAllByAttributes(array('userId' => $this->id, 'projectId' => $projectId));
    	if(count($exists) == 0){

	    	$project_user = new ProjectUser();
	    	$project_user->projectId = $projectId;
	    	$project_user->userId = $this->id;
	    	$project_user->invitedUser = Yii::app()->session['uid'];
				$project_user->role = "collaborator";
				$project= Project::model()->find(array('condition'=>'id=:id','params'=>array(':id'=>$projectId)));
				if($project_user->save()){
					Notification::sendEmail('userAdded', $this, $project_user);
				}
    	}

    }
    public function getName()
    {
    	return $this->firstName . " " .$this->lastName;
    }
}
