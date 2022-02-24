<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Landing Controller */
Route::get('/', function(){
    return View('Landingpage.landing'); // Your Blade template name
});

Route::get('/Services', function(){
    return View('Landingpage.services'); // Your Blade template name
});

Route::get('/About-Us', function(){
    return View('Landingpage.about'); // Your Blade template name
});

Route::get('/Register', function(){
    return View('Login.registration'); // Your Blade template name
});

/* Login Controller */
route::get('/Login', ['uses' => 'LoginController@login_display' , 'as' => 'user_login_page']);
route::get('/Logout', ['uses' => 'LoginController@logout' , 'as' => 'user_logout']);
route::post('/User/Login', ['uses' => 'LoginController@login_authenticate' , 'as' => 'user_login']);
route::get('/User/Registration', ['uses' => 'LoginController@user_registration', 'as' => 'user_registration']);
/* Pages Controller */

route::get('/Dashboard', ['uses'=>'PagesController@dashboard' , 'as' => 'Dashboard']);
route::get('/Penalty', ['uses' => 'PagesController@view_penalty', 'as' => 'View_Penalty']);
route::get('/Dashboard/Student', ['uses' => 'PagesController@student_dashboard', 'as' => 'student_dashboard']);

/* Dashboard Datatable Controller */
route::get('/Dashboard-Datatable/DTR', ['uses' => 'DashboardTableController@time_record', 'as'=>'TableController-DTR']);
route::get('/Admin-Dashboard-Datatable/Issuing/Extension/Status', ['uses' => 'DashboardTableController@list_of_extension', 'as'=>'Table-issue-extensions_list']);
route::get('/Admin-Dashboard-Datatable/Issued-Books', ['uses' => 'DashboardTableController@list_of_issued', 'as'=>'Table-issued-list']);


// Student Datatable Controller //

route::get('/Student-Dashboard-Datatable/Borrow/History', ['uses' => 'StudentDashboardTableController@borrow_history', 'as'=>'StudentTable-borrow_history']);
route::get('/Student-Dashboard-Datatable/Issuing/Extension', ['uses' => 'StudentDashboardTableController@list_of_issued_books', 'as'=>'StudentTable-issue-extensions']);
route::get('/Student-Dashboard-Datatable/Issuing/Extension/Status', ['uses' => 'StudentDashboardTableController@list_of_extension', 'as'=>'StudentTable-issue-extensions_list']);



/* Resource Controller Extra Method */

/* Gender Controller */

route::get('/Gender/Datatables', ['uses'=>'GenderController@GenderDatatables' , 'as' => 'GenderDatatables']);
route::post('/Gender/Update', ['uses'=>'GenderController@GenderUpdate' , 'as' => 'GenderUpdate']);
route::post('/Gender/Delete', ['uses'=>'GenderController@GenderDelete' , 'as' => 'GenderDelete']);

/* Role Controller */

route::get('/Role/Datatables', ['uses'=>'RolesController@RolesDatatables' , 'as' => 'RolesDatatables']);
route::post('/Role/Delete', ['uses' => 'RolesController@RolesDelete' , 'as' => 'RoleDelete']);

/* Course Controller */

route::get('/Course/Datatables', ['uses'=>'CourseController@CourseDatatables' , 'as' => 'CourseDatatables']);
route::post('/Course/Delete', ['uses' => 'CourseController@CourseDelete' , 'as' => 'CourseDelete']);

/* User Controller */

route::get('/User/Datatables', ['uses'=>'UserController@UserDatatables' , 'as' => 'UserDatatables']);
route::post('/User/Delete', ['uses' => 'UserController@UserDelete' , 'as' => 'UserDelete']);

/* Role Permissions */

route::get('/Permissions/Datatables', ['uses'=>'PermissionController@PermissionDatatables' , 'as' => 'PermissionDatatables']);

/* Materials Category-Subject Controller */

