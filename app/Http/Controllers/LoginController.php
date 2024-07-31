<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Employee;
use App\Models\EmployeeLoginLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function login(LoginRequest $request) {
        $data = $request->validated();
        $user = Employee::where('username', $data['username'])->first();

        if ($user && Crypt::encryptString($data['password'] == $user->password) ) {
            
            EmployeeLoginLog::create(['employee_id' => $user->id, 'created_at' => Carbon::now()]);
            Session::put('user', $user);
            return redirect()->route("dashboard");
        }

        return back()->with('loginError', 'username atau password salah');

    }

    public function logout(Request $request){
        if(session()->has('user')){
            session()->pull('user');
        }
        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }
}
