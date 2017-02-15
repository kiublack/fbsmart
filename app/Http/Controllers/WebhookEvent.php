<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Google_Service_Sheets;
use Google_Client;
use Facebook\Facebook;
use Google_Service_Sheets_ValueRange;
use Illuminate\Support\Facades\DB;



class WebhookEvent extends Controller
{
	
	function evt(Request $r)
	{
		
		ignore_user_abort(true);
		set_time_limit(0);
		ob_start();
		header("HTTP/1.1 200 OK");
		header('Connection: close');
		header('Content-Length: '.ob_get_length());
		ob_end_flush();
		ob_flush();
		flush();
		
		// Nhận dạng truy cập
		
		$data = $r->all()['entry'][0];
		$page = DB::table('pages')->where('pid', $data['id'])->first();
		if($page==null){ die(); };
		if($page->active==0){ die(); };
		
		//file_put_contents('a.txt', json_encode($r->all())."\n".print_r($r->all(),1), FILE_APPEND);
		if(isset($data['changes']))
		{
			if($data['changes'][0]['value']['item'] != 'comment'){ die(' Not comment'); };
			$rs = $this->parseComment($page, $data['changes'][0]['value']);
			$values = ["=int($rs->id)", $rs->name, $rs->url,$rs->time,  'Comment',$rs->text, $rs->phone];
		}
		
		
		if(isset($data['messaging']))
		{
			$rs = $this->parseMessage($page, $data);
			$values = ["=int($rs->id)", $rs->name, $rs->url, $rs->time, 'Message', $rs->text, $rs->phone];
		}
		
		
		
		
		$ss = $this->getSheetService($page);
		
		$body = new Google_Service_Sheets_ValueRange([ 'values' => [$values] ]);
		$params = ['valueInputOption' => 'USER_ENTERED'];
		$range = 'Data!A:A';
		$result = $ss->spreadsheets_values->append($page->sheetId, $range,	$body, $params);
		
		
		
		
	}
	
	function verfy(Request $r)
	{
		echo $r->input('hub_challenge');
	}
	
	private function getSheetService($page)
	{

		$accessToken = json_decode($page->googleAccessToken);
		
		$config = [
			'client_id' => getenv('GOOGLE_CLIENT_ID'),
			'client_secret' => getenv('GOOGLE_SECRET'),
			'redirect_uri'=> getenv('APP_URL').'/api/google/callback',
			'application_name' => 'Ahihi'
		];
		
		
		
		$scopes = [
			'https://www.googleapis.com/auth/drive',
			'https://www.googleapis.com/auth/spreadsheets',
			'https://www.googleapis.com/auth/drive.file'
		];
		
		$client = new Google_Client($config);
		$client->addScope(implode(' ', $scopes));
		$client->setAccessToken((array)$accessToken);
		$client->setAccessType('offline');
		
		if ($client->isAccessTokenExpired())
		{
			$refreshToken = $client->getRefreshToken();
    		$client->fetchAccessTokenWithRefreshToken($refreshToken);
    		$accessToken = $client->getAccessToken();
    		$accessToken['refresh_token'] = $refreshToken;
    		$encoded = json_encode($accessToken);
    		DB::table('users')->where('id', $page->userId)->update(['googleToken' => $encoded]);
    		DB::table('pages')->where('userId', $page->userId)->update(['googleAccessToken' => $encoded]);
		}
		$service = new Google_Service_Sheets($client);
		
		return $service;
	}
	
	function parseComment($page, $data)
	{
		if(!isset($data['message'])){ die(); };
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		if($data['sender_id'] == $page->pid){ return false; };
		return (object)[
			'name' => $data['sender_name'],
			'url'  => 'https://fb.com/'.$data['sender_id'],
			'time' => date('d/n/Y G:i', $data['created_time']),
			'text' => '('.date('G:i - d/n', $data['created_time']).' C ) : '.$data['message'],
			'id'   => $data['sender_id'],
			'phone' => $this->getPhoneNumber($data['message'])
		];
	}
	
	function parseMessage($page, $data)
	{
		if(!isset($data['text'])){ die(); };
		$time = $data['time'];
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		
		$data = $data['messaging'][0]['message'];
		$fb = new Facebook();
		$get = $fb->get('/m_'.$data['mid'].'?fields=from', $page->facebookAccessToken);
		$sender = $get->getDecodedBody()['from'];
		return (object)[
			'time'=> date('d/n/Y G:i', $time/1000),
			'name' => $sender['name'],
			'url'  => 'https://fb.com/'.$sender['id'],
			'id'   => $sender['id'],
			'text' => '('.date('G:i - d/n', $time/1000).' M ) : '.$data['text'],
			'phone' => $this->getPhoneNumber($data['text'])
		];
	}
	
	function getPhoneNumber($t)
	{
	    
		if(preg_match_all('/0([0-9]|\-|\.| )+/', $t, $matches))
		{
			$list = [];
			for($i=0; $i<count($matches[0]); $i++)
			{
				$number = $matches[0][$i];
				$number = preg_replace('/\.| |-/','', $number);
				$number = substr($number,0,4).'-'.substr($number,4,3).'-'.substr($number,7,strlen($number)-7);
				array_push($list, $number);
			}
			print_r($list);
			return implode("\n", $list);
		};
		return '';
		
	}
	
	
	
}