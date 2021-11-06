<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        //
        if(auth::check() == true){
            $user_permission = \Illuminate\Support\Facades\DB::table('user_links as a')
                ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
                ->where('b.user_id', auth::user()->id)
                ->where('b.status' , '=' , 'On')
                ->Where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
                ->Where('link_id', '!=', 0)
                ->get();

            if($user_permission -> contains('slug_name', $this -> routeName)){
                return view('Roles.listroles')
                    ->With('user_perm', $user_permission);
            }else{
                return redirect()->route('Dashboard');
            }
        }else{
            return redirect()->route('user_login_page');
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        extract($request->all());

        $data = [
            'role_name' => $role_name,
            'role_description' => $role_description
        ];

        if($role_id != ''){

            db::table('user_role')
                ->where('role_id', $role_id)
                ->update($data);

            return response()->json(['status' => 'success' , 'message' => "Role Data is successfully updated"]);

        }else{

            db::table('user_role')
                ->insert($data);

            return response()->json(['status' => 'success' , 'message' => "Role Data is successfully inserted"]);
        }


    }

    public function show($id)
    {
        //
        $data = db::table('user_role')
            ->where('role_id', $id)
            ->get();

        return response()->json($data);
    }

    public function RolesDatatables(){

        $data = DB::table('user_role')
            ->select('role_id as id','role_name', 'role_description')
            ->where('role_status', 1)
            ->where('role_id', '!=' , 1);

        $user_permission = \Illuminate\Support\Facades\DB::table('user_links as a')
            ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
            ->where('b.user_id', auth::user()->id)
            ->where('b.status' , '=' , 'On')
            ->where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
            ->where('b.link_id' , '!=' , 0)
            ->get();


        if($user_permission -> contains('slug_name', 'Roles.show') && $user_permission -> contains('slug_name', 'RolesDelete')) {
            return DataTables::query($data)
                ->addColumn('action', function($row){
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id='.  $row->id .' ><span class="fa fa-edit">&nbsp;&nbsp;</span>Edit</a>
                                <a type="button" class="btn btn-warning data-delete" id="data-delete" data-id='.  $row->id .' ><span class="fa fa-trash">&nbsp;&nbsp;</span>Delete</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }elseif($user_permission -> contains('slug_name', 'Roles.show')) {
            return DataTables::query($data)
                ->addColumn('action', function($row){
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id='.  $row->id .' ><span class="fa fa-edit">&nbsp;&nbsp;</span>Edit</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }elseif($user_permission -> contains('slug_name', 'RolesDelete')) {
            return DataTables::query($data)
                ->addColumn('action', function($row){
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-warning data-delete" id="data-delete" data-id='.  $row->id .' ><span class="fa fa-trash">&nbsp;&nbsp;</span>Delete</a>
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

    public function RolesDelete(Request $request){
        DB::table('user_role')
            ->where('role_id', $request->id)
            ->update([
                'role_status' => 0
            ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

}
