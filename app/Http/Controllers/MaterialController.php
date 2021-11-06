<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

class MaterialController extends Controller
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
        list($this->controller, $action) = explode('Controller@', $controllerAction);

        $this->routeName = Route::currentRouteName();

    }

    public function index()
    {
        //
        if (auth::check() == true) {
            $user_permission = db::table('user_links as a')
                ->join('user_permission as b', 'a.id', '=', 'b.link_id')
                ->where('b.user_id', auth::user()->id)
                ->where('b.status', '=', 'On')
                ->Where('a.slug_name', 'LIKE', '%' . $this->controller . '%')
                ->Where('link_id', '!=', 0)
                ->get();


            $material_category = db::table('materials_category')->where('status', 1)->get();
            $material_subject = db::table('materials_subject')->where('status', 1)->get();

            if ($user_permission->contains('slug_name', $this->routeName)) {
                return view('Materials.list')
                    ->with('user_perm', $user_permission)
                    ->with('category', $material_category)
                    ->with('subject', $material_subject);
            } else {
                return redirect()->route('Dashboard');
            }
        } else {
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        extract($request->all());

        $data_updated = [
            'isbn' => $isbn,
            'title' => $title,
            'callno' => $callno,
            'author' => $author,
            'publisher' => $publisher,
            'edition' => $edition,
            'date_received' => $daterec,
            'copyright' => $copyright,
            'copies' => $copies,
            'type' => $type,
            'update_at' => Carbon::now()
        ];

        if ($id != '') {

            db::table('materials')
                ->where('materials_id', $id)
                ->update($data_updated);

            return response()->json(['status' => 'success', 'message' => "Materials Category Data is successfully updated"]);

        } else {

            $material_category = db::table('materials_category')
                ->where('id', $structure)
                ->get();

            foreach ($material_category as $category) {
                $category_name = $category->cat_structure;
            }

            $materials = db::table('materials')
                ->get()
                ->count();

            $category_name = $category_name . '-' . ($materials + 1);

            $data_inserted = [
                'category_id' => $structure,
                'accnum' => $category_name,
                'isbn' => $isbn,
                'title' => $title,
                'callno' => $callno,
                'author' => $author,
                'publisher' => $publisher,
                'edition' => $edition,
                'copies' => $copies,
                'date_received' => $daterec,
                'copyright' => $copyright,
                'type' => $type,
                'created_at' => Carbon::now()
            ];

            $id = db::table('materials')
                ->insertGetId($data_inserted);

            for ($i = 0; $i < count($subject); $i++) {
                db::table('materials_subject_link')
                    ->insert([
                        'mat_id' => $id,
                        'sub_id' => $subject[$i]
                    ]);
            }

            return response()->json(['status' => 'success', 'message' => "Materials Category Data is successfully inserted"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = db::table('materials')
            ->where('materials_id', $id)
            ->get();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function MaterialsDatatables()
    {

        $data = DB::table('materials')
            ->select('*', DB::raw('(CASE WHEN type = 1 THEN "Borrowing" WHEN type = 2 THEN "Room Use" END) AS material_type'))
            ->where('status', 1);

        $materials_copies = db::table('materials_copies')
            ->get();

        $data2 = DB::table('materials_subject_link as a')
            ->join('materials as b', 'a.mat_id', '=', 'b.materials_id')
            ->join('materials_subject as c', 'a.sub_id', '=', 'c.id');


        $user_permission = db::table('user_links as a')
            ->join('user_permission as b', 'a.id', '=', 'b.link_id')
            ->where('b.user_id', auth::user()->id)
            ->where('b.status', '=', 'On')
            ->where('a.slug_name', 'LIKE', '%' . $this->controller . '%')
            ->where('b.link_id', '!=', 0)
            ->get();

        if ($user_permission->contains('slug_name', 'Material.show') && $user_permission->contains('slug_name', 'MaterialsDelete')) {
            return DataTables::query($data)
                ->addColumn('action', function ($row) {
                    $btn = '<td></tr><div class="btn-group-horizontally">
                                <a type="button" title="HISTORY" href="Material/History/' . base64_encode($row->materials_id) . '" class="btn btn-info" style="background-color: green"><span class="fa fa-history"></span></a>
                                <a type="button" title="EDIT" class="btn btn-info data-edit" id="data-edit" data-id=' . $row->materials_id . ' ><span class="fa fa-edit"></span></a>
                                <a type="button" title="DELETE" class="btn btn-warning data-delete" id="data-delete" data-id=' . $row->materials_id . ' ><span class="fa fa-trash"></span></a>
                            </div></td>';
                    return $btn;
                })
                ->addColumn('copies', function ($row) use ($materials_copies) {
                    $copies = $row->copies;
                    foreach ($materials_copies as $qty) {
                        if ($row->materials_id == $qty->materials_id) {
                            if ($qty->status == 1) {
                                $copies = $row->copies - $qty->quantity;
                            }
                        }
                    }
                    return $copies;
                })
                ->rawColumns(['action', 'copies'])
                ->toJson();
        } elseif ($user_permission->contains('slug_name', 'Material.show')) {
            return DataTables::query($data)
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-horizontally">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id=' . $row->materials_id . ' ><span class="fa fa-edit">&nbsp;&nbsp;</span>Edit</a>
                            </div></td>';
                    return $btn;
                })
                ->addColumn('copies', function ($row) use ($materials_copies) {
                    $copies = $row->copies;
                    foreach ($materials_copies as $qty) {
                        if ($row->materials_id == $qty->materials_id) {
                            if ($qty->status == 1) {
                                $copies = $row->copies - $qty->quantity;
                            }
                        }
                    }
                    return $copies;
                })
                ->rawColumns(['action', 'copies'])
                ->toJson();
        } elseif ($user_permission->contains('slug_name', 'MaterialsDelete')) {
            return DataTables::query($data)
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-horizontally">
                                <a type="button" class="btn btn-warning data-delete" id="data-delete" data-id=' . $row->materials_id . ' ><span class="fa fa-trash">&nbsp;&nbsp;</span>Delete</a>
                            </div></td>';
                    return $btn;
                })
                ->addColumn('copies', function ($row) use ($materials_copies) {
                    $copies = $row->copies;
                    foreach ($materials_copies as $qty) {
                        if ($row->materials_id == $qty->materials_id) {
                            if ($qty->status == 1) {
                                $copies = $row->copies - $qty->quantity;
                            }
                        }
                    }
                    return $copies;
                })
                ->rawColumns(['action', 'copies'])
                ->toJson();
        } else {
            return DataTables::query($data)
                ->addColumn('action', function ($row) {
                    $btn = '';
                    return $btn;
                })
                ->addColumn('copies', function ($row) use ($materials_copies) {
                    $copies = $row->copies;
                    foreach ($materials_copies as $qty) {
                        if ($row->materials_id == $qty->materials_id) {
                            if ($qty->status == 1) {
                                $copies = $row->copies - $qty->quantity;
                            }
                        }
                    }
                    return $copies;
                })
                ->rawColumns(['action', 'copies'])
                ->toJson();
        }
    }

    public function MaterialsDelete(Request $request)
    {
        DB::table('materials')
            ->where('materials_id', $request->id)
            ->update([
                'status' => 0,
                'deleted_at' => Carbon::now()
            ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function materials_history($id)
    {
        if (auth::check() == true) {
            return view('Materials.history')
                ->with('id', $id);
        } else {
            return redirect()->route('user_login_page');
        }
    }

    public function Materials_History_Datatables($id){
        $data = DB::table('materials')
            ->select('materials.*', 'user_details.*', db::raw("CONCAT(lastname,',',firstname) as fullname"), DB::raw('(CASE WHEN materials.type = 1 THEN "Borrowing" WHEN materials.type = 2 THEN "Room Use" END) AS material_type'))
            ->join('borrowings', 'materials.materials_id', '=', 'borrowings.materials_id')
            ->join('user_details', 'borrowings.users_id', '=', 'user_details.user_id')
            ->where('borrowings.materials_id', base64_decode($id));

        return DataTables::query($data)
            ->addColumn('user_no', function ($row) {
                if($row->stud_number != ""){
                    $user_no = $row->stud_number;
                }
                if( $row->faculty_code != "") {
                    $user_no = $row->faculty_code;
                }
                if( $row->employee_number != "") {
                    $user_no = $row->employee_number;
                }
                return $user_no;
            })
            ->rawColumns(['user_no'])
            ->toJson();
    }
}
