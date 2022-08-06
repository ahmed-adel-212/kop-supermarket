<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	public static function toSingleDevice($token=null, $title=null, $body=null) {
		$optionBuilder = new OptionsBuilder();
		$optionBuilder->setTimeToLive(60*20);
		$notificationBuilder = new PayloadNotificationBuilder($title);
		$notificationBuilder->setBody($body)->setSound('default');
		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData(['a_data' => 'my_data']);
		$option = $optionBuilder->build();
		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();
		$token = $token;
		$downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
		$downstreamResponse->numberSuccess();
		$downstreamResponse->numberFailure();
		$downstreamResponse->numberModification();
		// return Array - you must remove all this tokens in your database
		$downstreamResponse->tokensToDelete();
		// return Array (key : oldToken, value : new token - you must change the token in your database)
		$downstreamResponse->tokensToModify();
		// return Array - you should try to resend the message to the tokens in the array
		$downstreamResponse->tokensToRetry();
		// return Array (key:token, value:error) - in production you should remove from your database the tokens
		$downstreamResponse->tokensWithError();
	}

	public static function toMultipleDevices($model, $title=null, $body=null, $data=null) {
		$optionBuilder = new OptionsBuilder();
		$optionBuilder->setTimeToLive(60*20);
		$notificationBuilder = new PayloadNotificationBuilder($title);
		$notificationBuilder->setBody($body)->setSound('default');
		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData($data);
		$option = $optionBuilder->build();
		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();
		// You must change it to get your tokens
		$tokens = $model->pluck('device_token')->toArray();
		$downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
		$downstreamResponse->numberSuccess();
		$downstreamResponse->numberFailure();
		$downstreamResponse->numberModification();
		// return Array - you must remove all this tokens in your database
		$downstreamResponse->tokensToDelete();
		// return Array (key : oldToken, value : new token - you must change the token in your database)
		$downstreamResponse->tokensToModify();
		// return Array - you should try to resend the message to the tokens in the array
		$downstreamResponse->tokensToRetry();
		// return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
		$downstreamResponse->tokensWithError();
	}
}
