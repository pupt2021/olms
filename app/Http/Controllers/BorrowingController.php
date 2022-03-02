<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Borrowing;
use App\Models\MaterialCopy;
use App\Models\Penalty;

class BorrowingController extends Controller
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
        if(auth::check() == true){
            $user_permission = db::table('user_links as a')
                ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
                ->where('b.user_id', auth::user()->id)
                ->where('b.status' , '=' , 'On')
                ->Where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
                ->Where('link_id', '!=', 0)
                ->get();

            // $materials = db::table('materials_copies as a')
            //     ->select('a.*')
            //     ->where('a.status', 1)
            //     ->where('is_available', 1)
            //     ->get();
            $materials = db::table('materials_copies')
                        ->join('materials','materials.materials_id','=','materials_copies.materials_id')
                        ->where('materials.type', 2)
                        ->where('materials.status', 1)
                        ->where('materials_copies.is_available', 1)
                        ->get();

            $materials_copy = db::table('materials_copies')
                ->get();

            $borrower = db::table('users as a')
                ->join('user_details as b', 'a.id', '=', 'b.user_id')
                ->where('status', 1)
                ->where('role_id','!=', 1)
                ->get();

            if($user_permission -> contains('slug_name', $this -> routeName)){
                return view('Borrowing.list')
                    ->with('user_perm', $user_permission)
                    ->with('materials', $materials)
                    ->with('copies', $materials_copy)
                    ->with('borrower', $borrower);
            }else{
                return redirect()->route('Dashboard');
            }
        }else{
            return redirect()->route('user_login_page');
        }


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

        $penalty_settings = db::table('penalty_settings')
            ->get();

        foreach($penalty_settings as $penalty_settings){

        }

        $data_updated = [
            'material_copy_id' => $materials,
            'users_id' => $borrower,
            'type' => 2,
            'updated_at' => Carbon::now()
        ];

        if($id != ''){

            db::table('borrowings')
                ->where('id', $id)
                ->update($data_updated);

            db::table('materials_copies')
                ->where('borrows_id', $id)
                ->update([
                    'borrows_id' => NULL,
                    'is_available' => 1
                ]);
            

            return response()->json(['status' => 'success' , 'message' => "Borrowing Data is successfully updated"]);

        }else{

            $data_inserted = [
                'material_copy_id' => $materials,
                'users_id' => $borrower,
                'date_borrowed' => Carbon::now()->toDateString(),
                'date_returned' => Carbon::now()->addDay(3)->toDateString(),
                'type' => 2,
                'created_at' => Carbon::now()
            ];



            $borrowing_id = db::table('borrowings')
                ->insertGetId($data_inserted);

            // db::table('materials_copies')
            //     ->insert([
            //         'materials_id' => $materials,
            //         'borrows_id' => $borrowing_id
            //     ]);

            db::table('materials_copies')
                ->where('material_copy_id', $materials)
                ->update([
                    'borrows_id' => $borrowing_id,
                    'is_available' => 0
                ]);

            return response()->json(['status' => 'success' , 'message' => "Borrowing Data is successfully inserted"]);
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
        $data = db::table('borrowings')
            ->where('id', $id)
            ->get();

        return response()->json($data);
    }

    public function Datatables()
    {

        $data = DB::table('borrowings as a')
            ->select('a.id as id','c.accession_number as accession_number','d.title as title','a.date_borrowed as date_borrowed','a.date_returned as date_returned', DB::raw("CONCAT(b.lastname,',',b.firstname) as fullname"))
            ->join('user_details as b', 'a.users_id', '=' , 'b.user_id')
            // ->join('materials as c', 'a.materials_id', '=', 'c.materials_id')
            ->join('materials_copies as c', 'a.material_copy_id', '=', 'c.material_copy_id')
            ->join('materials as d', 'c.materials_id', '=', 'd.materials_id')
            ->where('a.type' , 2)
            ->where('a.status', 1);


        $user_permission = db::table('user_links as a')
            ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
            ->where('b.user_id', auth::user()->id)
            ->where('b.status' , '=' , 'On')
            ->where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
            ->where('b.link_id' , '!=' , 0)
            ->get();

        if($user_permission -> contains('slug_name', 'Borrowing.show') && $user_permission -> contains('slug_name', 'BorrowingDelete')) {
            return DataTables::query($data)
                ->filterColumn('fullname', function($query, $keyword) {
                    $sql = "CONCAT(b.lastname,',',b.firstname)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-horizontally">
                                <a type="button" title="EDIT" class="btn btn-info data-edit" id="data-edit" data-id=' . $row->id . ' ><span class="fa fa-edit"></span></a>
                                <a type="button" title="RETURN" class="btn btn-warning data-delete" id="data-delete" data-id=' . $row->id . ' ><span class="fa fa-backward">&nbsp;&nbsp;</span>RETURN</a>
                            </div></td>';
                    return $btn;
                })
                ->addColumn('formattedBorroweddates', function ($request) {
                    
                    return Carbon::create($request->date_borrowed)->format('F d, Y'); // human readable format
                  })
                ->addColumn('formattedReturneddates', function ($request) {
                    return Carbon::create($request->date_returned)->format('F d, Y'); // human readable format
                })
                ->rawColumns(['action'])
                ->toJson();
        }elseif($user_permission -> contains('slug_name', 'Borrowing.show')) {
            return DataTables::query($data)
                ->filterColumn('fullname', function($query, $keyword) {
                    $sql = "CONCAT(b.lastname,',',b.firstname)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id=' . $row->id . ' ><span class="fa fa-edit">&nbsp;&nbsp;</span>Edit</a>
                            </div></td>';
                    return $btn;
                })
                ->addColumn('formattedBorroweddates', function ($request) {
                    
                    return Carbon::create($request->date_borrowed)->format('F d, Y'); // human readable format
                  })
                ->addColumn('formattedReturneddates', function ($request) {
                    return Carbon::create($request->date_returned)->format('F d, Y'); // human readable format
                })
                ->rawColumns(['action'])
                ->toJson();
        }elseif($user_permission -> contains('slug_name', 'BorrowingDelete')) {
            return DataTables::query($data)
                ->filterColumn('fullname', function($query, $keyword) {
                    $sql = "CONCAT(b.lastname,',',b.firstname)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-warning data-delete" id="data-delete" data-id=' . $row->id . ' ><span class="fa fa-backward">&nbsp;&nbsp;</span>Return</a>
                            </div></td>';
                    return $btn;
                })
                ->addColumn('formattedBorroweddates', function ($request) {
                    
                    return Carbon::create($request->date_borrowed)->format('F d, Y'); // human readable format
                  })
                ->addColumn('formattedReturneddates', function ($request) {
                    return Carbon::create($request->date_returned)->format('F d, Y'); // human readable format
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        else{
            return DataTables::query($data)
                ->filterColumn('fullname', function($query, $keyword) {
                    $sql = "CONCAT(b.lastname,',',b.firstname)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->toJson();
        }
    }

    public function Deletion(Request $request)
    {
        // Get Borrowing Details
        $borrowing = Borrowing::with('penalty', 'materialCopy')
            ->where('id', $request->id)
            ->firstOrFail();

        try {
            // Update Material Copy as available
            MaterialCopy::where('material_copy_id', $borrowing->materialCopy->material_copy_id)
                ->update([
                    'is_available' => 1,
                    'borrows_id' => NULL,
                ]); 

            // If Borrowing has a Penalty, update the penalty then mark as Done and Deleted
            if ($borrowing->penalty !== NULL) 
            {
                $daysOverdue = $borrowing->days_overdue;
                Penalty::where("users_id", $borrowing->user->id)
                    ->where("borrowings_id", $borrowing->id)
                    ->update([
                        'penalty_days' => $daysOverdue,
                        'updated_at' => now(),
                        'status' => 0,
                        'deleted_at' => now(),
                    ]);
            }

            // Update Borrowing as Done and Deleted
            Borrowing::where('id', $borrowing->id)
                ->update([
                    'status' => 0,
                    'deleted_at' => now(),
                    'date_returned' => now(),
                ]);

            return response()->json([
                'status' => 'success',
                'title' => 'Returning Book',
                'message' => 'Succesfully Returned Book and Settled Penalty associated with it!',
            ]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => 'error',
                'title' => 'Returning Book',
                'message' => 'Error in Returning Book and Settling Penalty',
            ]);
        }
    }
}