// Material Copies Routes
route::post('/Material/{id}/Copies/Store', ['uses'=>'MaterialController@MaterialCopyStore' , 'as' => 'Material.MaterialCopy.store']);
route::post('/Material/{id}/Copies/{copy_id}/ShowEditValues', ['uses'=>'MaterialController@MaterialCopyShowEditValues' , 'as' => 'Material.MaterialCopy.ShowEditValues']);
route::post('/Material/{id}/Copies/{copy_id}/Update', ['uses'=>'MaterialController@MaterialCopyUpdate' , 'as' => 'Material.MaterialCopy.update']);

route::get('/Material/Datatables', ['uses'=>'MaterialController@MaterialsDatatables' , 'as' => 'MaterialsDatatables']);
route::post('/Material/Delete', ['uses' => 'MaterialController@MaterialsDelete' , 'as' => 'MaterialsDelete']);


// Route for getting Edit Values on Materials
route::post('/Material/Edit/{id}', ['uses'=>'MaterialController@showEditValues' , 'as' => 'Materials.ShowEditValues']);

route::get('/Material/History/{id}', ['uses'=>'MaterialController@Materials_History' , 'as' => 'Materials_History']);
route::post('/Material/History-Datatables/{id}', ['uses'=>'MaterialController@Materials_History_Datatables' , 'as' => 'Materials_History_Datatables']);

route::get('/Materials/Category/Datatables', ['uses'=>'MaterialsCategory@MaterialsCategoryDatatables' , 'as' => 'MaterialsCategoryDatatables']);
route::post('/Materials/Category/Delete', ['uses' => 'MaterialsCategory@MaterialsCategoryDelete' , 'as' => 'MaterialsCategoryDelete']);

route::get('/Materials/Subject/Datatables', ['uses'=>'MaterialsSubject@MaterialsSubjectDatatables' , 'as' => 'MaterialsSubjectDatatables']);
route::post('/Materials/Subject/Delete', ['uses' => 'MaterialsSubject@MaterialsSubjectDelete' , 'as' => 'MaterialsSubjectDelete']);

/* Issuing Controller */

route::get('/Issuing/Datatables', ['uses'=>'IssuingController@Datatables' , 'as' => 'IssuingDatatables']);
route::post('/Issuing/Delete', ['uses' => 'IssuingController@Deletion' , 'as' => 'IssuingDelete']);
route::get('/Issuing/Extension', ['uses' => 'IssuingController@book_extension', 'as' => 'book_extension']);

/* Borrowing Controller */

route::get('/Borrowing/Datatables', ['uses'=>'BorrowingController@Datatables' , 'as' => 'BorrowingDatatables']);
route::post('/Borrowing/Delete', ['uses' => 'BorrowingController@Deletion' , 'as' => 'BorrowingDelete']);

/* Manage Penalty Controller */

route::get('/ManagePenalty/Datatables', ['uses'=>'ManagePenaltyController@Datatables' , 'as' => 'ManagePenaltyDatatables']);

/* Borrowing Controller */

 route::get('/Penalty/Datatables', ['uses'=>'PenaltyController@Datatables' , 'as' => 'PenaltyDatatables']);
 route::get('/Penalty/PDF', ['uses' => 'PenaltyController@PDF' , 'as' => 'PenaltyPDF']);

 /* DTR Controller */

route::get('/DTR', ['uses' => 'DTRController@main', 'as' => 'DTR.main']);
route::post('/DTR/Login', ['uses' => 'DTRController@dtr_login' , 'as' => 'DTR.login']);
route::get('/DTR/User', ['uses' => 'DTRController@mainpage' , 'as' => 'DTR.mainpage']);
route::get('/DTR/Search', ['uses' => 'DTRController@search_book', 'as' => 'DTR.search']);
route::get('/DTR/Logout', ['uses' => 'DTRController@force_logout', 'as' => 'force_logout']);
route::get('/DTR/View', ['uses' => 'DTRController@view', 'as' => 'DTR.view']);
route::get('/DTR/View/Datatables', ['uses' => 'DTRController@view_datatables', 'as' => 'DTR.view_datatables']);



