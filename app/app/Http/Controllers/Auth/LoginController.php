<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use View;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm(Request $request) {
        return View::make('auth.login');
    }

    public function validateLogin(LoginFormRequest $request) {
        try{
            $email          = $request->email;
            $password       = $request->password;
            $waiterRoleId   = config('constants.user_types.waiter');
            $cashierRoleId  = config('constants.user_types.cashier');
            $adminRoleId  = config('constants.user_types.admin');

            $user = User::where('email', $email)
                        ->whereIn('user_role_id', [$waiterRoleId, $cashierRoleId, $adminRoleId])
                        ->first();

            if($user && auth()->attempt(['email' => $email, 'password' => $password])) {
                return interpretJsonResponse(true, 200, null, null);
            } else {
                return interpretJsonResponse(false, 500, null, "Login credentials are incorrect. Please enter again.");
            }
        } catch(Exception $e) {
            return interpretJsonResponse(false, 500, null, 'Something went wrong.');
        }
    }

    public function logout(Request $request) {
        auth()->logout();

        return redirect()->route('login');
    }
}
