<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Borrowing;
use App\Models\Material;
use App\Models\User;

class ArchivesController extends Controller
{
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

    /**
     * Function to Show the Index Page of Material Archive
     * Route: GET
     * @return View
     */ 
    public function materials_list()
    {
        // If User is not logged in, redirect to login page
        if (! auth::check())
            return redirect()->route('user_login_page');
        // If user doesnt have the permissions, redirect to dashboard
        $user_permission = $this->getUserPermissions();
        if(! $user_permission -> contains('slug_name', $this->routeName))
            return redirect()->route('Dashboard');

        return view('Archives.materials');
    }

    /**
     * Function to supply data on Material Archive Datatable
     * Route: POST
     * @param Request $request
     * @return JSON Response
     */
    public function materials_list_datatables(Request $request)
    {
        // Block requests other than POST
        if (! $request->isMethod('post')) 
            abort(404);

        $materials = Material::withCount('materialCopies')
            ->with('subjects')
            ->where('status', 0)
            ->withTrashed();

        return DataTables::eloquent($materials)
            ->addIndexColumn()
            ->addColumn('action', function (Material $material) {
                $btn = '<td></d></tr><div class="btn-group-vertical">
                            <a type="button" class="btn btn-info data-edit" id="data-edit" data-id=' . $material->materials_id . ' data-type="materials" ><span class="fa fa-backward">&nbsp;&nbsp;</span>Restore</a>
                        </div></td>';
                return $btn;
            })
            ->addColumn('type', function (Material $material){
                if ($material->type === 1)
                    return 'Borrowing';
                elseif ($material->type === 2)
                    return 'Room Use';
            })
            ->addColumn('copies', function (Material $material){
                return $material->material_copies_count;
            })
            // Title Column with Subjects
            ->addColumn('title_with_subjects', function (Material $material){
                
                $tableData = $material->title . '<br>';
                foreach ($material->subjects as $subject) 
                {
                    $tableData .= '<span class="badge border border-dark" style="background-color:' . $subject->background_color . '; color:' . $subject->text_color . ';">' . $subject->subject_name .'</span> ';
                }
                return $tableData;
            })
            ->rawColumns(['action', 'title_with_subjects'])
            ->toJson();
    }

    /**
     * Function to Show the Index Page of User Archive
     * Route: GET
     * @return View
     */ 
    public function users_list()
    {
        // If User is not logged in, redirect to login page
        if (! auth::check())
            return redirect()->route('user_login_page');
        // If user doesnt have the permissions, redirect to dashboard
        $user_permission = $this->getUserPermissions();
        if(! $user_permission -> contains('slug_name', $this->routeName))
            return redirect()->route('Dashboard');

        return view('Archives.users');
    }

