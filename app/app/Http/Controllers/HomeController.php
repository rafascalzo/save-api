<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('client');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }


    /**
     * Return home information
     * @return Array
     */

     public function index(Request $request) {
         $user_id = $request->user_id;
         $user_data = User::findOrFail($user_id);
         $name = $user_data->name;
         $email = $user_data->email;

         $user_account = DB::select('select * from accounts where user_id = ? LIMIT 1', [$user_id])[0];
         
         $result = array(
            'user' => array(
                'name' => $name,
                'email' => $email        
            ),
            'account' => array(
                'balance' => $user_account->balance,
                'credit_limit' => $user_account->credit_limit,
                'borrowed_credit' => $user_account->borrowed_credit
            )
         );

         return $result;
         dd($user_data);
     }
}
