<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Home page
Route::get('/', function(){ return view('home'); });


// User



// Dành cho thành viên
Route::group(['prefix' => 'user'], function () {
   Route::get('', 'User@info'); // User info
   Route::get ( 'logout', 'User@logout'); // Logout
   Route::get ( 'login' , 'Login@view');  // Login
   Route::post( 'login' , 'Login@auth');  // Login auth code from facebook respone
   Route::get('addPage', 'User@add_page');
   Route::get('delPage', 'User@del_page');
   Route::get('forceDelPage', 'User@forceDelPage');
   
});


//API
Route::group(['prefix' => 'api'], function () {
    
   // Facebook
   Route::group(['prefix' => 'facebook'], function () {
   	
   		// On event
   		Route::get('comment-post-event','WebhookEvent@verfy');
   		Route::post('comment-post-event','WebhookEvent@evt');
   		
   		// On receive login token
   		Route::get( 'user-login' , 'Login@auth');
   		Route::get( 'page-token' , 'User@addPagesPermission');
   		
   });
   
   Route::group(['prefix' => 'google'], function () {
      
      
      
         Route::get('callback','User@addGoogleToken');
         
         //Route::get('callback','Test@ahihi');
   });
    
    
});




Route::get('/ahihi','Test@gg')	;

Route::group(['prefix' => 'admin'], function () {
   
   Route::get('', 'Admin@info');
   Route::get('add', 'Admin@add');
   

});

Route::get('/dm',function(){return view('user.notFound', ['fid'=>384782374837483]); });