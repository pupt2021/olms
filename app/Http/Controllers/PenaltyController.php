<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Svg\Tag\Rect;

use App\Models\Borrowing;
use App\Models\Penalty;
use App\Models\User;
use App\Models\MaterialCopy;

class PenaltyController extends Controller
{
    public function __construct(array $attributes = array())
    {
        /* if controller is not compatible with slug name */
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($this -> controller, $action) = explode('Controller@', $controllerAction);

        $this -> routeName = Route::currentRouteName();
    }

    /**
     * Function that serves as the Index Page of an Admin
     * @return View
     */ 
    public function index()
    {
        // If User is not logged in, redirect to login page
        if (! auth::check())
            return redirect()->route('user_login_page');
        // If user doesnt have the permissions, redirect to dashboard
        $user_permission = $this->getUserPermissions();
        if(! $user_permission -> contains('slug_name', $this->routeName))
            return redirect()->route('Dashboard');

        $borrowings = Borrowing::with('user')
            ->where('status', 1)
            ->get();

        return view('Penalty.list')
            ->with('user_perm', $user_permission);
    }

    /**
     * Function that auto-creates/auto-updates Penalty entries when opening Index Page
     */
    public function create()
    {
        $borrowings = Borrowing::with('user')
            ->where('status', 1)
            ->get();

        foreach ($borrowings as $borrowing)
        {
            $daysOverdue = $borrowing->days_overdue;
            
            // If user and borrowing ID exists in the Penalty Table, update penalty_days...
            if (Penalty::where("users_id", $borrowing->user->id)
                ->where("borrowings_id", $borrowing->id)
                ->exists()) 
            {
                $penaltyEntry = Penalty::where("users_id", $borrowing->user->id)
                    ->where("borrowings_id", $borrowing->id);

                // If days overdue is negative, then the borrowing is extended and the penalty entry should be removed
                if ($daysOverdue <= 0) 
                    $penaltyEntry->delete();

                // If days overdue is over 0, then update the penalty entry
                else 
                    $penaltyEntry->update([
                        'penalty_days' => $daysOverdue,
                        'updated_at' => now(),
                    ]);
            }

            // If user and borrowing ID does not exists in the Penalty table AND days overdue is over 0, create a new Penalty entry...
            else
            {
                if ($daysOverdue > 0) 
                {
                    Penalty::create([
                        'users_id' => $borrowing->user->id,
                        'borrowings_id' => $borrowing->id,
                        'penalty_days' => $daysOverdue,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                
            }
        }
    }

    /**
     * Function that supplies data to Penalty Datatables in Index Page
     * @return JSON Response
     */ 
    public function Datatables()
    {
        $penalties = Penalty::with('borrowing.user.userDetails', 'borrowing.materialCopy.material')
            ->where('penalty.status', 1);

        $user_permission = $this->getUserPermissions();
        
        return DataTables::eloquent($penalties)
            ->addIndexColumn()
            ->addColumn('action', function (Penalty $penalty) use($user_permission) {
                if($user_permission -> contains('slug_name', 'Penalty.PDF')) 
                {
                    $btn = '
                        <td>
                            
                            <div class="btn-group-vertical">
                                <a href='.route("PenaltyPDF", ['id' => $penalty->id]).' class="btn btn-info data-edit mb-1" id="data-edit" data-id=' . $penalty->id . ' >
                                    <span class="fa fa-file-download">&nbsp;&nbsp;</span>Print
                                </a>

                                <button type="button" class="btn btn-warning settlePenaltyAndReturnBookButton" data-id=' . $penalty->id . '>
                                    <span class="fas fa-fast-backward">&nbsp;&nbsp;</span>Settle and Return Book   
                                </button>
                            </div>
                        </td>';
                }
                else
                {
                    $btn = '
                        <td>
                            <p>No Action Allowed</p>
                        </td>';
                }
                
                return $btn;
            })
            ->addColumn('student', function (Penalty $penalty){
                return $penalty->borrowing->user->userDetails->full_name_with_student_number;
            })
            ->addColumn('book', function (Penalty $penalty){
                $row = $penalty->borrowing->materialCopy->material->title . 
                    '<br>' . 
                    $penalty->borrowing->materialCopy->material->isbn . 
                    '<br>' . 
                     $penalty->borrowing->materialCopy->accession_number;
                return $row;
            })
            ->rawColumns(['action', 'book'])
            ->toJson();
        
    }

    /**
     * Function to Settle Penalty and Return Book
     * @param Integer $penaltyID
     * @return JSON Response
     */ 
    public function SettlePenaltyAndReturnBook($penaltyID)
    {
        // Get Penalty Details
        $penalty = Penalty::with('borrowing.materialCopy')
            ->where('id', $penaltyID)
            ->first();

        try {
            // Update Material Copy as available
            MaterialCopy::where('material_copy_id', $penalty->borrowing->materialCopy->material_copy_id)
                ->update([
                    'is_available' => 1,
                    'borrows_id' => NULL,
                ]); 

            // Update Borrowing as Done and Deleted
            Borrowing::where('id', $penalty->borrowing->id)
                ->update([
                    'status' => 0,
                    'deleted_at' => now(),
                    'date_returned' => now(),
                ]);

            // Update Penalty as Done and Deleted
            Penalty::where('id', $penalty->id)
                ->update([
                    'status' => 0,
                    'deleted_at' => now(),
                ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Succesfully Settled Penalty and Returned Book!',
            ]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error in Settling Penalty and Returning Book!',
            ]);
        }
        
    }

    /**
     * Function that returns a PDF Stream View of a Penalty
     * @param Request $request
     * @return View
     */ 
    public function PDF(Request $request)
    {
        $penalty = Penalty::with('borrowing.user.userDetails', 'borrowing.materialCopy.material')
            ->where('id', $request->id)
            ->first();

        $penalty_settings = db::table('penalty_settings')
            ->first();

        $name = $penalty->borrowing->user->userDetails->full_name;
        $student_number = $penalty->borrowing->user->userDetails->stud_number;
        $fac_number = $penalty->borrowing->user->userDetails->faculty_code;
        $employee_number = $penalty->borrowing->user->userDetails->employee_number;
        $days = $penalty->penalty_days;
        $amount_due = number_format($penalty_settings->penalty_fee * $days, 2);

        $path = public_path('img/pup.jpg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        view()->share([
            'penalty' => $penalty, 
            'logo' => $logo , 
            'name' => $name , 
            'student_number' => $student_number , 
            'faculty_number' => $fac_number , 
            'employee_number' => $employee_number,
            'amount_due' => $amount_due,
            'penalty_fee' => number_format($penalty_settings->penalty_fee, 2),
        ]);

        $pdf = PDF::loadView('Penalty.pdf', $penalty);

        ob_end_clean();

        // download PDF file with download method
        return $pdf->stream('Penalty.pdf',array('Attachment'=>0));
    }

    /**
     * Function that returns a PDF Stream View of All Penalties of a User
     * @return View
     */ 
    public function PDF_PrintAllPenalty()
    {
        $userID = auth::user()->id;

        $penalties = Penalty::whereHas('borrowing.user', function (Builder $query) use ($userID){
                $query->where('id', $userID);
            })
            ->with(['borrowing.materialCopy.material'])
            ->where('status', 1)
            ->get();

        // If there is no User Penalties
        if ($penalties->count() <= 0) 
            return redirect()->route('Penalty.My_Penalty');

        // Get User Details
        $user = User::with('userDetails')->where('id', $userID)->first();
        $name = $user->userDetails->full_name;
        $student_number = $user->userDetails->stud_number;
        $fac_number = $user->userDetails->faculty_code;
        $employee_number = $user->userDetails->employee_number;

        // Get Penalty Settings
        $penalty_settings = db::table('penalty_settings')
            ->first();

        // Compute for Total Amount Due
        $total_amount_due = 0;
        foreach ($penalties as $penalty)
        {
            $days = $penalty->penalty_days;
            $total_amount_due += $penalty_settings->penalty_fee * $days;
        }
        $total_amount_due = number_format($total_amount_due, 2);

        // Get PUP Logo
        $path = public_path('img/pup.jpg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        view()->share([
            'penalties' => $penalties, 
            'logo' => $logo , 
            'name' => $name , 
            'student_number' => $student_number , 
            'faculty_number' => $fac_number , 
            'employee_number' => $employee_number,
            'total_amount_due' => $total_amount_due,
            'penalty_fee' => number_format($penalty_settings->penalty_fee, 2),
        ]);

        $pdf = PDF::loadView('Penalty.allPenaltyPDF', $penalty);

        ob_end_clean();

        // download PDF file with download method
        return $pdf->stream('Penalty.allPenaltyPDF',array('Attachment'=>0));
    }

