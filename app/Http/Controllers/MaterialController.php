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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        extract($request->all());

        // If ID is not empty...
        if ($id !== '') {

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
            // Update the Material
            db::table('materials')
                ->where('materials_id', $id)
                ->update($data_updated);

            return response()->json(['status' => 'success', 'message' => "Materials Category Data is successfully updated"]);

        } 

        // If ID is empty
        else 
        {
            // Create new Material
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

            return response()->json(['status' => 'success', 'message' => "Materials Category Data is successfully inserted"]);
        }
    }

    /**
     * Display the specified resource.
     *
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

        $user_permission = db::table('user_links as a')
            ->join('user_permission as b', 'a.id', '=', 'b.link_id')
            ->where('b.user_id', auth::user()->id)
            ->where('b.status', '=', 'On')
            ->where('a.slug_name', 'LIKE', '%' . $this->controller . '%')
            ->where('b.link_id', '!=', 0)
            ->get();

        return view('Materials.show', compact('material', 'materialCopies', 'user_permission'));
    }


    public function showEditValues(Request $request, $id)
    {
        // Block GET requests
        if (! $request->isMethod('post')) 
            abort(404);
        
        $data = db::table('materials')
            ->where('materials_id', $id)
            ->get();

        return response()->json($data);
    }

    public function MaterialsDatatables()
    {
        $data = DB::table('materials')
            ->select('*', DB::raw('(CASE WHEN type = 1 THEN "Borrowing" WHEN type = 2 THEN "Room Use" END) AS material_type'))
            ->where('status', 1);

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

        return DataTables::query($data)
            // Copies Column
            ->addColumn('copies', function ($row){
                    $materials_copies_count = db::table('materials_copies')
                        ->where('materials_id', $row->materials_id)
                        ->count();
                    
                    return $materials_copies_count;
                })

            // Action Buttons Column
            ->addColumn('action', function ($row) use ($user_permission){

                // Add Button for Material History
                $btn = '
                        <td>
                            <div class="btn-group-horizontally">
                                <a type="button" title="VIEW" href="Material/' . base64_encode($row->materials_id) . '" class="btn btn-primary">
                                    <span class="fas fa-external-link-alt"></span>
                                </a>
                                <a type="button" title="HISTORY" href="Material/History/' . base64_encode($row->materials_id) . '" class="btn btn-info" style="background-color: green">
                                    <span class="fa fa-history"></span>
                                </a>';

                // Add Button for Material Show/Edit if User has Material.show Permission
                if ($user_permission->contains('slug_name', 'Material.show'))
                {
                    $btn .= '
                                <a type="button" title="EDIT" class="btn btn-info data-edit" id="data-edit" data-id=' . $row->materials_id . '>
                                    <span class="fa fa-edit"></span>
                                </a>';
                }

                // Add Button for Material Delete if User has MaterialsDelete Permission
                if ($user_permission->contains('slug_name', 'MaterialsDelete'))
                {
                    $btn .= '
                                <a type="button" title="DELETE" class="btn btn-warning data-delete" id="data-delete" data-id=' . $row->materials_id . '>
                                    <span class="fa fa-trash"></span>
                                </a>';
                }

                $btn .= '
                            </div>
                        </td>';
                            
                return $btn;
            })
            ->rawColumns(['action', 'copies'])
            ->toJson();
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

        $latestMaterialCopyAccessionNumber = $materialsWithSameAccessionNumber->sortByDesc('digit_in_accession_number')
            ->first();
            
        // Add one to the latest digit
        $currentDigit = $latestMaterialCopyAccessionNumber->digit_in_accession_number + 1;
        
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

    public function MaterialCopyShowEditValues($id, $copy_id)
    {}





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
}
    