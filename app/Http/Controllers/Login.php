<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use View;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Facebook\FacebookRequest;

class Login extends Controller
{
	function __construct()
	{
		session_start();
		if( DB::table('users')->where('session', session_id())->first()  != null)
		{
			header('Location: /user'); exit;
		}
	}
	
	function view()
	{
		$fb = new Facebook();
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['read_page_mailboxes'];
		$loginUrl = $helper->getLoginUrl('https://facebook-phone-catcher-duongvanba.c9users.io/api/facebook/user-login', $permissions);
		return view('user.login',['loginUrl'=>$loginUrl]);
	}
	
	function auth(Request $r)
	{
		try{
		$fb = new Facebook();
		$helper = $fb->getRedirectLoginHelper();
	//	try {
			$accessToken = $helper->getAccessToken();
	//	} catch(Facebook\Exceptions\FacebookResponseException $e) {die('Lỗi xảy ra'); }

		if (! isset($accessToken)) { die('Lỗi xảy ra'); }
		
		

		$request = $fb->request('GET', '/me',[], $accessToken);
		
	//	try {
			 $response = $fb->getClient()->sendRequest($request);
	//	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
	//	echo 'Graph returned an error: ' . $e->getMessage();
	//	exit;
	//	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
	//	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	//	exit;
	//	}

		$graphNode = $response->getGraphNode(); 
		
		
		$fid = $graphNode['id'];
		
		$user = DB::table('users')->where('fid',$fid)->get()->first();
		if($user == null)
		{
			return view('user.notFound', ['fid'=>$fid, 'name'=>$graphNode['name']]);
		}else{
			DB::table('users')
            ->where('fid', $fid)
            ->update(['session' => session_id(),'name'=>$graphNode['name']]);
            header('Location: /user'); exit;
		}
		
		}catch(Exception $e){};
	}
	
}