    /**
     * Function that serves as the Index Page of a Normal User
     * @return View
     */ 
    public function My_Penalty_View()
    {
        // If User is not logged in, redirect to login page
        if (! auth::check())
            return redirect()->route('user_login_page');
        // If user doesnt have the permissions, redirect to dashboard
        $user_permission = $this->getUserPermissions();
        if(! $user_permission -> contains('slug_name', $this->routeName))
            return redirect()->route('Dashboard');

        $userID = auth::user()->id;
        $penaltyCount = Penalty::whereHas('borrowing.user', function (Builder $query) use ($userID){
                $query->where('id', $userID);
            })
            ->where('status', 1)
            ->count();

        return view('UserProfile.MyPenalty', compact('penaltyCount'))
                    ->with('user_perm', $user_permission);
    }

    /**
     * Function that supplies data to Penalty Datatables in Index Page of Normal User
     * @return JSON Response
     */ 
    public function My_Penalty_Datatables()
    {
        $userID = auth::user()->id;

        $penalties = Penalty::whereHas('borrowing.user', function (Builder $query) use ($userID){
                $query->where('id', $userID);
            })
            ->with(['borrowing.user.userDetails', 'borrowing.materialCopy.material'])
            ->where('penalty.status', 1);
        
        $user_permission = $this->getUserPermissions();

        return DataTables::eloquent($penalties)
            ->addIndexColumn()
            ->addColumn('action', function (Penalty $penalty) {
                $btn = '<td>
                            <div class="btn-group-vertical">
                                <a href='.route("PenaltyPDF", ['id' => $penalty->id]).' class="btn btn-info data-edit" id="data-edit" data-id=' . $penalty->id . ' >
                                    <span class="fa fa-file-download">&nbsp;&nbsp;</span>Print
                                </a>
                            </div>
                        </td>';
                return $btn;
            })
            ->addColumn('book', function (Penalty $penalty){
                $row = $penalty->borrowing->materialCopy->material->title . 
                    '<br>' . 
                    $penalty->borrowing->materialCopy->material->isbn . 
                    '<br>' . 
                     $penalty->borrowing->materialCopy->accession_number;
                return $row;
            })
            ->addColumn('due_date', function (Penalty $penalty){
                return $penalty->borrowing->formatted_date_returned;
            })
            ->rawColumns(['action', 'book'])
            ->toJson();
    }

    /**
     * Function that returns the permissions of a User
     * @return Collection
     */ 
    private function getUserPermissions()
    {
        $user_permission = db::table('user_links 
            as a')
            ->join('user_permission as b', 'a.id', '=', 'b.link_id')
            ->where('b.user_id', auth::user()->id)
            ->where('b.status', '=', 'On')
            ->Where('a.slug_name', 'LIKE', '%' . $this->controller . '%')
            ->Where('link_id', '!=', 0)
            ->get();
        return $user_permission;
    }
}
