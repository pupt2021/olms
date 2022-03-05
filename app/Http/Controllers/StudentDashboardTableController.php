<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;


class StudentDashboardTableController extends Controller
{
    //

    public function borrow_history(){
        $data = DB::table('borrowings as a')
            ->select('a.id as id','c.accession_number as accession_number','a.date_borrowed as date_borrowed','a.date_returned as date_returned', DB::raw("CONCAT(b.lastname,',',b.firstname) as fullname"))
            ->join('user_details as b', 'a.users_id', '=' , 'b.user_id')
            // ->join('materials as c', 'a.materials_id', '=', 'c.materials_id')
            ->join('materials_copies as c', 'a.material_copy_id', '=', 'c.material_copy_id')
            ->join('materials as d', 'c.materials_id', '=', 'd.materials_id')
            ->where('a.users_id', Auth::user()->id)
            ->where('a.status', 1)
            ->orderBy('a.id', 'desc');

        return DataTables::query($data)
        ->addIndexColumn()
        ->filterColumn('fullname', function($query, $keyword) {
            $sql = "CONCAT(b.lastname,',',b.firstname)  like ?";
            $query->whereRaw($sql, ["%{$keyword}%"]);
        })
        ->addColumn('formattedBorroweddates', function ($request) {
                    
            return Carbon::create($request->date_borrowed)->format('F d, Y'); // human readable format
          })
        ->addColumn('formattedReturneddates', function ($request) {
            return Carbon::create($request->date_returned)->format('F d, Y'); // human readable format
        })
        ->toJson();
    }

    public function list_of_issued_books(){
        $data = DB::table('borrowings as a')
        ->select('a.id as id','c.accession_number as accession_number','a.date_borrowed as date_borrowed','a.date_returned as date_returned', DB::raw("CONCAT(b.lastname,',',b.firstname) as fullname"))
        ->join('user_details as b', 'a.users_id', '=' , 'b.user_id')
        // ->join('materials as c', 'a.materials_id', '=', 'c.materials_id')
        ->join('materials_copies as c', 'a.material_copy_id', '=', 'c.material_copy_id')
        ->join('materials as d', 'c.materials_id', '=', 'd.materials_id')
        ->where('a.type' , 1)
        ->where('a.users_id', auth::user()->id)
        ->where('a.status', 1)
        ->orderBy('a.id', 'DESC');

        return DataTables::query($data)
                ->addIndexColumn()
                ->filterColumn('fullname', function($query, $keyword) {
                    $sql = "CONCAT(b.lastname,',',b.firstname)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->addColumn('action', function ($row) {
                    $btn = '<td></d></tr><div class="btn-group-vertical">
                                <a type="button" class="btn btn-warning extension" id="extension" data-id=' . $row->id . ' ><span class="">&nbsp;&nbsp;</span>Request Extension</a>
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

    public function list_of_extension(){

        $data = DB::table('borrowings as a')
        ->select('a.id as id','c.accession_number as accession_number','a.date_borrowed as date_borrowed','a.date_returned as date_returned', DB::raw("CONCAT(b.lastname,',',b.firstname) as fullname"),
             DB::raw('(CASE WHEN e.status = 0 THEN "PENDING" WHEN e.status = 1 THEN "Approved" WHEN e.status = 2 THEN "Denied" END) AS extension_status'))
        ->join('user_details as b', 'a.users_id', '=' , 'b.user_id')
        // ->join('materials as c', 'a.materials_id', '=', 'c.materials_id')
        ->join('materials_copies as c', 'a.material_copy_id', '=', 'c.material_copy_id')
        ->join('materials as d', 'c.materials_id', '=', 'd.materials_id')
        ->join('book_extension as e', 'a.id', '=' , 'e.borrowings_id')
        ->where('a.type' , 1)
        ->where('a.users_id', auth::user()->id)
        ->where('a.status', 1)
        ->orderBy('e.id', "DESC");

        return DataTables::query($data)
        ->addIndexColumn()
        ->filterColumn('fullname', function($query, $keyword) {
            $sql = "CONCAT(b.lastname,',',b.firstname)  like ?";
            $query->whereRaw($sql, ["%{$keyword}%"]);
        })
        ->addColumn('formattedBorroweddates', function ($request) {
                    
            return Carbon::create($request->date_borrowed)->format('F d, Y'); // human readable format
          })
        ->addColumn('formattedReturneddates', function ($request) {
            return Carbon::create($request->date_returned)->format('F d, Y'); // human readable format
        })
        ->toJson();
    }
}
