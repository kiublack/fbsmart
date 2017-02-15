<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use File;
use Google_Client; 
use Illuminate\Http\Request;

class Test extends Controller
{
	function t(Request $request)
	{
		function getClient($scopes, $request)
		{
			// 
			$accesskeyPath = base_path().'/config/accessToken/accessCredentials.json';
			$configPath    = base_path().'/config/accessToken/appConfig.json';
			
			$client = new Google_Client();
			$client->setApplicationName('Test');
			$client->setScopes(implode(' ',$scopes));
			$client->setAuthConfig($configPath);
			$client->setAccessType('offline');
			
			if( !file_exists($accesskeyPath)) 
			{
				$authUrl = $client->createAuthUrl();
				header('Location: '.$authUrl);
				exit;
			}else{
				echo "File exist!\n";
				$accessToken = json_decode(file_get_contents($accesskeyPath), true);
			}
			$client->setAccessToken($accessToken);
			if ($client->isAccessTokenExpired())
			{
				 $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
				 File::put($accesskeyPath, json_encode($client->getAccessToken()));
			}
			return $client;
		}
		
		$client = getClient(['https://www.googleapis.com/auth/drive', 'https://www.googleapis.com/auth/spreadsheets'], $request);
	}
	
	function auth(Request $r)
	{
		if($r->input('code') == null){ die(); };
		$accesskeyPath = base_path().'/config/accessToken/accessCredentials.json';
		$configPath  = base_path().'/config/accessToken/appConfig.json';
			
		$client = new Google_Client();
		$client->setAuthConfig($configPath);
		/*
		$client->setApplicationName('Test');
		$client->setScopes(implode(' ',['https://www.googleapis.com/auth/spreadsheets']));
		
		$client->setAccessType('offline');
		*/
		$accessToken = $client->fetchAccessTokenWithAuthCode($r->input('code'));
		
		
		File::put($accesskeyPath, json_encode($accessToken));
		
		header('Location: /test'); exit;
		
	}
	
	
	
	
	function gg(Request $r)
	{
		return view('user.info');
		
	}
	
	function ahihi(Request $r)
	{
		$gg = $this->getGoogleClient();
		print_r($gg->fetchAccessTokenWithAuthCode($r->input('code')));
		
	}
	
	private function getGoogleClient()
	{
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
		 $client->setScopes($scopes);
		$client->setAccessType('offline');
		return $client;
		 /*
		if($this->user->googleToken != '')
		{
			$accessToken = (array)json_decode($this->user->googleToken);
			$client->setAccessToken($accessToken);
		}
		$client->addScope(implode(' ', $scopes));
		return $client;
		
		*/
	}
	
	
}