<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

class PageController extends Controller
{
    public function home(){
      $databaseResult = DB::table('tblImages')->get();
      return view('portfolio',['database' => $databaseResult]);
    }

    public function databasePost()
    {
      if(isset($_REQUEST["url"]) &&isset($_REQUEST["message"]) &&isset($_REQUEST["location"])){
      DB::table('tblImages')->insert(['imageUrl' => $_REQUEST["url"], 'imageStory'=>$_REQUEST["message"], 'imageLocation'=>$_REQUEST["location"]]);
      }
    }
}
