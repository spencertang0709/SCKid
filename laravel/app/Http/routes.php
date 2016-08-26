<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/GCMServiceWorker', function () {
	return view('GCM');
});

Route::get('/GCMSend', 'GCMController@index');

Route::get('/GCMUpstream', 'GCMUpstreamListener@index');

Route::get('/GCM', [
	'uses' => 'GCMSendController@index',
	'as' => 'GCM'
]);

Route::get('/GCMReceive', function(){
	 return view('GCMReceive');
 });

Route::get('/GCMTest','GCMTestController@index');

Route::post('/GCM/{device}', 'GCMSendController@send');

//These are public pages the user can access basic routes
/////////////////////////////////////////////////////////

Route::get('/', function () {
    return view('welcome');
});

Route::get('/elements', function () {
    return view('knowledgeContent.elements');
});

Route::get('/file',function(){
    echo asset('storage/file.txt');
});

Route::get('/filemake',function(){
    Storage::makeDirectory('dir');
    Storage::disk('local')->put('newFile.txt', 'Contents');
});

Route::get('/arrangeTimeSlots', 'ArrangeTimeSlotsController@arrange');

Route::get('/selectKid', 'CurrentKidController@Select');

Route::get('/sessionLogout',[
	'uses' => 'LogOut@index',
	'as' => 'logout.session'
]);

//use this way to avid routes appending itself
Route::get('/knowledge/addArticle',[
	'uses'=>'KnowledgeAddArticleController@index',
	'as'=>'addArticle.knowledge'
]);

Route::post('/knowledge/saveArticle', [
    'uses' => 'KnowledgeAddArticleController@saveArticle',
    'as' => 'saveArticle'
]);

Route::get('/knowledge/showCategory', [
    'uses' => 'KnowledgeAddArticleController@showCategory',
    'as' => 'showCategory.knowledge'
]);

Route::get('/knowledge/showTitle/{category_id}', [
    'uses' => 'KnowledgeAddArticleController@showTitle',
    'as' => 'showTitle.knowledge',
]);

Route::get('/knowledge/showArticle/{title_id}', [
    'uses' => 'KnowledgeAddArticleController@showArticle',
    'as' => 'showArticle.knowledge',
]);

Route::post('/knowledge/showSearchResult',[
	'uses' => 'SearchController@articleSearch',
	'as' => 'searchKeyWord.knowledge',
]);

Route::get('/knowledge/search', 'SearchController@knowledgeSearch');

Route::get('/knowledge/categories', function () {
    return view('knowledge.categories');
});

// Route::get('/knowledge/categories','KnowledgeAddArticleController@showCategory');

