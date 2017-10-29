<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;


class TwillioController extends Controller
{
	static $sid = "SMcc3c812d0586431ba9274a17f4438f0f";
	static $AuthToken = "e74853f48e4455c7f5f6291992666e64";
	static $accountSid = "ACb0a6d001b6a4985a25cf5eb717358024";

	public function create($to, $type='num')
	{
		$token = self::makeAuthToken($type);
		if(preg_match('/0[7-9]0[0-9]+/',$to))
		{
			$to = preg_replace('/0([7-9]0)([0-9]+)/', '+81$1$2', $to);
		}
		// Use the client to do fun stuff like send text messages!
		$client = new Client(self::$accountSid, self::$AuthToken);
		$client->messages->create(
		// the number you'd like to send the message to '+15205829627',
			$to,
			array(
				// A Twilio phone number you purchased at twilio.com/console
				'from' => '+15205829627',
				// the body of the text message you'd like to send
				'body' => 'This is Ebihaze! Your AuthToken is '.$token.' .'
			)
		);
		return $token;
	}
	private function makeAuthToken($type = 'num'){
		static $chars = 'ABCDEFGHIJLKMNOPQRSTUVWXYZ';
		static $nums = '123456789';
		$token = '';
		switch ($type){
			case 'num':
				for($i=0;$i<4;++$i)
				{
					$token .= $nums[mt_rand(0, 8)];
				}
			break;
			case 'str':
				for($i=0;$i<4;++$i)
				{
					$token .= $nums[mt_rand(0, 8)];
				}
				for($i=0;$i<2;++$i)
				{
					$token .= $chars[mt_rand(0, 25)];
				}
				for($i=0;$i<2;++$i)
				{
					$token .= $nums[mt_rand(0, 8)];
				}
			break;
		}
		return $token;
	}
}

/*
 * TwillioResponse
 *
 {
"sid": "SMcc3c812d0586431ba9274a17f4438f0f",
    "date_created": "Sat, 28 Oct 2017 11:12:36 +0000",
    "date_updated": "Sat, 28 Oct 2017 11:12:36 +0000",
    "date_sent": null,
    "account_sid": "ACb0a6d001b6a4985a25cf5eb717358024",
    "to": "+819042777880",
    "from": "+15205829627",
    "messaging_service_sid": null,
    "body": "Sent from your Twilio trial account - This is the Ebihaze Auth Token.",
    "status": "queued",
    "num_segments": "1",
    "num_media": "0",
    "direction": "outbound-api",
    "api_version": "2010-04-01",
    "price": null,
    "price_unit": "USD",
    "error_code": null,
    "error_message": null,
    "uri": "/2010-04-01/Accounts/ACb0a6d001b6a4985a25cf5eb717358024/Messages/SMcc3c812d0586431ba9274a17f4438f0f.json",
    "subresource_uris": {
	"media": "/2010-04-01/Accounts/ACb0a6d001b6a4985a25cf5eb717358024/Messages/SMcc3c812d0586431ba9274a17f4438f0f/Media.json"
    }
}
*/