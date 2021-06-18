<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\models\User;
use Hash;

class ResetPasswordController extends Controller
{
    public function getPassword($token) {

       return view('auth.reset', ['token' => $token]);
    }

    public function updatePassword(Request $request, $token)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where(['email' => $request->email, 'token' => $request->token])
                            ->first();

        if(!$updatePassword)
            return response()->json('error', 'Invalid token!');

          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);


          DB::table('password_resets')->where(['email'=> $request->email])->delete();
            return response()->json('Your password has been changed!', 200);
        //   return redirect('/login')->with('message', 'Your password has been changed!');
    }
}