<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class PermissionController extends Controller
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

        if(\Illuminate\Support\Facades\Auth::check() == true){
            $user_permission = db::table('user_links as a')
                ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
                ->where('b.user_id', auth::user()->id)
                ->where('b.status' , '=' , 'On')
                ->Where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
                ->Where('link_id', '!=', 0)
                ->get();


            if($user_permission -> contains('slug_name', $this -> routeName)){
                return view('Permssions.index')
                    ->with('user_perm', $user_permission);
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
        $parent_nav_links = db::table('user_links_parent')->get();
        $nav_links = DB::table('user_links')->get();
        if(Auth::user() -> username == "admin"){
            $users = db::table('users')
                ->leftJoin('user_permission', 'users.id', '=', 'user_permission.user_id')
                ->where('users.status', 1)
                ->whereNull('user_permission.user_id')
                ->groupBy('users.id')
                ->get();
        }else{
            $users = db::table('users')
                ->leftJoin('user_permission', 'users.id', '=', 'user_permission.user_id')
                ->where('id', '!=' ,1)
                ->where('users.status', 1)
                ->whereNull('user_permission.user_id')
                ->groupBy('users.id')
                ->get();
        }


        return view('Permssions.add')
            ->with([
                'parent_links' => $parent_nav_links,
                'links' => $nav_links,
                'users' => $users
            ]);
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

        $user_id = "";
        $role_id = "";


        if($hidden_id != ''){
            $role = db::table('users')
                ->where('id', $hidden_id)
                ->get();

            foreach ($role as $role) {
                $role_id = $role->role_id;
            }



            if(empty($permissions)){

            }else {

                for ($j = 0; $j < count($permissions); $j++) {
                    db::table('user_permission')
                        ->updateOrInsert(
                            [
                                'user_id' => $hidden_id,
                                'role_id' => $role_id,
                                'link_id' => $permissions[$j]
                            ]
                        );
                }
            }

            for ($i = 0; $i < count($original_link); $i++) {
                db::table('user_permission')
                    ->where('user_id', $hidden_id)
                    ->where('role_id', $role_id)
                    ->where('link_id', $original_link[$i])
                    ->update([
                        'status' => $status[$i],
                    ]);
            }
        }else {

            for ($i = 0; $i < count($users); $i++) {

                $role = db::table('users')
                    ->where('id', $users[$i])
                    ->get();

                foreach ($role as $role) {
                    $user_id = $role->id;
                    $role_id = $role->role_id;
                }


                for ($j = 0; $j < count($permissions); $j++) {
                    db::table('user_permission')
                        ->insert([
                            'user_id' => $user_id,
                            'role_id' => $role_id,
                            'link_id' => $permissions[$j]
                        ]);
                }
            }
        }

        return response()->json(['status' => 'success' , 'message' => "User Permissions is successfully inserted"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user_permissions = db::table('user_permission')
            ->where('user_id', $id)
            ->get();

        $parent_nav_links = db::table('user_links_parent')->get();
        $nav_links = DB::table('user_links')->get();


        return view('Permssions.edit')
            ->with([
                'parent_links' => $parent_nav_links,
                'links' => $nav_links,
                'id' => $id,
                'user_permissions' => $user_permissions
            ]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function PermissionDatatables(){

        /*$data = db::table('users')
            ->select("*","users.id as userid",'user_permission.user_id as permissionId')
            ->leftJoin('user_permission', 'users.id', '=', 'user_permission.user_id')
            ->where('users.status', 1)
            ->where('users.role_id', '!=', 1);*/

        if(Auth::user() -> username = "admin"){
            $data = db::select('select * from users
                                    join user_permission
                                    on users.id = user_permission.user_id
                                    where users.status = 1
                                    GROUP BY users.id');
        }else{
        $data = db::select('select * from users
                                    join user_permission
                                    on users.id = user_permission.user_id
                                    where users.status = 1
                                    AND users.role_id != 1
                                    GROUP BY users.id');
        }

        $user_permission = db::table('user_links as a')
            ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
            ->where('b.user_id', auth::user()->id)
            ->where('b.status' , '=' , 'On')
            ->where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
            ->where('b.link_id' , '!=' , 0)
            ->get();


        if($user_permission -> contains('slug_name', 'Permissions.show')){
            return Datatables::collection($data)
                ->addColumn('action', function($row){
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" href='. route('Permissions.show', $row->id) .' "><span class="fa fa-edit">&nbsp;&nbsp;</span>Edit Permissions</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }else{
            return Datatables::collection($data)
                ->toJson();
        }
    }
}
