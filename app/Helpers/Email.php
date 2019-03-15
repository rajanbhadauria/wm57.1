<?php
namespace App\Helpers;

use Mail;

class Email 
{
	public static function send()
	{
		echo "I will send email";
	}


	public static function shareResume($to,$from,$shareSubject,$updateFlag, $shareMsg=""){
		$data['subject'] = $shareSubject;
		$data['from'] = $from;
		$data['updateFlag'] = $updateFlag;
		$data['content'] = $shareMsg;
	
		Mail::send("email.notification.share", $data, function ($message) use ($to) {
            $message->to($to)->subject("WorkMedian : Resume Share");
        });

	}

	public static function sendInvite($to,$from,$shareSubject,$updateFlag, $shareMsg=""){
		$data['subject'] = $shareSubject;
		$data['from'] = $from;
		$data['updateFlag'] = $updateFlag;
		$data['content'] = $shareMsg;

		Mail::send("email.notification.invite", $data, function ($message) use ($to) {
            $message->to($to)->subject("WorkMedian : Invitation");
        });

	}
    
}
