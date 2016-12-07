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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/signup', [
  'uses' => 'UserController@postSignUp',
  'as' => 'signup'
]);

Route::post('/signin', [
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
Route::get('/home', 'HomeController@index');



//Keisiuke's
Route::get('/tripStart', 'PageController@home')->name('tripStart');
Route::get('/test','PageController@databasePost');

//
// Route::get('image-upload','PageController@imageUpload');
// Route::post('/','PageController@imageUploadPost');
