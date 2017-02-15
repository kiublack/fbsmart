<?php
namespace App\Http\Controllers;

use View;
use Illuminate\Support\Facades\DB;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_Sheets;
use Google_Service_Sheets_Spreadsheet;
use Google_Service_Sheets_Sheet;
use Google_Service_Sheets_GridData;
use Google_Service_Sheets_CellData;
use Google_Service_Sheets_ExtendedValue;
use Google_Service_Sheets_RowData;
use Google_Service_Sheets_SheetProperties;
use Google_Service_Sheets_SpreadsheetProperties;

class User extends Controller
{
	
	private $user;
	function __construct()
	{
		session_start();
		$this->user = DB::table('users')->where('session', session_id())->first() ;
		if( $this->user == null  )
		{
			header('Location: /user/login'); exit;
		}
		
		$this->user->isAdmin = in_array($this->user->fid, explode(',',getenv('ADMIN_FACEBOOK_ID')));
		
		
	}
	
	
	function info()
	{
		// Refresh facebook pages
		$fb = new Facebook();
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['read_page_mailboxes','manage_pages',' pages_messaging'];
		$facebookRefreshPageUrl = $helper->getLoginUrl(getenv('APP_URL').'/api/facebook/page-token', $permissions);
		
		// Grand google permission
		$client = $this->getGoogleClient();
		$googleOauthUrl = $this->user->googleToken?'':$client->createAuthUrl();
		
		// Get page
		$pages = DB::table('pages')->where('userFid', $this->user->fid)->get();
		
		return view('user.info',[
			'facebookRefreshPageUrl'=>$facebookRefreshPageUrl,
			'googleOauthUrl'=>$googleOauthUrl,
			'pages'=>$pages,
			'user'=> $this->user
		]);
		
		
	}
	
	function addPagesPermission()
	{
		try {
		$fb = new Facebook();
		$helper = $fb->getRedirectLoginHelper();
		$accessToken = $helper->getAccessToken();
		if (!$accessToken->isLongLived())
		{
			$oAuth2Client = $fb->getOAuth2Client();
			$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		}
		$response = $fb->get('me/accounts',$accessToken)->getDecodedBody();
		$pages = $response['data'];
		$appendData = [];
		$userFid = $this->user->fid;
		foreach($pages as $page )
		{
			if(DB::table('pages')->where('pid', $page['id'])->first() != null){ continue; };
			array_push($appendData, [
				'pid'=>$page['id'],
				'facebookAccessToken'=>$page['access_token'],
				'userFid'=> $userFid,
				'name'=>$page['name'],
				'userId'=>$this->user->id
			]);
		}
		DB::table('pages')->insert($appendData);
		DB::table('users')->where(['session' => session_id()])->update(['facebookToken'=>'Updated']);
		header('Location: /user'); exit;
		} catch(Facebook\Exceptions\FacebookResponseException $e) {die('Lỗi xảy ra'); }	
		

		
            
	}
	
	function add_page(Request $r)
	{
		$client = $this->getGoogleClient();
		if( $this->user->googleToken=='')
		{
			header('Location: /user');
		}
		
		
		$fb = new Facebook();
		$page = DB::table('pages')->where('pid', $r->input('pid'))->get()->first();
		if($this->user->googleToken == null){ die('Chưa cấp phép truy cập Google'); };
		$endPoint = $page->pid.'/subscribed_apps';
		
		$data = [
			'object'=>'page',
			'callback_url'=>'https://facebook-phone-catcher-duongvanba.c9users.io/api/facebook/comment-post-event',
			'fields'=>'feed, message',
			'verify_token'=>'thisisaverifystring'
			];
		
		$r = $fb->post($endPoint, $data, $page->facebookAccessToken);
		$response = $r->getDecodedBody();
		
		if($page->sheetId == null)
		{
			$name = '[Quản lý] '.$page->name;
			$page->sheetId = $this->createPage($name);
			DB::table('pages')->where('pid', $page->pid)->update(['sheetId'=>$page->sheetId, 'active'=>1, 'googleAccessToken'=>$this->user->googleToken]);
		}
		DB::table('pages')->where('pid', $page->pid)->update(['active'=>1, 'googleAccessToken'=>$this->user->googleToken]);
		header('Location: /user'); exit;
	}
	
	function del_page(Request $r)
	{
		$page = DB::table('pages')->where('pid', $r->input('pid'))->first();
		DB::table('pages')->where('pid', $page->pid)->update(['active'=>0]);
		header('Location: /user');
		exit;
	}
	
