<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

class ArchivesController extends Controller
{
    //

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

    public function materials_list(){
        if(auth::check() == true){

            $user_permission = db::table('user_links as a')
                ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
                ->where('b.user_id', auth::user()->id)
                ->where('b.status' , '=' , 'On')
                ->Where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
                ->Where('link_id', '!=', 0)
                ->get();

            if($user_permission -> contains('slug_name', $this -> routeName)){
                return view('Archives.materials');
            }else{
                return redirect()->route('Dashboard');
            }
        }else{
            return redirect()->route('user_login_page');
        }
    }

    public function materials_list_datatables(){
        $data = DB::table('materials')
            ->select('*',  DB::raw('(CASE WHEN type = 1 THEN "Borrowing" WHEN type = 2 THEN "Room Use" END) AS material_type'))
            ->where('status', 0);

        $data2 = DB::table('materials_subject_link as a')
            ->join('materials as b', 'a.mat_id', '=', 'b.materials_id')
            ->join('materials_subject as c', 'a.sub_id', '=', 'c.id');


            return DataTables::query($data)
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id=' . $row->materials_id . ' data-type="materials" ><span class="fa fa-backward">&nbsp;&nbsp;</span>Restore</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();

    }

    public function users_list(){
        if(auth::check() == true){

            $user_permission = db::table('user_links as a')
                ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
                ->where('b.user_id', auth::user()->id)
                ->where('b.status' , '=' , 'On')
                ->Where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
                ->Where('link_id', '!=', 0)
                ->get();

            if($user_permission -> contains('slug_name', $this -> routeName)){
                return view('Archives.users');
            }else{
                return redirect()->route('Dashboard');
            }
        }else{
            return redirect()->route('user_login_page');
        }
    }

    public function users_list_datatables(){
        $data = db::table('users')
            ->select("*","users.id as userid", DB::raw("CONCAT(lastname,',',firstname) as fullname"))
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->where('users.status', 0)
            ->where('users.role_id', '!=', 1);

            return DataTables::query($data)
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id=' . $row->userid . ' data-type="users" ><span class="fa fa-backward">&nbsp;&nbsp;</span>Restore</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
    }

    public function borrowing_list(){
        if(auth::check() == true){
            $user_permission = db::table('user_links as a')
                ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
                ->where('b.user_id', auth::user()->id)
                ->where('b.status' , '=' , 'On')
                ->Where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
                ->Where('link_id', '!=', 0)
                ->get();

            if($user_permission -> contains('slug_name', $this -> routeName)){
                return view('Archives.borrowings');
            }else{
                return redirect()->route('Dashboard');
            }
        }else{
            return redirect()->route('user_login_page');
        }
    }

    public function borrowing_list_datatables(){
        $data = DB::table('borrowings as a')
            ->select('a.id as id','c.accnum as accnum','a.date_borrowed as date_borrowed','a.date_returned as date_returned', DB::raw("CONCAT(b.lastname,',',b.firstname) as fullname"))
            ->join('user_details as b', 'a.users_id', '=' , 'b.user_id')
            ->join('materials as c', 'a.materials_id', '=', 'c.materials_id')
            ->where('a.type' , 2)
            ->where('a.status', 0);

        return DataTables::query($data)
            ->filterColumn('fullname', function($query, $keyword) {
                $sql = "CONCAT(b.lastname,',',b.firstname)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($row) {
                $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id=' . $row->id . ' data-type="borrowings" ><span class="fa fa-backward">&nbsp;&nbsp;</span>Restore</a>
                            </div></td>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function issuing_list(){
        if(auth::check() == true){
            $user_permission = db::table('user_links as a')
                ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
                ->where('b.user_id', auth::user()->id)
                ->where('b.status' , '=' , 'On')
                ->Where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
                ->Where('link_id', '!=', 0)
                ->get();

            if($user_permission -> contains('slug_name', $this -> routeName)){
                return view('Archives.issuing');
            }else{
                return redirect()->route('Dashboard');
            }
        }else{
            return redirect()->route('user_login_page');
        }
    }


    public function issuing_list_datatables(){
        $data = DB::table('borrowings as a')
            ->select('a.id as id','c.accnum as accnum','a.date_borrowed as date_borrowed','a.date_returned as date_returned', DB::raw("CONCAT(b.lastname,',',b.firstname) as fullname"))
            ->join('user_details as b', 'a.users_id', '=' , 'b.user_id')
            ->join('materials as c', 'a.materials_id', '=', 'c.materials_id')
            ->where('a.type' , 1)
            ->where('a.status', 0);

        return DataTables::query($data)
            ->filterColumn('fullname', function($query, $keyword) {
                $sql = "CONCAT(b.lastname,',',b.firstname)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($row) {
                $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id=' . $row->id . ' data-type="borrowings" ><span class="fa fa-backward">&nbsp;&nbsp;</span>Restore</a>
                            </div></td>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function Archive_Restore(Request $request){

        if($request->type == "borrowings"){
            db::table('borrowings')
                ->where('id', $request->id)
                ->update([
                    'status' => 1
                ]);
        }
        if($request->type == "users"){
            db::table('users')
                ->where('id', $request->id)
                ->update([
                    'status' => 1
                ]);
        }
        if($request->type == "materials"){
            db::table('materials')
                ->where('materials_id', $request->id)
                ->update([
                    'status' => 1
                ]);
        }

        return response()->json([
            'status' => 'success'
        ]);

    }
}
