<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	    // アプリ用にログイン済みの時はレスポンスを返す
	    if(Auth::check())
	    {
		    return self::rtnJson(0, Auth::id());
	    }
        return view('home');
    }

	public function rtnJson($result, $id=null)
	{
		$response = array();

		$response["result"] = $result;
		$response["id"] = $id;

		return response()->json($response, 200);
	}

}
