<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\Facades\DataTables;


class DashboardTableController extends Controller
{
    //
    public function time_record(){

        $date = carbon::today()->toDateString();
        $start = Carbon::createFromFormat('Y-m-d H i s', $date . '00 00 00')->toDateTimeString();
        $end = Carbon::createFromFormat('Y-m-d H i s', $date . '23 59 59')->toDateTimeString();

        $dtr = db::table('timein as a')
            ->select('role_name',db::raw("CONCAT(lastname,',',firstname) as fullname"), db::raw("DATE_FORMAT(timein, '%M %d,%Y %h:%i %p') as timein"), db::raw("DATE_FORMAT(timeout, '%M %d,%Y %h:%i %p') as timeout"), 'a.id as time_id','c.image_url as image_url')
            ->join('users as b', 'a.users_id', '=', 'b.id')
            ->join('user_details as c', 'a.users_id', '=' , 'c.user_id')
            ->join('user_role as d', 'b.role_id', '=', 'd.role_id')
            ->whereBetween('timein', [$start , $end])
            ->orderBy('time_id', 'desc');

        return Datatables::query($dtr)
            ->addColumn('action', function ($row) {
                if(is_null($row->timeout)){
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                            <a type="button" title="TIMEOUT" class="btn btn-warning timeout" id="timeout" data-id=' . $row->time_id . ' ><span class="">&nbsp;&nbsp;</span><i class="fas fa-user-times"></i></a>
                        </div></td>';

                }else{
                    $btn = '';
                }
                return $btn;
            })
            ->addColumn('images', function ($row) {
                if(is_null($row->image_url)){
                    $url= asset('img/upload_picture.png');
                    $images = '<img src="'.$url.'" border="0" style="border-radius: 50%;height:70px;width:70px" class="img-rounded" align="center" />';
                }else{
                    $url= asset('images/'.$row->image_url);
                    $images = '<img src="'.$url.'" border="0" style="border-radius: 50%;height:70px;width:70px" class="img-rounded" align="center" />';
                }
                return $images;
            })
            ->rawColumns(['action', 'images'])
            ->toJson();
    }

    public function list_of_extension(){

        $data = DB::table('borrowings as a')
            ->select('a.id as id','c.accession_number as accession_number','a.date_borrowed as date_borrowed','a.date_returned as date_returned', DB::raw("CONCAT(b.lastname,',',b.firstname) as fullname"),
                DB::raw('(CASE WHEN d.status = 0 THEN "PENDING" WHEN d.status = 1 THEN "Approved" WHEN d.status = 2 THEN "Denied" END) AS extension_status'), 'd.id as extension_id','d.users_id as user_id','d.borrowings_id as borrowing_id')
            ->join('user_details as b', 'a.users_id', '=' , 'b.user_id')
            ->join('materials_copies as c', 'a.material_copy_id', '=', 'c.material_copy_id')
            ->join('book_extension as d', 'a.id', '=' , 'd.borrowings_id')
            ->where('a.type', 1)
            ->where('d.status', '=', 0)
            ->where('a.status', 1);
            

        return DataTables::query($data)
                ->filterColumn('fullname', function($query, $keyword) {
                    $sql = "CONCAT(b.lastname,',',b.firstname)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-warning extension" id="extension" data-id=' . $row->extension_id . ' ><span class="">&nbsp;&nbsp;</span>Manage Extension</a>
                            </div></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
    }

    public function list_of_issued(){

        $data = DB::table('borrowings as a')
            ->select('a.id as id','d.title','c.accession_number as accession_number','a.date_borrowed as date_borrowed','a.date_returned as date_returned', DB::raw("CONCAT(b.lastname,',',b.firstname) as fullname"),
            \Illuminate\Support\Facades\DB::raw('(CASE WHEN d.type = 1 THEN "BORROWING" WHEN d.type = 2 THEN "ROOM USE" END) AS material_type'))
            ->join('user_details as b', 'a.users_id', '=' , 'b.user_id')
            ->join('materials_copies as c', 'a.material_copy_id', '=', 'c.material_copy_id')
            ->join('materials as d', 'c.materials_id', '=', 'd.materials_id')
            ->where('a.status', 1);
           
        return DataTables::query($data)
            ->filterColumn('fullname', function($query, $keyword) {
                $sql = "CONCAT(b.lastname,',',b.firstname)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->toJson();
    }
}
