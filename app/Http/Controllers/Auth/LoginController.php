<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/events/list';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Auth Email to tel
     */
	public function username()
	{
		return 'tel';
	}

	protected function redirectTo()
	{
		// 登録から１か月の仮権限判定
		if(Auth()->user()->approval==9)
		{
			if(strtotime(Auth()->user()->created_at) < strtotime('-1 month'))
			{
				Auth()->user()->approval = 0;
				Auth()->user()->save();
			}
		}
		return '/events/list';
	}
}
