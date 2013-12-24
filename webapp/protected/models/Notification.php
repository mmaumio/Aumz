<?php

class Notification
{

	private static $templates = array(
		'userAdded' => '_userAdded',
		'newActivity' => '_newActivity',
		'activityReply' => '_activityReply',
		'newTask' => '_newTask',
		'taskComplete' => '_taskComplete'
	);

	private static $subjects = array(
		'userAdded' => 'You were added to a study',
		'newActivity' => 'A new comment was posted',
		'activityReply' => '',
		'newTask' => '',
		'taskComplete' => ''
	);

	public static function sendEmail($type, $toUser, $obj)
	{
		$subject = Notification::$subjects[$type];
		$template = Notification::$templates[$type];
		$toName = $toUser->getName();
		$toEmail = $toUser->email;

		if ($type === 'userAdded')
		{
			$data = array();
			$data['studyName'] = $obj->title;
			$data['studyUrl'] = Yii::app()->createAbsoluteUrl('study/index', array('id' => $obj->id));
			Notification::_sendEmail($toName, $toEmail, $subject, $template, $data);
		}
		else if ($type === 'newActivity')
		{
			$data = array();
			$data['studyUrl'] = Yii::app()->createAbsoluteUrl('study/index', array('id' => $obj['study']->id));
			$data['studyName'] = $obj['study']->title;
			$data['authorName'] = $obj['author']->getShortName();
			$data['comment'] = $obj['activity']->content;
			Notification::_sendEmail($toName, $toEmail, $subject, $template, $data);	
		}
		else if ($type === 'activityReply')
		{

		}
		else if ($type === 'newTask')
		{

		}
		else if ($type === 'taskComplete')
		{

		}
	}

	private static function _sendEmail($toName, $toEmail, $subject, $template, $data)
	{
		
		if (!Yii::app()->params['emailNotifications']) return;
		
        $emailJson = array(
        	'key' => Yii::app()->params['mandrilKey'],
        	'message' => array(
        		'html' => Yii::app()->controller->renderPartial('//email/' . $template . 'Html', $data, true),
        		'text' => Yii::app()->controller->renderPartial('//email/' . $template, $data, true),
        		'subject' => $subject,
        		'from_email' => 'admin@omnisci.org',
        		'from_name' => 'OmniScience',
        		'to' => array(
        			array(
        				'email' => $toEmail,
        				'name' => $toName,
        				'type' => 'to'
        			)
        		)
        	)
        );

        
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/json',
		        'content' => json_encode($emailJson)
		    )
		);

		$context  = stream_context_create($opts);
    $result = file_get_contents('https://mandrillapp.com/api/1.0/messages/send.json', false, $context);    
		// // Setup cURL
		// $ch = curl_init('https://mandrillapp.com/api/1.0/messages/send.json');
		// curl_setopt_array($ch, array(
		//     CURLOPT_POST => TRUE,
		//     CURLOPT_RETURNTRANSFER => TRUE,
		//     CURLOPT_HTTPHEADER => array(
		//         'Content-Type: application/json'
		//     ),
		//     CURLOPT_POSTFIELDS => json_encode($emailJson)
		// ));

		// // Send the request
		// $response = curl_exec($ch);

		// // Check for errors
		// if($response === FALSE){
		//     die(curl_error($ch));
		// }

		// // Decode the response
		// $responseData = json_decode($response, TRUE);

		// if (!isset($responseData[0]['status']) || $responseData[0]['status'] !== 'sent')
		// {
		// 	YII::log(json_encode($responseData), 'error', 'Notification._sendEmail');
		// }
	}

}