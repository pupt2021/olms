<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Svg\Tag\Rect;

class PenaltyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
                return view('Penalty.list')
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

        $borrowings = DB::table('borrowings')
            ->where('status', 1)
            ->get();

        $returned_date = "";

        foreach($borrowings as $data){
            $returned_date = $data -> date_returned;
            $diff =    strtotime(date("Y-m-d")) - strtotime($returned_date) ;

            $days = round($diff / 86400);

            if($days > 0){
                $rows = db::table('penalty')
                    ->where("users_id", $data->users_id)
                    ->where("borrowings_id", $data->id)
                    ->get();

                if(count($rows) > 0){
                      DB::table('penalty')
                      ->where("users_id", $data->users_id)
                      ->where("borrowings_id", $data->id)
                      ->update(['penalty_days' => $days]);
                }else{
                    db::table("penalty")
                        ->insert(
                            [
                                'users_id' => $data -> users_id,
                                'borrowings_id' => $data->id,
                                'penalty_days' => $days
                            ]
                        );
                }
            }
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

    public function Datatables(){

        $data = DB::table('penalty')
            ->select("*", "penalty.id as penalty_id")
            ->join('users', 'penalty.users_id', '=', 'users.id')
            ->where('penalty.status', 1);

        $user_permission = db::table('user_links as a')
            ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
            ->where('b.user_id', auth::user()->id)
            ->where('b.status' , '=' , 'On')
            ->where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
            ->where('b.link_id' , '!=' , 0)
            ->get();

        if($user_permission -> contains('slug_name', 'Penalty.PDF')) {
            return DataTables::query($data)
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a href='.route("PenaltyPDF", ['id' => $row->penalty_id]).' class="btn btn-info data-edit" id="data-edit" data-id=' . $row->id . ' ><span class="fa fa-file-download">&nbsp;&nbsp;</span>Print</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        else{
            return DataTables::query($data)
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a href='.route("PenaltyPDF", ['id' => $row->penalty_id]).' class="btn btn-info data-edit" id="data-edit" data-id=' . $row->id . ' ><span class="fa fa-file-download">&nbsp;&nbsp;</span>Print</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function PDF(Request $request){

        $penalty = db::table('penalty as a')
            ->join('user_details as b', 'a.users_id', '=', 'b.user_id')
            ->join('borrowings as c', 'a.borrowings_id', '=', 'c.id')
            ->join('materials as d', 'c.materials_id', '=' , 'd.materials_id')
            ->where('a.status', 1)
            ->where('a.id', $request->id)
            ->get();

        $penalty_settings = db::table('penalty_settings')
            ->get();

        foreach($penalty_settings as $penalty_setting_data){
            $penalty_fee = $penalty_setting_data->penalty_fee;
        }


        foreach($penalty as $data){
            $name = $data->lastname . ','. $data -> firstname ;
            $student_number = $data->stud_number;
            $fac_number = $data->faculty_code;
            $employee_number = $data->employee_number;
            $days = $data->penalty_days;
        }

        $amount_due = number_format($penalty_fee * $days, 2);

        $path = 'public/img/pup.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        view()->share(['penalty' => $penalty, 'logo' => $logo , 'name' => $name , 'student_number' => $student_number , 'faculty_number' => $fac_number , 'employee_number' => $employee_number,
            'amount_due' => $amount_due,'penalty_fee' => $penalty_fee
        ]);

        $pdf = PDF::loadView('Penalty.pdf', $penalty);

        ob_end_clean();

        // download PDF file with download method
        return $pdf->stream('Penalty.pdf',array('Attachment'=>0));
    }

    public function My_Penalty_View(){
        if(auth::check() == true){
            $user_permission = db::table('user_links as a')
                ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
                ->where('b.user_id', auth::user()->id)
                ->where('b.status' , '=' , 'On')
                ->Where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
                ->Where('link_id', '!=', 0)
                ->get();

            if($user_permission -> contains('slug_name', $this -> routeName)){
                return view('UserProfile.MyPenalty')
                    ->with('user_perm', $user_permission);
            }else{
                return redirect()->route('Dashboard');
            }
        }else{
            return redirect()->route('user_login_page');
        }
    }

    public function My_Penalty_Datatables(){
        $data = DB::table('penalty')
            ->select("*", "penalty.id as penalty_id")
            ->join('users', 'penalty.users_id', '=', 'users.id')
            ->join('borrowings', 'penalty.borrowings_id', '=', 'borrowings.id')
            ->join('materials', 'materials.materials_id', '=', 'borrowings.materials_id')
            ->where('penalty.status', 1)
            ->where('users.id', auth::user()->id);

        $user_permission = db::table('user_links as a')
            ->join('user_permission as b', 'a.id', '=' , 'b.link_id')
            ->where('b.user_id', auth::user()->id)
            ->where('b.status' , '=' , 'On')
            ->where('a.slug_name', 'LIKE' , '%'.$this->controller.'%')
            ->where('b.link_id' , '!=' , 0)
            ->get();

        return DataTables::query($data)
            ->addColumn('action', function ($row) {
                $btn = '<td></d></tr><div class="btn-group-vertical">
                            <a href='.route("PenaltyPDF", ['id' => $row->penalty_id]).' class="btn btn-info data-edit" id="data-edit" data-id=' . $row->id . ' ><span class="fa fa-file-download">&nbsp;&nbsp;</span>Print</a>
                        </div></td>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();

    }
}
