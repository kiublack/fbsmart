<?php

namespace App\Http\Controllers;
use Facebook\Facebook;
use Illuminate\Http\Request;

class Ahihi extends Controller
{
	function test(Request $request)
	{
		$fb = new Facebook();
		
		$endPoint = '351257451912187/subscribed_apps';
		$acessToken = 'EAANpIyXnIw0BAPEOZAHOfZCgJ8uirYxeXulCNZC0Xk7AVZATTiRfKqbgs1azZC318P7LRRZCZBf4G5XOv0ZCpFA7MXeWYnOby2TyZA550H4EPPP7T8MFFLzRlTGEpWtwD7PmRgKNIKbzIC93BcIbtZBpOZBhxsVwzBpsWi2mjHNgi6pUwZDZD';
		$data = [
			'object'=>'page',
			'callback_url'=>'https://facebook-phone-catcher-duongvanba.c9users.io/api/facebook/comment-post-event',
			'fields'=>'feed',
			'verify_token'=>'thisisaverifystring'
			];
		$r = $fb->post($endPoint, $data, $acessToken);
		echo '<pre>'.print_r($r->getDecodedBody(),1).'</pre>';
	}
}