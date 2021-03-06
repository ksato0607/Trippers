<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', 'PostController@getWelcome')->name('welcome');
// Route::get('/', function () {
//     return view('auth.login');
// });

Route::post('/signup', [
  'uses' => 'UserController@postSignUp',
  'as' => 'signup'
]);

Route::post('/', [
  'uses' => 'UserController@postSignIn',
  'as' => 'signin'
]);

Route::post('/gotoDashboard', [
  'uses' => 'UserController@postDashboard',
  'as' => 'gotoDashboard'
]);

Route::post('/createpost', [
  'uses' => 'PostController@postCreatePost',
  'as' => 'post.create',
  'middleware' => 'auth'
]);

Route::get('/dashboard', [
  'uses' => 'PostController@getDashboard',
  'as' => 'dashboard',
  'middleware' => 'auth'
]);

Route::get('/logout', [
  'uses' => 'UserController@getLogout',
  'as' => 'logout'
]);

Route::post('/sendemail', function(\Illuminate\Http\Request $request, \Illuminate\Mail\Mailer $mailer) {
  $mailer
    //->from($request->input('mail'))
    ->to('contactus@laravel.319')
    ->send(new \App\Mail\MyMail($request->input('title'),$request->input('mail'),$request->input('body'),$request->input('phone'),$request->input('name')));
  return redirect()->back();
})->name('sendmail');

Route::get('/delete-post/{post_id}', [
  'uses' => 'PostController@getDeletePost',
  'as' => 'post.delete',
  'middleware' => 'auth'
]);

Route::post('/edit', [
  'uses' => 'PostController@postEditPost',
  'as' => 'edit'
]);

// Route::get('/account', [
//     'uses' => 'UserController@getAccount',
//     'as' => 'account'
// ]);

Auth::routes();
//Route::get('/home', 'HomeController@index');
Route::get('/', 'PostController@getDashboard')->name('dashboard');
Route::get('/test','PageController@databasePost'); //This is used to update travelling images 
Route::get('/profileUpdate','PageController@profilePost'); //This is used to update profile image