	function forceDelPage(Request $r)
	{
		$pid = $r->input('pid');
		DB::table('pages')
		->where('pid', $r->input('pid'))
		->where('userFid', $this->user->fid)
		->delete();
		header('Location: /user'); exit;
		
	}
	
	
	function addGoogleToken(Request $r)
	{
		$client = $this->getGoogleClient();
		$client->authenticate($r->input('code'));
		$encoded = json_encode($client->getAccessToken());
		DB::table('users')->where('id', $this->user->id)->update(['googleToken'=>$encoded]);
		DB::table('pages')->where('userId', $this->user->id)->update(['googleAccessToken' => $encoded]);
		header('Location: /user');
		exit;
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
		$client->setAccessType('offline');
		if($this->user->googleToken != '')
		{
			$accessToken = (array)json_decode($this->user->googleToken);
			$client->setAccessToken($accessToken);
			
			if ($client->isAccessTokenExpired())
			{
				$refreshToken = $client->getRefreshToken();
    			$client->fetchAccessTokenWithRefreshToken($refreshToken);
    			$accessToken = $client->getAccessToken();
    			$accessToken['refresh_token'] = $refreshToken;
    			$encoded = json_encode($accessToken);
	    		DB::table('users')->where('id', $this->user->id)->update(['googleToken' => $encoded]);
    			DB::table('pages')->where('userId', $this->user->id)->update(['googleAccessToken' => $encoded]);
			}
			
			
			
		}
		$client->addScope(implode(' ', $scopes));
		return $client;
	}
	
	function logout()
	{
		DB::table('users')
            ->where('session', session_id())
            ->update(['session' => '']);
            header('Location: /'); exit;
	}
	
	function createPage($title)
	{
		$createGirdData = function($rowsDataRaw)
		{
			// Tạo bảng mới
			$gird = new Google_Service_Sheets_GridData();
			
			// Mảng dữ liệu cấu trúc của các dòng
			$rowsData = [];
			foreach($rowsDataRaw as $rowDataRaw)
			{
				// Dữ liệu cấu trúc 1 dòng
				$rowData = new Google_Service_Sheets_RowData();
				
				// Mảng dữ liệu cấu trúc từng ô trong dòng
				$cellsData = [];
				foreach($rowDataRaw as $cellDataRaw)
				{
					// Dữ liệu cấu trúc của từng ô
					$cellData = new Google_Service_Sheets_CellData();
					// Tạo giá trị cho ô đó
					$cellValue = new Google_Service_Sheets_ExtendedValue();
					if($cellDataRaw != '' )
					{
					if(strlen($cellDataRaw)==0 || substr($cellDataRaw,0,1) != '=')
					{
						$cellValue->setStringValue($cellDataRaw);
					}else{
						$cellValue->setFormulaValue($cellDataRaw);
					}
					}
					// Set giá trị cho ô
					$cellData->setUserEnteredValue($cellValue);
					
					// Thêm ô vào mảng cấu trúc các ô trên dòng đó
					array_push($cellsData, $cellData);
				}
				// Set cấu trúc ô cho dòng
				$rowData->setValues($cellsData);
				// Thêm ô vào mảng cấu trúc các dòng trong lưới
				array_push($rowsData, $rowData);
			}
			// Set cấu trúc dòng cho lưới
			$gird->setRowData($rowsData);
			return $gird;
		};
		
		$ssapp = new Google_Service_Sheets($this->getGoogleClient());
		$ns = new Google_Service_Sheets_Spreadsheet();
		// Sheet data
		$dataSheet = new Google_Service_Sheets_Sheet();
		$properties = new Google_Service_Sheets_SheetProperties();
		$properties->setTitle('Data');
		$properties->setHidden(true);
		$dataSheet->setProperties($properties);
		
		// Customer sheet
		$customersSheet = new Google_Service_Sheets_Sheet();
		$values = [
			['ID','Tên','Link','Gửi lần cuối','Nội dung','Các số điện thoại nhận diện được'],
			['=UNIQUE(Data!A:C)','','','=if(A2<>"";MAX(QUERY(Data!$A:$D;"select D where A = "&A2));"")','=if(A2<>"";JOIN("'."\n".'";UNIQUE(QUERY(Data!$A:$G;"select F where A = "&A2)));"")','=if(A2<>"";JOIN("'."\n".'";UNIQUE(QUERY(Data!$A:$G;"select G where A = "&A2)));"")']
		];
		
		$customersSheet->setData($createGirdData($values));
		$properties = new Google_Service_Sheets_SheetProperties();
		$properties->setTitle('Danh sách khách hàng');
		$customersSheet->setProperties($properties);
		
		
		$ns->setSheets([$customersSheet, $dataSheet]);
		$properties = new Google_Service_Sheets_SpreadsheetProperties();
		$properties->setTitle($title);
		$ns->setProperties($properties);
		
		return $ssapp->spreadsheets->create($ns)->spreadsheetId;
		
	}
	
	
}