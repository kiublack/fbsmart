<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Admin extends Controller
{
	function __construct()
	{
		session_start();
		$this->user = DB::table('users')->where('session', session_id())->first() ;
		if( $this->user == null || !in_array($this->user->fid, explode(',',  getenv('ADMIN_FACEBOOK_ID')) )  )
		{
			header('Location: /');
			exit; die();
		}	
	}
	
	function info()
	{
		$users = DB::table('users')->get();
		return view('admin.info', ['users'=>$users]);
		//echo '<pre>'.print_r($users).'</pre>';
		//echo '<form action="admin/add"><input name="id"/><input type="submit" value="Add"/></form>';
		
	}
	
	function add(Request $r)
	{
		
		$id = $r->input('fid');
		for($i=0; $i==0; $i++)
		{
			$id = str_replace(' ', '', $id);
			if(DB::table('users')->where('fid',$id)->first()!=null){ continue; };
			
			DB::table('users')->insert(['fid'=>$id]);
		}
		header('Location: /admin'); exit;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}