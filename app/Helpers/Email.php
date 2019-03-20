<?php
namespace App\Helpers;

use Mail;

class Email
{
	public static function send()
	{
		echo "I will send email";
	}

    // sending resume to user
	public static function shareResume($to,$from,$shareSubject,$updateFlag, $shareMsg=""){
		$data['subject'] = $shareSubject;
		$data['from'] = $from;
		$data['updateFlag'] = $updateFlag;
        $data['content'] = $shareMsg;
        $data['to'] = $to;

		Mail::send("email.notification.share", $data, function ($message) use ($data) {
            $message->to($data['to'])->subject($data['subject']);
        });
    }

    // sending resume with invitation to not register user
	public static function sendInvite($to,$from,$shareSubject,$updateFlag, $shareMsg=""){
		$data['subject'] = $shareSubject;
		$data['from'] = $from;
		$data['updateFlag'] = $updateFlag;
        $data['content'] = $shareMsg;
        $data['to'] = $to;

		Mail::send("email.notification.invite", $data, function ($message) use ($data) {
            $message->to($data['to'])->subject($data['subject']);
        });
    }
    // sending resume access request to registered user
    public static function sendResumeRequest($to,$from, $from_name, $shareMsg="") {
        $data['from'] = $from;
        $data['from_name'] = $from_name;
        $data['content'] = $shareMsg;
        $data['to'] = $to;

		Mail::send("email.notification.request_resume", $data, function ($message) use ($data) {
            $message->to($data['to'])->subject($data['from_name']." wants to access your resume");
        });
    }

     // sending resume access request accept to registered user
     public static function sendAcceptResumeResp($to,$from, $from_name, $shareMsg="") {
        $data['from'] = $from;
        $data['from_name'] = $from_name;
        $data['content'] = "Great ! You can access ".$from_name."'s resume";
        $data['to'] = $to;
        $data['subject'] = $data['content'];

		Mail::send("email.notification.common_resume", $data, function ($message) use ($data) {
            $message->to($data['to'])->subject($data['content']);
        });
    }

    // sending resume access request accept to registered user
    public static function sendResumeRequestInvitation($to,$from, $from_name, $shareMsg="") {
        $data['from'] = $from;
        $data['from_name'] = $from_name;
        $data['content'] = "Great ! You can access ".$from_name."'s resume";
        $data['to'] = $to;
        $data['subject'] = $from_name."'s resume received ";
        $data['singup_url'] = url('register');

		Mail::send("email.notification.resume_view_invitation", $data, function ($message) use ($data) {
            $message->to($data['to'])->subject($data['subject']);
        });
    }

}
