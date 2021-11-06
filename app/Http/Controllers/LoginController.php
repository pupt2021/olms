<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

class LoginController extends Controller
{
    //

    public function login_display(){
        return view('Login.login');
    }

    public function login_authenticate(Request $request){

        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials)){
            if(Auth::user() -> role_id == 1){
                return redirect()->route('Dashboard');
            }else{
                return redirect()->route('student_dashboard');
            }
        }else{
            return redirect()->route('user_login_page');
        }

    }

    public function logout(){
        auth::logout();
        return redirect()->route('user_login_page');
    }

    public function user_registration(Request $request){
        extract($request->all());

        $user_id = db::table('users')->insertGetId([
            'role_id' => 3,
            'username' => $username,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        db::table('user_details')->insert([
            'user_id' => $user_id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'stud_number' => $username,
        ]);

        $student_link = db::table('user_links')
            ->where('parent_link_id', 5)
            ->get();

       foreach($student_link as $data) {

           $id = $data->id;

           db::table('user_permission')
               ->insert([
                   'user_id' => $user_id,
                   'role_id' => 3,
                   'link_id' => $id,
                   'status' => "On"
               ]);
       }

        return response()->json(['status' => 'success' , 'message' => "Success!!"]);
    }


}
