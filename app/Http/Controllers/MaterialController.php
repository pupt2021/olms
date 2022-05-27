<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Material;
use App\Models\MaterialCopy;
use App\Models\MaterialSubject;
use App\Models\Borrowing;
use App\Models\User;
use App\Models\UserDetail;

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
        // Sets the value for protected variables
        /* if controller is not compatible with slug name */
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($this->controller, $action) = explode('Controller@', $controllerAction);

        $this->routeName = Route::currentRouteName();
    }

    /**
     * Function to Show the Index Page of Materials
     * Route: GET
     * @return View
     */ 
    public function index()
    {
        // If User is not logged in, redirect to login page
        if (! auth::check())
            return redirect()->route('user_login_page');
        // If user doesnt have the permissions, redirect to dashboard
        $user_permission = $this->getUserPermissions();
        if (! $user_permission->contains('slug_name', $this->routeName))
            return redirect()->route('Dashboard');

        $material_category = db::table('materials_category')->where('status', 1)->get();
        $material_subject = db::table('materials_subject')->where('status', 1)->get();

        return view('Materials.list')
            ->with('user_perm', $user_permission)
            ->with('category', $material_category)
            ->with('subject', $material_subject);
    }

    /**
     * Store a newly created resource in storage.
     * Route: POST
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        extract($request->all());
        // If ID is not empty, Update a Material...
        if ($request->has('id')) {
            $data_updated = [
                'isbn' => $isbn,
                'title' => $title,
                'callno' => $callno,
                'author' => $author,
                'publisher' => $publisher,
                'edition' => $edition,
                'copyright' => $copyright,
                'type' => $type,
                'updated_at' => Carbon::now()
            ];
            
            try {
                // Update the Material
                db::table('materials')
                    ->where('materials_id', $id)
                    ->update($data_updated);
                return response()->json(['status' => 'success', 'message' => "Materials Data is successfully updated"]);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json(['status' => 'error', 'message' => "Materials Data failed to update"]);
            }
            
        } 

        // If ID is empty, Create a new Material...
        else 
        {
            $material_category = db::table('materials_category')
                ->where('id', $structure)
                ->first();

            $data_inserted = [
                'category_id' => $structure,
                'isbn' => $isbn,
                'title' => $title,
                'callno' => $callno,
                'author' => $author,
                'publisher' => $publisher,
                'edition' => $edition,
                'copyright' => $copyright,
                'type' => $type,
                'created_at' => Carbon::now()
            ];

            $id = db::table('materials')
                ->insertGetId($data_inserted);

            // Insert Subject IDs into a Pivot Table
            for ($i = 0; $i < count($subject); $i++) {
                db::table('materials_subject_link')
                    ->insert([
                        'mat_id' => $id,
                        'sub_id' => $subject[$i]
                    ]);
            }

            return response()->json([
                'status' => 'success', 
                'message' => "Materials Category Data is successfully inserted", 
                'materialID' => base64_encode($id),
            ]);
        }
    }

    /**
     * Display the specified resource.
     * Route: GET
     * @param int $id
     * @return View
     */
    public function show($id)
    {
        $material = Material::where('materials_id', base64_decode($id))
            ->firstorFail();
            
        $materialCopies = MaterialCopy::where('materials_id', base64_decode($id))
            ->orderBy('date_recieved', 'DESC')
            ->get();

        $user_permission = $this->getUserPermissions();

        return view('Materials.show', compact('material', 'materialCopies', 'user_permission'));
    }

    /**
     * Function to return edit values for a Material
     * Route: POST
     * @param Request $request, Integer $id
     * @return JSON Response
     */ 
    public function showEditValues(Request $request, $id)
    {
        // Block requests other than POST
        if (! $request->isMethod('post')) 
            abort(404);
        
        $data = db::table('materials')
            ->where('materials_id', $id)
            ->get();

        return response()->json($data);
    }

    /**
     * Function to supply data to Material Table in Index Page
     * Route: POST
     * @return JSON Response
     */ 
    public function MaterialsDatatables()
    {
        $materials = Material::withCount('materialCopies')
            ->with('subjects')
            ->where('status', 1);
        
        $user_permission = $this->getUserPermissions();

        return DataTables::eloquent($materials)
            ->addIndexColumn()
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
            // Action Buttons Column
            ->addColumn('action', function (Material $material) use ($user_permission){

                // Add Button for Material History
                $btn = '
                        <td>
                            <div class="btn-group-horizontally">
                                <a type="button" title="VIEW" href="Material/' . base64_encode($material->materials_id) . '" class="btn btn-primary">
                                    <span class="fas fa-external-link-alt"></span>
                                </a>
                                <a type="button" title="HISTORY" href="Material/History/' . base64_encode($material->materials_id) . '" class="btn btn-info" style="background-color: green">
                                    <span class="fa fa-history"></span>
                                </a>';

                // Add Button for Material Show/Edit if User has Material.show Permission
                if ($user_permission->contains('slug_name', 'Material.show'))
                {
                    $btn .= '
                                <a type="button" title="EDIT" class="btn btn-info data-edit" id="data-edit" data-id=' . $material->materials_id . '>
                                    <span class="fa fa-edit"></span>
                                </a>';
                }

                // Add Button for Material Delete if User has MaterialsDelete Permission
                if ($user_permission->contains('slug_name', 'MaterialsDelete'))
                {
                    $btn .= '
                                <a type="button" title="DELETE" class="btn btn-warning data-delete" id="data-delete" data-id=' . $material->materials_id . '>
                                    <span class="fa fa-trash"></span>
                                </a>';
                }

                $btn .= '
                            </div>
                        </td>';
                            
                return $btn;
            })
            // Declare columns that have HTML as RawColumns
            ->rawColumns(['action', 'title_with_subjects'])
            ->toJson();
    }

    /**
     * Function to mark a Material as Deleted in DB
     * Route: POST
     * @param Request $request
     * @return JSON Response
     */ 
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
        // Check if user is not logged in, and if not, redirect to login page
        if (! auth::check() == true) 
            return redirect()->route('user_login_page');
        
        $material = Material::where('materials_id', base64_decode($id))
            ->firstorFail();

        return view('Materials.history', compact('material'))
            ->with('id', $id);
       
    }

    public function Materials_History_Datatables(Request $request, $id)
    {
        // Block requests other than POST
        if (! $request->isMethod('post')) 
            abort(404);

        $material = Material::where('materials_id', base64_decode($id))
            ->firstorFail();

        $materialCopiesID = MaterialCopy::where('materials_id', base64_decode($id))
            ->pluck('material_copy_id');

        $borrowings = Borrowing::with(['materialCopy', 'user.userDetails'])
            ->withTrashed()
            ->whereIn('material_copy_id', $materialCopiesID)
            ->orderBy('date_returned', 'DESC');

        return DataTables::eloquent($borrowings)
            ->addIndexColumn()
            ->addColumn('accession_number', function (Borrowing $borrowing){
                    return $borrowing->materialCopy->accession_number;
                })
            ->addColumn('borrower', function (Borrowing $borrowing){
                    return $borrowing->user->userDetails->full_name_with_student_number;
                })
            ->addColumn('borrowDates', function (Borrowing $borrowing){
                    return $borrowing->formatted_date_borrowed_returned;
                })
            ->addColumn('status', function (Borrowing $borrowing){
                return ($borrowing->status === 1) ? 'BORROWED' : 'RETURNED';
            })
            ->rawColumns(['accession_number', 'borrower', 'borrowDates', 'status'])
            ->toJson();
    }

    /**
     * Function to Store a number of Material Copies
     * Route: POST
     * @param Request $request, Integer $id
     * @return JSON Response
     */ 
    public function MaterialCopyStore(Request $request, $id)
    {
        // Get Material Information
        $material = Material::where('materials_id', base64_decode($id))
            ->firstorFail();

        $material_category_structure = db::table('materials_category')
            ->where('id', $material->category_id)
            ->value('cat_structure');

        // Get Latest Accession Number Digit, for more info go to Models/MaterialCopy/getDigitinAccessionNumberAttribute
        $materialsWithSameAccessionNumber = MaterialCopy::where('accession_number', 'LIKE', $material_category_structure . '%')
            ->get();

        // If there are material copiess with same accession number...
        if ($materialsWithSameAccessionNumber->isNotEmpty()) 
        {
            $latestMaterialCopyAccessionNumber = $materialsWithSameAccessionNumber->sortByDesc('digit_in_accession_number')
            ->first();

            // Add one to the latest digit
            $currentDigit = $latestMaterialCopyAccessionNumber->digit_in_accession_number + 1;
        }

        // If there are no material copies with same accession number...
        else
        {
            // Let it be the first one
            $currentDigit = 1;
        }
        
        // Loop for the number of copies inputted
        for ($i=0; $i < $request->input('copies'); $i++) 
        { 
            // Ensure that the accession number formed is unique, else add 1 then check again
            while (MaterialCopy::where('accession_number', $material_category_structure . '-' . $currentDigit)->exists()) 
                $currentDigit += 1;

            // If accession number is unique, create Material Copy Entry
           MaterialCopy::create([
                'materials_id' => $material->materials_id,
                'borrows_id' => NULL,
                'accession_number' => $material_category_structure . '-' . $currentDigit,
                'date_recieved' => Carbon::now(),
           ]);
        }
        return response()->json(['status' => 'success', 'message' => "Material Copies Data is successfully inserted"]);
    }

    /**
     * Function to Show Values of a Material Copy in a modal
     * Route: POST
     * @param Integer $id, Integer $copy_id
     * @return JSON Response
     */ 
    public function MaterialCopyShowEditValues($id, $copy_id)
    {
        // Get Material Copy Information and return JSON
        $materialCopy = MaterialCopy::where('materials_id', $id)
            ->where('material_copy_id', $copy_id)
            ->select('material_copy_id', 'date_recieved', 'accession_number')
            ->get();

        return response()->json($materialCopy);
    }

    /**
     * Function to Update a Material Copy
     * Route: POST
     * @param Request $request, Integer $id, Integer $copy_id
     * @return JSON Response
     */ 
    public function MaterialCopyUpdate(Request $request, $id, $copy_id)
    {
        // Get Material Copy and update
        MaterialCopy::where('materials_id', $id)
            ->where('material_copy_id', $copy_id)
            ->update([
            'date_recieved' => $request->input('date_recieved'),
        ]);

        return response()->json(['status' => 'success', 'message' => "Material Copy Data is successfully updated"]);
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
    