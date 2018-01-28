<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Use the REST API Client to make requests to the Twilio REST API
//use Twilio\Rest\Client;


class AossmsController extends Controller
{
	static $url = "https://qpd-api.aossms.com/p1/api/mt.json";
	static $token = "30f518cb516b748bcffbefeea84b7080";
	static $clientId = "1374";
	static $smsCode = "81701";
	static $message = "";
	static $phoneNumber = "";
	static $charset = "utf8";

	public function create($to, $type='num')
	{
		$token = self::makeAuthToken($type);
		if(preg_match('/0[7-9]0[0-9]+/',$to))
		{
			$to = preg_replace('/0([7-9]0)([0-9]+)/', '+81$1$2', $to);
		}

		$POST_DATA = array(
			'token' => self::$token,
			'clientId' => self::$clientId,
			'smsCode' => self::$smsCode,
			'charset' => self::$charset,
			'phoneNumber' => $to,
			'message' => 'このメールはEbihazeから送信されています。認証コード： '.$token.' ',
		);
		$curl=curl_init(self::$url);
		curl_setopt($curl,CURLOPT_POST, TRUE);
// ↓はmultipartリクエストを許可していないサーバの場合はダメっぽいです
// @DrunkenDad_KOBAさん、Thanks
//curl_setopt($curl,CURLOPT_POSTFIELDS, $POST_DATA);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($POST_DATA));
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE);  // オレオレ証明書対策
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, FALSE);  //
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl,CURLOPT_COOKIEJAR,      'cookie');
		curl_setopt($curl,CURLOPT_COOKIEFILE,     'tmp');
		curl_setopt($curl,CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡
//curl_setopt($curl,CURLOPT_REFERER,        "REFERER");
//curl_setopt($curl,CURLOPT_USERAGENT,      "USER_AGENT");

		$output= curl_exec($curl);

		return $token;
	}

	public function invite($to, $type='str', $user_id)
	{
		$url = route('users-certificate', $user_id);
		$token = self::makeAuthToken($type);
		if(preg_match('/0[7-9]0[0-9]+/',$to))
		{
			$to = preg_replace('/0([7-9]0)([0-9]+)/', '+81$1$2', $to);
		}

		// １通目
		$POST_DATA = array(
			'token' => self::$token,
			'clientId' => self::$clientId,
			'smsCode' => self::$smsCode,
			'charset' => self::$charset,
			'phoneNumber' => $to,
			'message' => "このメールはEbihazeから送信されています。\r\n認証ID: $user_id\r\n認証コード: $token",
		);
		$curl=curl_init(self::$url);
		curl_setopt($curl,CURLOPT_POST, TRUE);
// ↓はmultipartリクエストを許可していないサーバの場合はダメっぽいです
// @DrunkenDad_KOBAさん、Thanks
//curl_setopt($curl,CURLOPT_POSTFIELDS, $POST_DATA);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($POST_DATA));
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE);  // オレオレ証明書対策
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, FALSE);  //
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl,CURLOPT_COOKIEJAR,      'cookie');
		curl_setopt($curl,CURLOPT_COOKIEFILE,     'tmp');
		curl_setopt($curl,CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡
//curl_setopt($curl,CURLOPT_REFERER,        "REFERER");
//curl_setopt($curl,CURLOPT_USERAGENT,      "USER_AGENT");

		$output= curl_exec($curl);

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