<?php
namespace App\Http\Controllers;

use App\User;
use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facebook;
use File;

class Home extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    private $ssap;
    function __construct()
    {
        $accesskeyPath = base_path().'/config/accessToken/accessCredentials.json';
		$configPath    = base_path().'/config/accessToken/appConfig.json';
			
		$client = new Google_Client();
		$client->setApplicationName('Test');
		$client->setScopes(implode(' ', ['https://www.googleapis.com/auth/spreadsheets']));
		$client->setAuthConfig($configPath);
		$client->setAccessType('offline');
			
		$accessToken = json_decode(file_get_contents($accesskeyPath), true);
		$client->setAccessToken($accessToken);
		if ($client->isAccessTokenExpired())
			{
				 $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
				 File::put($configPath , json_encode($client->getAccessToken()));
			}
		$this->ssap = new Google_Service_Sheets($client);
    }
     
     
     
     
    public function callback(Request $request)
    {
        $data = $request->all();
        File::append('raw.txt', print_r($data,1)."\n", FILE_APPEND);
        
        try{
        if(isset($data['hub_mode'])){ echo $data['hub_challenge']; die(); };
        
        
        $e = $data['entry'][0];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        
        
        
        
        // Nếu là gửi tin nhắn
        if(isset($e['messaging']))
        {
            $time = date("d-m-Y H:i:s",$e['time']/1000);
            $text = $e['messaging'][0]['message']['text'];
            $mid   = $e['messaging'][0]['message']['mid'];
            
            
             $fb = new Facebook\Facebook(
            [
                'app_id' => '960024610808589',
                'app_secret' => 'd0defec9847bd6dd0ade614230b66d75',
                'default_graph_version' => 'v2.8',
            ]);
            $fb->setDefaultAccessToken('EAANpIyXnIw0BAMHuyPWC3v00NqJHo3wyF8iqrkYVzTi5BXCY5qpoVKfDNNewDCIf029DAUlcwTCEU3XwTs1Mxyau1Xa3JKevbeXXmweZBD5JRyOy6F6sUCbNrNZA71AgzVIBCAZBVLkQJADZAhXjYX8L3MTjNAhKZBy77w4fdMbDZA7ZByjkBXiEdOkuN1eIxMZD');
            $info = $fb->get('/m_'.$mid.'?fields=from')->getDecodedBody();            
            $userName = $info['from']['name'];
            $uid = $info['from']['id'];
            
            $t = "$time [Tin nhắn - $userName/$uid] : $text\n";
            File::append('data.txt', $t, FILE_APPEND);
            $this->add($t);
            header("HTTP/1.1 200 OK");
        exit;
            
        }
        
        // Nếu là bình luận
        if(isset($e['changes']))
        {
            $time = date("d-m-Y H:i:s",$e['time']);
            $t = $e['changes'][0]['value'];
            $text = $t['message'];
            $userName = $t['sender_name'];
            $uid      = $t['sender_id'];
            $t = "$time [Comment  - $userName/$uid] : $text\n";
            File::append('data.txt', $t, FILE_APPEND);
            $this->add($t);
            header("HTTP/1.1 200 OK");
            exit;
        }
        } catch (Exception $e) {
            File::append('error.txt', 'Caught exception: ',  $e->getMessage(), "\n", FILE_APPEND);
            header("HTTP/1.1 200 OK");
        exit;
        }
        
    }
    
    function add($text = 'No content')
    {
        
        $spreadsheetId = '1cIDK0b1VYUtII9giTcKAhsIE6dCdLSvZEPsmesb3LmY';
        $range = 'A!A:A';
        $values = [[$text]];
        $body = new Google_Service_Sheets_ValueRange(array(
            'values' => $values
        ));
        $params = ['valueInputOption' => 'RAW'];
        $result = $this->ssap->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
        
    }
}