Route::get('/knowledge/article', function () {
    return view('knowledge.article');
});
Route::get('/knowledge/categories/basics', function () {
    return view('knowledge.basics');
});
Route::get('/knowledge/categories/mobile', function () {
    return view('knowledge.mobile');
});
Route::get('/knowledge/categories/comms', function () {
    return view('knowledge.comms');
});
Route::get('/knowledge/categories/attacks', function () {
    return view('knowledge.attacks');
});
Route::get('/knowledge/categories/protect', function () {
    return view('knowledge.protect');
});
Route::get('/knowledge/categories/tools', function () {
    return view('knowledge.tools');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

// //Password change
// Route::post('/password/change', [
// 'uses' => 'Auth\PasswordController@change',
// 'as' => 'changePassword'
// ]);

//Password change
Route::post('/password/change', [
'uses' => 'ChangePasswrodController@change',
'as' => 'changePassword'
]);

//policy
Route::post('/policy',[
    'uses' => 'PolicyController@store',
    'as' => 'addPolicy'
]);


////////////////////////////////////////////////////////

Route::get('/email','UserController@sendEmail');


//For downloading our apk file, documentation etc
Route::get('/download',function($pathToFile){
    return response()->download($pathToFile);
});

//These are added by running
//php artisan make:auth
//This redirects to the common layout if we leave it here
//This sets up all routes for registration, login and password reset
Route::auth();

// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');
//
//// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');

//Route group for the admin panel for logged in users
Route::group(['middleware' => 'auth'], function () {
    Route::delete('/policy/delete/{policy}',[
        'uses' => 'PolicyController@destroy',
        'as' => 'delete.policy'
    ]);


    //These are our action routes
    Route::get('/home', 'HomeController@index');

    Route::get('/kids', 'KidController@index');
    Route::post('/kids', 'KidController@store');
    Route::delete('/kids/destroy/{kid}', 'KidController@destroy');

    Route::get('/apps', 'AppController@index');
    Route::put('/apps', 'AppController@update');
    Route::post('/apps', 'AppController@store');

	Route::get('/beacons', [
        'uses' => 'BeaconSettingController@index',
        'as' => 'beacons'
]);
	Route::post('/beacons', 'BeaconSettingController@store');
	Route::delete('/beacons/destroy/{beacon_setting}', 'BeaconSettingController@destroy');

    Route::get('/websites', 'WebsiteController@index');
    Route::post('/websites', 'WebsiteController@store');
    Route::delete('/websites/destroy/{website}', 'WebsiteController@destroy');

	Route::get('/posts', 'PostController@index');

    Route::get('/image', 'ImageController@index');

	Route::get('/likes', 'LikeController@index');

    Route::delete('/devices/destroy/{device_id}', 'DeviceController@destroy');

    Route::get('/devices', [
        'uses' => 'DeviceController@index',
        'as' => 'deviecs']
    );

    Route::get('/devices/verify', [
        'uses' => 'DeviceController@verifyCode',
        'as' => 'verify.devices'
    ]);

    Route::get('/settings', 'SettingController@index');

    Route::get('/time', 'TimeController@index');
    Route::post('/time', 'TimeController@store');

    Route::get('/sms', [
        'uses' => 'SmsController@index',
        'as' => 'sms'
    ]);

    Route::get('/calls', [
        'uses' =>'CallController@index',
        'as' => 'calls'
    ]);

    Route::get('/locations', [
        'uses' => 'LocationController@index',
        'as' => 'location'
    ]);

    Route::get('/messages', 'MessageController@index');

    Route::get('/panics', function () {
        return view('panics');
    });

    Route::get('/settings', function () {
        return view('settings');
    });

    Route::get('/account', function () {
        return view('account');
    });


    Route::get('/mailbox', function () {
        return view('mailbox');
    });

    Route::get('/stats', [
        'uses' => 'StatsController@index',
        'as' => 'stats'
    ]);

    Route::get('/social', function () {
        return view('social');
    });

    Route::get('/help', function () {
        return view('help');
    });

    Route::get('/smart_filter', function () {
        return view('smart_filter');
    });



    //Social Media
    Route::get('/facebook', 'FacebookController@index');
    Route::get('/facebook/destroy', 'FacebookController@destroy');
    Route::get('/auth/facebook', 'Auth\FacebookController@redirectToProvider');
    Route::get('/auth/facebook/callback', 'Auth\FacebookController@handleProviderCallback');

    Route::get('/twitter', 'TwitterController@index');
    Route::get('/twitter/destroy', 'TwitterController@destroy');
    Route::get('/auth/twitter', 'Auth\TwitterController@redirectToProvider');
    Route::get('/auth/twitter/callback', 'Auth\TwitterController@handleProviderCallback');

    Route::get('/instagram', 'InstagramController@index');
    Route::get('/auth/instagram', 'Auth\InstagramController@redirectToProvider');
    Route::get('/auth/instagram/callback', 'Auth\InstagramController@handleProviderCallback');

    Route::get('/tumblr', 'TumblrController@index');
    Route::get('/auth/tumblr', 'Auth\TumblrController@redirectToProvider');
    Route::get('/auth/tumblr/callback', 'Auth\TumblrController@handleProviderCallback');
});


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

//Route group for API access via mobile app or other
//'before' => 'auth.basic'
Route::group(array('prefix' => 'api/v1'), function() {

    //Unauthenticated routes
    Route::post('auth', 'Api\AuthApiController@auth');
    Route::post('signup','Api\AuthApiController@signup');

    Route::resource('websites', 'Api\WebsiteController');
    Route::resource('devices', 'Api\DeviceController');
    Route::resource('kids', 'Api\KidController');
    Route::resource('social', 'Api\SocialMediaController');

    Route::resource('calls', 'Api\CallController');
    Route::resource('beacons', 'Api\BeaconController');
    Route::resource('times', 'Api\TimeController');
    Route::resource('sms', 'Api\SmsController');
    Route::resource('apps', 'Api\AppController');
    Route::resource('panics', 'Api\PanicController');
    Route::resource('locations', 'Api\LocationController');
    Route::resource('settings', 'Api\SettingsController');
    Route::resource('messages', 'Api\MessageController');
	Route::resource('policies', 'Api\PolicyController');
    Route::get('user','Api\AuthApiController@getAuthenticatedUser');

    Route::resource('registerDevices','Api\VerificationCodeController');

	Route::resource('updateGCMKey', 'Api\GCMKeyController');

    //Sync routes
    Route::resource('sync','Api\SyncController');


    //AUTHENTICATED ROUTES ONLY
    //All these routes are restricted to authenticated API users only using JWT
    //Header Authorization Bearer {token}

//    Route::group(['middleware' => ['jwt.auth', 'jwt.refresh']], function() {
    Route::group(['middleware' => ['jwt.auth']], function() {

        Route::post('logout', 'Api\AuthApiController@logout');


    });
});
