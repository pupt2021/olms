<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ReserveController extends Controller
{
    //
    public function main(){
        return view('UserProfile.reserve_book');
    }
    public function Add(Request $request){
        extract($request->all());
        $id = Auth::user()->id;
        db::table('book_reservation')
            ->insert([
                'users_id' => $id,
                'materials_id' => $materials_id,
            ]);
        return response()->json(['status' => 'success']);
    }
    public function Datatables(){
        $data = \Illuminate\Support\Facades\DB::table('book_reservation as a')
            ->select('a.id','b.*',  DB::raw('(CASE WHEN a.status = 0 THEN "PENDING" WHEN a.status = 1 THEN "Accepted" WHEN a.status = 2 THEN "Denied" END) AS reservation_status'))
            ->join('materials as b', 'a.materials_id', '=', 'b.materials_id')
            ->where('a.status', 0)
            ->orderBy('a.id', 'DESC');

        return DataTables::query($data)
            ->toJson();
    }
    public function BooksDatatables(){
        $data = \Illuminate\Support\Facades\DB::table('materials as a')
            ->select('*' , 'a.materials_id as mat_id',  DB::raw('(CASE WHEN type = 1 THEN "ISSUING" WHEN type = 2 THEN "BORROWING" END) AS type'))
            ->rightJoin('book_reservation as b', 'a.materials_id', '!=' , 'b.materials_id')
            ->where('is_available', 0)
            ->where('a.status', 1);


        return DataTables::query($data)
            ->addColumn('action', function($row){
                $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id='.  $row->materials_id .' ><span class="fa fa-check">&nbsp;&nbsp;</span>Reserve</a>
                            </div></td>';
                return $btn;
            })
            ->toJson();
    }
}
