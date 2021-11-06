<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    protected $controller;
    protected $routeName;

    public function __construct(array $attributes = array())
    {
        /* if controller is not compatible with slug name */
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($this -> controller, $action) = explode('Controller@', $controllerAction);

        $this -> routeName = Route::currentRouteName();

    }

    public function index()
    {
        if(auth::check() == true){
            $user_permission = \Illuminate\Support\Facades\DB::table('user_links as a')
                ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
                ->where('b.user_id', auth::user()->id)
                ->where('b.status' , '=' , 'On')
                ->Where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
                ->Where('link_id', '!=', 0)
                ->get();

            $role = db::table('user_role')
                ->where('role_status', 1)
                ->where('role_id', '!=' , 1)
                ->get();

            $gender = db::table('gender')
                ->where('status', 1)
                ->get();

            $course = db::table('courses')
                ->where('status', 1)
                ->get();

            if($user_permission -> contains('slug_name', $this -> routeName)){
                return view('User.listuser')
                    ->with('role', $role)
                    ->with('gender', $gender)
                    ->with('course', $course)
                    ->with('user_perm', $user_permission);
            }else{
                return redirect()->route('Dashboard');
            }
        }else{
            return redirect()->route('user_login_page');
        }
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
        extract($request->all());

        if($id != '') {

            db::table('user_details')
                ->where('user_id', $id)
                ->update([
                    'course_id' => $course,
                    'gender_id' => $gender,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'middlename' => $middlename,
                    'birthday' => $birthdate,
                    'contact_no' => $contactno,
                    'address' => $address,
                    'city' => $city,
                    'zip_code' => $zipcode,
                    'stud_number' => $student_number ? $student_number : '',
                    'faculty_code' => $faculty_code ? $faculty_code : '',
                    'employee_number' => $employee_number ? $employee_number : '',
                    'employee_status' => $employee_status ? $employee_status : '0',
                ]);

            return response()->json(['status' => 'success' , 'message' => "User Details is successfully updated"]);

        }else{
            $user_id = db::table('users')->insertGetId([
                'role_id' => $user_role,
                'username' => $username,
                'email' => $email,
                'password' => bcrypt($password)
            ]);

            db::table('user_details')->insert([
                'user_id' => $user_id,
                'course_id' => $course,
                'gender_id' => $gender,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'middlename' => $middlename,
                'birthday' => $birthdate,
                'contact_no' => $contactno,
                'address' => $address,
                'city' => $city,
                'zip_code' => $zipcode,
                'stud_number' => $student_number,
                'faculty_code' => $faculty_code,
                'employee_number' => $employee_number,
                'employee_status' => $employee_status,
            ]);

            return response()->json(['status' => 'success' , 'message' => "User Data is successfully inserted"]);
        }


    }
    public function show($id)
    {
        //

        $role = db::table('user_role')
            ->where('role_status', 1)
            ->where('role_id', '!=' , 1)
            ->get();

        $gender = db::table('gender')
            ->where('status', 1)
            ->get();

        $course = db::table('courses')
            ->where('status', 1)
            ->get();

        $data = db::table('users')
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->where('users.status', 1)
            ->where('users.role_id', '!=', 1)
            ->where('users.id', $id)
            ->get();

        return view('User.edituser')
            ->with('role', $role)
            ->with('gender', $gender)
            ->with('course', $course)
            ->with('data', $data);


    }
    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    public function UserDatatables(){

        $data = db::table('users')
            ->select("*","users.id as userid", DB::raw("CONCAT(lastname,',',firstname) as fullname"))
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->where('users.status', 1)
            ->where('users.role_id', '!=', 1);

        $user_permission = \Illuminate\Support\Facades\DB::table('user_links as a')
            ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
            ->where('b.user_id', auth::user()->id)
            ->where('b.status' , '=' , 'On')
            ->where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
            ->where('b.link_id' , '!=' , 0)
            ->get();
        if($user_permission -> contains('slug_name', 'User.show') && $user_permission -> contains('slug_name', 'UserDelete')) {
            return DataTables::query($data)
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-horizontally">
                                <a type="button" class="btn btn-info data-edit" href=' . route('User.show', $row->id) . ' "><span class="fa fa-edit">&nbsp;&nbsp;</span>Edit</a>
                                <a type="button" class="btn btn-warning data-delete" id="data-delete" data-id=' . $row->userid . ' ><span class="fa fa-trash">&nbsp;&nbsp;</span>Delete</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }elseif($user_permission -> contains('slug_name', 'User.show')) {
            return DataTables::query($data)
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-horizontally">
                                <a type="button" class="btn btn-info data-edit" href=' . route('User.show', $row->id) . ' "><span class="fa fa-edit">&nbsp;&nbsp;</span>Edit</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }elseif($user_permission -> contains('slug_name', 'UserDelete')) {
            return DataTables::query($data)
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-horizontally">
                                <a type="button" class="btn btn-warning data-delete" id="data-delete" data-id=' . $row->userid . ' ><span class="fa fa-trash">&nbsp;&nbsp;</span>Delete</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }else{
            return DataTables::query($data)
                ->toJson();
        }
    }
    public function UserDelete(Request $request){
        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'status' => 0
            ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function UserProfile_View(){
        $role = db::table('user_role')
            ->where('role_status', 1)
            ->where('role_id', '!=' , 1)
            ->get();

        $gender = db::table('gender')
            ->where('status', 1)
            ->get();

        $course = db::table('courses')
            ->where('status', 1)
            ->get();

        $data = db::table('users')
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->where('users.status', 1)
            ->where('users.role_id', '!=', 1)
            ->where('users.id', Auth::user()->id)
            ->get();

        return view('UserProfile.view')
            ->with('role', $role)
            ->with('gender', $gender)
            ->with('course', $course)
            ->with('data', $data);
    }

    public function UserProfile_UpdateView(){
        $role = db::table('user_role')
            ->where('role_status', 1)
            ->where('role_id', '!=' , 1)
            ->get();

        $gender = db::table('gender')
            ->where('status', 1)
            ->get();

        $course = db::table('courses')
            ->where('status', 1)
            ->get();

        $data = db::table('users')
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->where('users.status', 1)
            ->where('users.role_id', '!=', 1)
            ->where('users.id', Auth::user()->id)
            ->get();

        return view('UserProfile.updateview')
            ->with('role', $role)
            ->with('gender', $gender)
            ->with('course', $course)
            ->with('data', $data);
    }

    public function UserProfile_Update(Request $request){

        extract($request->all());

        $validator = Validator::make($request->all(), [
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error' , 'message' => "Picture is required. You must put picture to continue."]);
        }else{

        $imageName = $lastname.'-'.$firstname.'.'.$request->picture->extension();
        $request->picture->move(public_path('images'), $imageName);

        db::table('user_details')
            ->where('user_id', $id)
            ->update([
                'image_url' => $imageName,
                'course_id' => $course,
                'gender_id' => $gender,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'middlename' => $middlename,
                'birthday' => $birthdate,
                'contact_no' => $contactno,
                'address' => $address,
                'city' => $city,
                'zip_code' => $zipcode,
                'stud_number' => $student_number ? $student_number : '',
                'faculty_code' => $faculty_code ? $faculty_code : '',
                'employee_number' => $employee_number ? $employee_number : '',
                'employee_status' => $employee_status ? $employee_status : '0',
            ]);

        return response()->json(['status' => 'success' , 'message' => "My Profile is successfully updated"]);
        }

    }

    public function SearchBook(){
        return view('UserProfile.searchbook');
    }

    public function SearchBookDatatables(){
        $data = \Illuminate\Support\Facades\DB::table('materials')
            ->select('*',  DB::raw('(CASE WHEN type = 1 THEN "ISSUING" WHEN type = 2 THEN "BORROWING" END) AS type'), DB::raw('(CASE WHEN is_available = 0 THEN "NOT AVAILABLE" WHEN is_available = 1 THEN "AVAILABLE" WHEN is_available = 2 THEN "RESERVED" END) AS is_available'))
            ->where('status', 1);

        return DataTables::query($data)
            ->toJson();
    }




}