/* User Profile */
route::get('/UserProfile/View', ['uses' => 'UserController@UserProfile_View', 'as' => 'UserProfile.View']);
route::get('/UserProfile/Update/View', ['uses' => 'UserController@UserProfile_UpdateView', 'as' => 'UserProfile.UpdateView']);
route::get('/UserProfile/Search/Book', ['uses' => 'UserController@SearchBook', 'as' => 'UserProfile.SearchBook']);
route::get('/UserProfile/Search/BookDatatables', ['uses' => 'UserController@SearchBookDatatables', 'as' => 'UserProfile.SearchBookDatatables']);

route::get('/UserProfile/Reserve/List', ['uses' => 'ReserveController@main', 'as' => 'Reserve.main']);
route::post('/UserProfile/Reserve/Add', ['uses' => 'ReserveController@Add', 'as' => 'Reserve.add']);
route::get('/UserProfile/Reserve/Datatables', ['uses' => 'ReserveController@Datatables', 'as' => 'Reserve.Datatables']);
route::get('/UserProfile/Reserve/BooksDatatables', ['uses' => 'ReserveController@BooksDatatables', 'as' => 'Reserve.BooksDatatables']);

route::get('/UserProfile/MyPenalty/View', ['uses' => 'PenaltyController@My_Penalty_View', 'as' => 'Penalty.My_Penalty']);
route::get('/UserProfile/MyPenalty/Datatables', ['uses' => 'PenaltyController@My_Penalty_Datatables', 'as' => 'Penalty.My_Penalty_Datatables']);


route::post('/UserProfile/Update', ['uses' => 'UserController@UserProfile_Update', 'as' => 'UserProfile.Update']);


/* Archives Controller */

route::get('/Archives/Materials', ['uses' => 'ArchivesController@materials_list', 'as' => 'Archives.Materials_List']);
route::post('/Archives/Materials/Datatables', ['uses' => 'ArchivesController@materials_list_datatables', 'as' => 'Materials_List_Datatables']);
route::get('/Archives/Users', ['uses' => 'ArchivesController@users_list', 'as' => 'Archives.Users_List']);
route::get('/Archives/Users/Datatables', ['uses' => 'ArchivesController@users_list_datatables', 'as' => 'Users_List_Datatables']);
route::get('/Archives/RoomUse', ['uses' => 'ArchivesController@borrowing_list', 'as' => 'Archives.Borrowing_List']);
route::get('/Archives/RoomUse/Datatables', ['uses' => 'ArchivesController@borrowing_list_datatables', 'as' => 'Borrowing_List_Datatables']);
route::get('/Archives/Borrowing', ['uses' => 'ArchivesController@issuing_list', 'as' => 'Archives.Issuing_List']);
route::get('/Archives/Borrowing/Datatables', ['uses' => 'ArchivesController@issuing_list_datatables', 'as' => 'Issuing_List_Datatables']);
route::get('/Archives/Restore', ['uses' => 'ArchivesController@Archive_Restore', 'as' => 'Archive_Restore']);



/* Resources Controller */

route::resource('/User' , 'UserController');
route::resource('/Roles' , 'RolesController');
route::resource('/Gender' , 'GenderController');
route::resource('/Course' , 'CourseController');
route::resource('/Permissions', 'PermissionController');
route::resource('/Material', 'MaterialController')->only(['index', 'store', 'show']);
route::resource('/MaterialsCategory', 'MaterialsCategory');
route::resource('/MaterialsSubject', 'MaterialsSubject');
route::resource('/Issuing', 'IssuingController');
route::resource('/Borrowing', 'BorrowingController');
Route::resource('/ManagePenalty', 'ManagePenaltyController');
Route::resource('/Penalty', 'PenaltyController');
