<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GenderController extends Controller
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
            $user_permission = db::table('user_links as a')
                ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
                ->where('b.user_id', auth::user()->id)
                ->where('b.status' , '=' , 'On')
                ->Where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
                ->Where('link_id', '!=', 0)
                ->get();


            if($user_permission -> contains('slug_name', $this -> routeName)){
                return view('Gender.listgender')
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
        $validator = Validator::make($request->all(), [
            'gender_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator);
        }else{

            db::table('gender')->insert([
                'gender_name' => $request->gender_name
            ]);

            return response()->json([
               'status' => "success"
            ]);
        }


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

    public function GenderDatatables(){
        $data = db::table('gender')->where('status', 1);

        $user_permission = db::table('user_links as a')
            ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
            ->where('b.user_id', auth::user()->id)
            ->where('b.status' , '=' , 'On')
            ->where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
            ->where('b.link_id' , '!=' , 0)
            ->get();

        if($user_permission -> contains('slug_name', 'Gender.show') && $user_permission -> contains('slug_name', 'GenderDelete')){
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
        }elseif($user_permission -> contains('slug_name', 'Gender.show')){
            return DataTables::query($data)
                ->addColumn('action', function($row){
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id='.  $row->id .' ><span class="fa fa-edit">&nbsp;&nbsp;</span>Edit</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }elseif( $user_permission -> contains('slug_name', 'GenderDelete')){
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

    public function GenderUpdate(Request $request){

        $new_name = $request->gender_name ;

        db::table('gender')
            ->where('id', $request->id)
            ->update([
                'gender_name' => $new_name
            ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function GenderDelete(Request $request){
        db::table('gender')
            ->where('id', $request->id)
            ->update([
                'status' => 0
            ]);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