    /**
     * Function to supply data on User Archive Datatable
     * Route: POST
     * @param Request $request
     * @return JSON Response
     */
    public function users_list_datatables(Request $request)
    {
        // Block requests other than POST
        if (! $request->isMethod('post')) 
            abort(404);

        $users = User::with('userDetails')
            ->where('users.status', 0)
            ->where('users.role_id', '!=', 1)
            ->withTrashed();

        return DataTables::eloquent($users)
            ->addIndexColumn()
            ->addColumn('action', function (User $user) {
                $btn = '<td>
                            <div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id=' . $user->id . '  data-type="users" >
                                    <span class="fa fa-backward">&nbsp;&nbsp;</span>Restore
                                </a>
                            </div>
                        </td>';
                return $btn;
            })
            ->addColumn('formatted_fullname_with_student_number', function(User $user){
                return $user->userDetails->full_name_with_student_number;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Function to Show the Index Page of Borrowing Archive
     * Route: GET
     * @return View
     */ 
    public function borrowing_list()
    {
        // If User is not logged in, redirect to login page
        if (! auth::check())
            return redirect()->route('user_login_page');
        // If user doesnt have the permissions, redirect to dashboard
        $user_permission = $this->getUserPermissions();
        if(! $user_permission -> contains('slug_name', $this->routeName))
            return redirect()->route('Dashboard');

        return view('Archives.borrowings');
    }

    /**
     * Function to supply data on User Archive Datatable
     * Route: POST
     * @param Request $request
     * @return JSON Response
     */
    public function borrowing_list_datatables(Request $request)
    {
        $borrowings = Borrowing::with('user.userDetails', 'materialCopy.material.subjects')
            ->where('borrowings.status', 0)
            ->where('borrowings.type', 2)
            ->withTrashed(); 

        return DataTables::eloquent($borrowings)
            ->addIndexColumn()
            ->addColumn('formatted_fullname_with_student_number', function (Borrowing $borrowing){
                return $borrowing->user->userDetails->full_name_with_student_number;
            })
            // Material Title Column with Subjects
            ->addColumn('material_title_with_subjects_and_accession_number', function (Borrowing $borrowing){
                
                $tableData = $borrowing->materialCopy->material->title . 
                    '<br>' . 
                    $borrowing->materialCopy->material->isbn . 
                    '<br>' .
                    $borrowing->materialCopy->accession_number . 
                    '<br>';

                foreach ($borrowing->materialCopy->material->subjects as $subject) 
                {
                    $tableData .= '<span class="badge border border-dark" style="background-color:' . $subject->background_color . '; color:' . $subject->text_color . ';">' . $subject->subject_name .'</span> ';
                }
                return $tableData;
            })
            ->addColumn('action', function (Borrowing $borrowing) {
                $btn = '<td>
                            <div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id=' . $borrowing->id . ' data-type="borrowings" >
                                        <span class="fa fa-backward">&nbsp;&nbsp;</span>Restore
                                </a>
                            </div>
                        </td>';
                return $btn;
            })
            ->rawColumns(['action', 'material_title_with_subjects_and_accession_number'])
            ->toJson();
    }

    /**
     * Function to Show the Index Page of Issuing Archive
     * Route: GET
     * @return View
     */ 
    public function issuing_list()
    {
        // If User is not logged in, redirect to login page
        if (! auth::check())
            return redirect()->route('user_login_page');
        // If user doesnt have the permissions, redirect to dashboard
        $user_permission = $this->getUserPermissions();
        if(! $user_permission -> contains('slug_name', $this->routeName))
            return redirect()->route('Dashboard');

        return view('Archives.issuing');
    }

    /**
     * Function to supply data on User Archive Datatable
     * Route: POST
     * @param Request $request
     * @return JSON Response
     */
    public function issuing_list_datatables(Request $request)
    {
        $borrowings = Borrowing::with('user.userDetails', 'materialCopy.material.subjects')
            ->where('borrowings.status', 0)
            ->where('borrowings.type', 1)
            ->withTrashed(); 

        return DataTables::eloquent($borrowings)
            ->addIndexColumn()
            ->addColumn('formatted_fullname_with_student_number', function (Borrowing $borrowing){
                return $borrowing->user->userDetails->full_name_with_student_number;
            })
            // Material Title Column with Subjects
            ->addColumn('material_title_with_subjects_and_accession_number', function (Borrowing $borrowing){
                
                $tableData = $borrowing->materialCopy->material->title . 
                    '<br>' . 
                    $borrowing->materialCopy->material->isbn . 
                    '<br>' .
                    $borrowing->materialCopy->accession_number . 
                    '<br>';

                foreach ($borrowing->materialCopy->material->subjects as $subject) 
                {
                    $tableData .= '<span class="badge border border-dark" style="background-color:' . $subject->background_color . '; color:' . $subject->text_color . ';">' . $subject->subject_name .'</span> ';
                }
                return $tableData;
            })
            ->addColumn('action', function (Borrowing $borrowing) {
                $btn = '<td>
                            <div class="btn-group-vertical">
                                <a type="button" class="btn btn-info data-edit" id="data-edit" data-id=' . $borrowing->id . ' data-type="borrowings" >
                                        <span class="fa fa-backward">&nbsp;&nbsp;</span>Restore
                                </a>
                            </div>
                        </td>';
                return $btn;
            })
            ->rawColumns(['action', 'material_title_with_subjects_and_accession_number'])
            ->toJson();
    }

    /**
     * Function to restore a Model depending on type
     * Route: POST
     * @param Request $request
     * @return JSON Response for SweetAlert
     */
    public function Archive_Restore(Request $request)
    {
        try {
            if($request->type == "borrowings")
            {
                Borrowing::where('id', $request->id)
                    ->withTrashed()
                    ->update([
                        'status' => 1,
                        'deleted_at' => NULL,
                        'updated_at' => now(),
                    ]);
            }

            if($request->type == "users")
            {
                User::where('id', $request->id)
                    ->withTrashed()
                    ->update([
                        'status' => 1,
                        'deleted_at' => NULL,
                        'updated_at' => now(),
                    ]);
            }

            if($request->type == "materials")
            {
                Material::where('materials_id', $request->id)
                    ->withTrashed()
                    ->update([
                        'status' => 1,
                        'deleted_at' => NULL,
                        'updated_at' => now(),
                    ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Restore Success!',
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Restore Failed'
            ]);
        }
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
