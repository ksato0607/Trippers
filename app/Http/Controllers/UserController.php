<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

  public function postSignUp(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email|unique:users2',
      'first_name' => 'required|max:120',
      'password' => 'required|min:4'
    ]);

    $email = $request['email'];
    $first_name = $request['first_name'];
    $password = bcrypt($request['password']);

    $user = new User();
    $user->email = $email;
    $user->first_name = $first_name;
    $user->password = $password;

    $user->save();

    Auth::login($user);

    return redirect()->route('dashboard');
  }

  public function postDashboard(Request $request)
  {
    return redirect()->route('dashboard');
  }

  public function postSignIn(Request $request)
  {
    $this->validate($request, [
      'email' => 'required',
      'password' => 'required'
    ]);
    if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
      return redirect()->route('dashboard');
    }
    $databaseResult = DB::table('tblImages')->get();
    $loginResult = "error";
    return view('dashboard', ['database' => $databaseResult],['login' => $loginResult]);
    //return redirect()->route('dashboard'); //use this or the one above
  }
    public function getAccount()
    {
      return view('account', ['user' => Auth::user()]);
    }

    public function getLogout()
    {
      Auth::logout();
      return redirect()->route('dashboard');
    }
}
